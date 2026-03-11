<?php
require_once './env.php';
require_once './lib/Database.php';

// lib/Database を利用
use Lib\Database;

// POSTリクエスト以外、またはIDがない場合は一覧へ戻す
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || empty($_POST['id'])) {
    header('Location: select_users.php');
    exit;
}

$id = $_POST['id'];
$result = delete($id);

// 完了したら一覧画面へリダイレクト
header('Location: select_users.php');
exit;

/**
 * ユーザデータを削除する関数
 */
function delete($id)
{
    try {
        // DB接続
        $pdo = Database::getInstance();
        // SQL作成: 指定した id で検索してレコードを削除
        $sql = "DELETE FROM users WHERE id = :id;";
        $stmt = $pdo->prepare($sql);
        // SQL実行
        return $stmt->execute(['id' => $id]);
    } catch (PDOException $e) {
        error_log($e->getMessage());
        return false;
    }
}
