<?php

use App\Models\AuthUser;
use App\Models\Tweet;

// 共通ファイル app.php を読み込み
require_once('../app.php');

// TODO: ユーザセッションの確認し、ログインしていない場合はログイン画面にリダイレクト
$auth_user = AuthUser::checkLogin();

// TODO: Tweet投稿一覧を取得
$tweet = new Tweet();
$tweets = $tweet->get();
?>

<!DOCTYPE html>
<html lang="ja">

<!-- TODO: コンポーネント: components/head.php -->
<?php include COMPONENT_DIR . 'head.php' ?>

<body>

    <div class="flex mx-auto container">

        <header class="w-1/5 p-3 border-r min-h-screen">
            <!-- TODO: components/nav.php 読み込み -->
            <?php include COMPONENT_DIR . 'nav.php' ?>
        </header>

        <main class="w-4/5 pt-3">
            <?php include COMPONENT_DIR . 'search_form.php' ?>

            <div class="row">
                <!-- TODO: components/tweet_form.php 読み込み -->
                <?php include COMPONENT_DIR . 'tweet_form.php' ?>
            </div>

            <?php include COMPONENT_DIR . 'tweet_list.php' ?>
        </main>
    </div>

</body>

</html>