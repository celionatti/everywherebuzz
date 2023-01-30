<?php

/**
 * Database Class
 * 
 * @author Celio Natti <celionatti@gmail.com>
 * @copyright 2023 Celionatti
 */

namespace app\core\database;

use PDO;
use Exception;
use app\core\Application;

class Database
{
    public PDO $pdo;

    protected $_lastInsertId;
    protected $_rowCount = 0;
    protected $_results;
    protected $_fetchType = PDO::FETCH_OBJ;
    protected $_class;
    protected $_error = false;
    protected $_stmt;

    protected static $_db;

    public function __construct(array $config)
    {
        try {
            $dsn = $config['dsn'] ?? '';
            $user = $config['user'] ?? '';
            $password = $config['password'] ?? '';
            $this->pdo = new PDO($dsn, $user, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $this->pdo->setAttribute(PDO::ATTR_PERSISTENT, true);
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        } catch(Exception $e) {
            Application::$app->logger->error('Database Error', ['message' => $e->getMessage(), 'code' => $e->getCode()]);
        }
    }

    public static function getInstance()
    {
        if (!self::$_db) {
            self::$_db = Application::$app->database;
        }
        return self::$_db;
    }

    /**
     * Summary of execute
     * @param mixed $sql
     * @param mixed $bind
     * @return Database
     */
    public function execute($sql, $bind = [])
    {
        $this->_results = null;
        $this->_lastInsertId = null;
        $this->_error = false;
        $this->_stmt = $this->pdo->prepare($sql);
        if (!$this->_stmt->execute($bind)) {
            $this->_error = true;
        } else {
            $this->_lastInsertId = $this->pdo->lastInsertId();
        }

        return $this;
    }

    /**
     * Summary of query
     * Query the database.
     * @param mixed $sql
     * @param mixed $bind
     * @return Database
     */
    public function query($sql, $bind = [])
    {
        $this->execute($sql, $bind);
        if (!$this->_error) {
            $this->_rowCount = $this->_stmt->rowCount();
            if ($this->_fetchType === PDO::FETCH_CLASS) {
                $this->_results = $this->_stmt->fetchAll($this->_fetchType, $this->_class);
            } else {
                $this->_results = $this->_stmt->fetchAll($this->_fetchType);
            }
        }
        return $this;
    }

    /**
     * Summary of insert
     * Insert into the database.
     * @param mixed $table
     * @param mixed $values
     * @return bool
     */
    public function insert($table, $values)
    {
        $fields = [];
        $binds = [];
        foreach ($values as $key => $value) {
            $fields[] = $key;
            $binds[] = ":{$key}";
        }
        $fieldStr = implode('`, `', $fields);
        $bindStr = implode(', ', $binds);
        $sql = "INSERT INTO {$table} (`{$fieldStr}`) VALUES ({$bindStr})";
        $this->execute($sql, $values);
        return !$this->_error;
    }

    /**
     * Summary of update
     * Update the database record.
     * @param mixed $table
     * @param mixed $values
     * @param mixed $conditions
     * @return bool
     */
    public function update($table, $values, $conditions)
    {
        $binds = [];
        $valueStr = "";
        foreach ($values as $field => $value) {
            $valueStr .= ", `{$field}` = :{$field}";
            $binds[$field] = $value;
        }
        $valueStr = ltrim($valueStr, ', ');
        $sql = "UPDATE {$table} SET {$valueStr}";

        if (!empty($conditions)) {
            $conditionStr = " WHERE ";
            foreach ($conditions as $field => $value) {
                $conditionStr .= "`{$field}` = :cond{$field} AND ";
                $binds['cond' . $field] = $value;
            }
            $conditionStr = rtrim($conditionStr, ' AND ');
            $sql .= $conditionStr;
        }
        $this->execute($sql, $binds);
        return !$this->_error;
    }

    /**
     * Summary of results
     * @return mixed|null
     */
    public function results()
    {
        return $this->_results;
    }

    /**
     * Summary of count
     * @return int|mixed
     */
    public function count()
    {
        return $this->_rowCount;
    }

    /**
     * Summary of lastInsertId
     * return the last inserted Id.
     * @return mixed|null
     */
    public function lastInsertId()
    {
        return $this->_lastInsertId;
    }

    /**
     * Summary of setClass
     * @param mixed $class
     * @return void
     */
    public function setClass($class)
    {
        $this->_class = $class;
    }

    /**
     * Summary of getClass
     * @return mixed
     */
    public function getClass()
    {
        return $this->_class;
    }

    /**
     * Summary of setFetchType
     * @param mixed $type
     * @return void
     */
    public function setFetchType($type)
    {
        $this->_fetchType = $type;
    }

    /**
     * Summary of getFetchType
     * @return int|mixed
     */
    public function getFetchType()
    {
        return $this->_fetchType;
    }

    // Migration
    public function applyMigrations()
    {
        $this->createMigrationsTable();
        $appliedMigrations = $this->getAppliedMigrations();

        $newMigrations = [];
        $files = scandir(Application::$ROOT_DIR . '/migrations');
        $toApplyMigrations = array_diff($files, $appliedMigrations);
        foreach ($toApplyMigrations as $migration) {
            if ($migration === '.' || $migration === '..') {
                continue;
            }

            require_once Application::$ROOT_DIR . '/migrations/' . $migration;
            $className = pathinfo($migration, PATHINFO_FILENAME);
            $instance = new $className();
            $this->log("Applying migration $migration");
            $instance->up();
            $this->log("Applied migration $migration");
            $newMigrations[] = $migration;
        }

        if (!empty($newMigrations)) {
            $this->saveMigrations($newMigrations);
        } else {
            $this->log("There are no migrations to apply");
        }
    }

    public function createMigrationsTable()
    {
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS migrations (
            id INT AUTO_INCREMENT PRIMARY KEY,
            migration VARCHAR(255),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )  ENGINE=INNODB;");
    }

    protected function getAppliedMigrations()
    {
        $statement = $this->pdo->prepare("SELECT migration FROM migrations");
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_COLUMN);
    }

    protected function saveMigrations(array $newMigrations)
    {
        $str = implode(',', array_map(fn($m) => "('$m')", $newMigrations));
        $statement = $this->pdo->prepare("INSERT INTO migrations (migration) VALUES
            $str
        ");
        $statement->execute();
    }

    private function log($message)
    {
        echo "[" . date("Y-m-d H:i:s") . "] - " . $message . PHP_EOL;
    }

}