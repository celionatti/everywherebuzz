<?php 

/**
 * Application Class
 * 
 * @author Celio Natti <celionatti@gmail.com>
 * @copyright 2023 Celionatti
 */

namespace app\core;

use app\models\Users;
use app\core\database\Database;

class Application
{
    const EVENT_BEFORE_REQUEST = 'beforeRequest';
    const EVENT_AFTER_REQUEST = 'afterRequest';

    protected array $eventListeners = [];

    public static string $ROOT_DIR;
    public string $layout = "main";
    public static Application $app;
    public $logger;
    public Session $session;
    public Database $database;
    public Cookie $cookie;
    public Config $config;
    public Router $router;
    public Request $request;
    public Response $response;
    public ?Controller $controller = null;
    public View $view;
    public ?Users $user;

    public function __construct($rootPath, array $config, $logger)
    {
        $this->user = null;
        self::$ROOT_DIR = $rootPath;
        self::$app = $this;
        $this->logger = $logger;
        $this->config = new Config();
        $this->session = new Session();
        $this->cookie = new Cookie();
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
        $this->view = new View();

        $this->database = new Database($config['database']);

    }

    public static function isGuest()
    {
        return !self::$app->user;
    }

    public function run()
    {
        $this->triggerEvent(self::EVENT_BEFORE_REQUEST);
        $this->constants();
        $this->environment();
        $this->checkExtensions();
        $this->checkVersion();
        try {
            echo $this->router->resolve();
        } catch (\Exception $e) {
            self::$app->logger->info('Application Error', ['message' => $e->getMessage(), 'code' => $e->getCode()]);
            $this->response->setStatusCode($e->getCode());
            echo $this->view->renderView('_error', [
                'exception' => $e
            ]);
        }
    }

    private function checkVersion(): void
    {
        /**
         * =============================================
         * Check php version with the Framework version.
         * =============================================
         */
        $minPhpVersion = self::$app->config->get('php_version'); // If you update this, don't forget to update `spark`.
        if (version_compare(PHP_VERSION, $minPhpVersion, '<')) {
            $message = sprintf(
                'Your PHP version must be %s or higher to run Native Framework. Current version: %s',
                $minPhpVersion,
                PHP_VERSION
            );

            exit($message);
        }
    }

    /**
     * Define framework and application directory constants
     *
     * @return void
     */
    private function constants(): void
    {
        defined('LOG_DIR') or define('LOG_DIR', self::$ROOT_DIR . DIRECTORY_SEPARATOR . "logs");
        defined('TIME_ZONE') or define('TIME_ZONE', self::$app->config->get('TIME_ZONE'));
    }

    /**
     * Set default framework and application settings
     *
     * @return void
     */
    private function environment()
    {
        ini_set('default_charset', 'UTF-8');
    }

    private function checkExtensions()
    {
        $required_extensions = [
            'gd',
            'mysqli',
            'pdo_mysql',
            'pdo_sqlite',
            'curl',
            'fileinfo',
            'intl',
            'exif',
            'mbstring',
        ];

        $not_loaded = [];

        foreach ($required_extensions as $ext) {

            if (!extension_loaded($ext)) {
                $not_loaded[] = $ext;
            }
        }

        if (!empty($not_loaded)) {
            echo"Please load the following extensions in your php.ini file: <br>" . implode("<br>", $not_loaded);
            die;
        }
    }

    /**
     * Get the value of controller
     *
     * @return \app\core\Controller
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * Set the value of controller
     *
     * @param  \app\core\Controller
     */
    public function setController(Controller $controller): void
    {
        $this->controller = $controller;
    }

    public function triggerEvent($eventName)
    {
        $callbacks = $this->eventListeners[$eventName] ?? [];
        foreach ($callbacks as $callback) {
            call_user_func($callback);
        }
    }

    public function on($eventName, $callback)
    {
        $this->eventListeners[$eventName][] = $callback;
    }

}