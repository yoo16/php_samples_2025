<?php
// ------------------------------------------------------------
// 1. 設定ファイルを読み込む
//   ヒント: env.php
// ------------------------------------------------------------
require_once '';

// 変数設定
$db_connection = DB_CONNECTION;
$db_name       = DB_DATABASE;
$db_host       = DB_HOST;
$db_port       = DB_PORT;
$db_user       = DB_USERNAME;
$db_password   = DB_PASSWORD;

// ------------------------------------------------------------
// 2. DSN（Data Source Name）を完成させる
//   ヒント: "{接続方式}:dbname={DB名};host={ホスト};port={ポート};charset=utf8;"
// ------------------------------------------------------------
$dsn = "______:dbname=______;host=______;port=______;charset=utf8;";

// PDOオブジェクトの初期化
$pdo = null;

try {
    // ------------------------------------------------------------
    // ３. PDO インスタンスを生成する
    //   ヒント: new PDO(DSN文字列, ユーザー名, パスワード)
    // ------------------------------------------------------------
    $pdo = null;

    // ------------------------------------------------------------
    // 4. 以下の2つの属性を設定する（コメントを外す）
    //   1. エラーモードを「例外を投げる」モードにする
    //      定数: PDO::ATTR_ERRMODE  値: PDO::ERRMODE_EXCEPTION
    //   2. プリペアドステートメントのエミュレートを無効にする
    //      定数: PDO::ATTR_EMULATE_PREPARES  値: false
    // ------------------------------------------------------------

    // $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
} catch (PDOException $e) {
    echo "接続失敗: " . $e->getMessage();
    exit;
}
