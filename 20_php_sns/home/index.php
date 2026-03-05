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

<body class="bg-white text-slate-900 antialiased">

    <div class="flex max-w-4xl mx-auto min-h-screen">

        <!-- サイドナビ -->
        <header class="w-56 shrink-0 sticky top-0 self-start h-screen border-r border-slate-100">
            <?php include COMPONENT_DIR . 'nav.php' ?>
        </header>

        <!-- メインコンテンツ -->
        <main class="flex-1 border-r border-slate-100 min-h-screen">
            <!-- 検索バー（sticky） -->
            <?php include COMPONENT_DIR . 'search_form.php' ?>

            <!-- ツイート投稿フォーム -->
            <?php include COMPONENT_DIR . 'tweet_form.php' ?>

            <!-- ツイート一覧 -->
            <?php include COMPONENT_DIR . 'tweet_list.php' ?>
        </main>

    </div>

</body>

</html>