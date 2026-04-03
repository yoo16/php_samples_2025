<?php

namespace Lib;

use PDO;
use PDOException;

class Database
{
    private static $instance = null;
    public $pdo;

    private function __construct()
    {
        $dsn = "mysql:dbname=" . DB_DATABASE . ";host=" . DB_HOST . ";charset=" . DB_CHARSET . ";port=" . DB_PORT;
        try {
            // TODO: PDOインスタンスを作成する
            // ヒント: new PDO($dsn, DB_USERNAME, DB_PASSWORD)
            $this->pdo = null;
            // TODO: エラーモードを設定する
            // $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        } catch (PDOException $e) {
            error_log('Database connection failed: ' . $e->getMessage());
            throw $e;
        }
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            // TODO: Databaseクラスのインスタンスを作成する
            // ヒント: new Database()
            self::$instance = null;
        }
        return self::$instance->pdo;
    }
}
