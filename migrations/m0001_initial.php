<?php

use app\core\Application;

/**
 * User: Celio natti
 * Date: 30/01/2023
 * Time: 11:26 pm
 */

class m0001_initial
{
    public function up()
    {
        $db = Application::$app->database;
        $SQL = "CREATE TABLE `users` (
        `id` bigint(11) NOT NULL AUTO_INCREMENT,
        `uid` varchar(300) NOT NULL,
        `username` varchar(300) DEFAULT NULL,
        `firstname` varchar(300) NOT NULL,
        `lastname` varchar(300) NOT NULL,
        `email` varchar(300) NOT NULL,
        `password` varchar(300) NOT NULL,
        `avatar` text DEFAULT NULL,
        `phone` varchar(30) DEFAULT NULL,
        `acl` varchar(30) NOT NULL DEFAULT 'user',
        `ref_uid` varchar(300) DEFAULT NULL,
        `refer_by` varchar(100) DEFAULT NULL,
        `status` varchar(30) NOT NULL DEFAULT 'pending',
        `token` varchar(300) DEFAULT NULL,
        `blocked` tinyint(4) NOT NULL DEFAULT 0,
        `created_at` datetime NOT NULL DEFAULT current_timestamp(),
        `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
        PRIMARY KEY (`id`),
        UNIQUE KEY `email` (`email`),
        KEY `username` (`username`),
        KEY `uid` (`uid`)
        ) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4";
        $db->pdo->exec($SQL);
    }

    public function down()
    {
        $db = Application::$app->database;
        $SQL = "DROP TABLE users;";
        $db->pdo->exec($SQL);
    }
}