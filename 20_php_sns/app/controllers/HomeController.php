<?php

namespace App\Controllers;

use App\Models\Tweet;
use App\Models\Like;
use App\Models\User;
use App\Services\TweetService;
use Lib\Request;

class HomeController extends AuthenticatedController
{
    public function index()
    {
        $tab = $_GET['tab'] ?? 'public';
        if (!in_array($tab, ['public', 'followers'], true)) {
            $tab = 'public';
        }

        $tweetService = new TweetService();
        $tweets = $tweetService->getTimelineTweets((int) $this->authUser['id'], $tab);

        Request::render('home/index', [
            'auth_user' => $this->authUser,
            'tweets' => $tweets,
            'active_tab' => $tab,
        ]);
    }

    public function detail()
    {
        $id = (int) ($_GET['id'] ?? null);
        if (!$id) {
            header('Location: ' . BASE_URL . 'home/');
            exit;
        }

        $tweetService = new TweetService();

        $tweet_data = $tweetService->getTweetDetail((int) $id, (int) $this->authUser['id']);
        if (!$tweet_data) {
            header('Location: ' . BASE_URL . 'home/');
            exit;
        }

        Request::render('home/detail', [
            'auth_user' => $this->authUser,
            'tweet' => $tweet_data,
            'replies' => $tweet_data['replies'],
        ]);
    }

    public function user_tweets()
    {
        // ユーザIDを取得
        $user_id = $_GET['id'] ?? null;

        // ユーザ検索
        $user = new User();
        $user_data = $user->find($user_id);
        if (!$user_data) {
            // ユーザいない場合はホームにリダイレクト
            header('Location: ' . BASE_URL . 'home/');
            exit;
        }
        // ユーザ投稿
        $tweet = new Tweet();
        $tweets = $tweet->getByUserID((int) $user_data['id'], (int) $this->authUser['id']);

        // Viewをレンダリング: app/views/home/user_tweets.view.php
        Request::render('home/user_tweets', ['tweets' => $tweets]);
    }

    public function add()
    {
        // POSTデータを取得
        $posts = sanitize($_POST);

        // 投稿処理
        $tweet = new Tweet();
        $tweet->insert($this->authUser['id'], $posts);

        // トップにリダイレクト
        header('Location: ' . BASE_URL . 'home/');
        exit;
    }

    public function search()
    {
        $keyword = trim((string) ($_GET['keyword'] ?? ''));
        $tweets = [];

        if ($keyword !== '') {
            $tweetService = new TweetService();
            $tweets = $tweetService->searchTweets($keyword, (int) $this->authUser['id']);
        }

        Request::render('home/search', [
            'auth_user' => $this->authUser,
            'keyword' => $keyword,
            'tweets' => $tweets,
        ]);
    }

    public function like()
    {
        // POSTリクエスト以外は処理しない
        if (!Request::isPost()) {
            header('Location: ' . BASE_URL . 'home/');
            exit;
        }

        $tweet_id = $_POST['tweet_id'] ?? null;
        $user_id = $_POST['user_id'] ?? null;

        if ($tweet_id && $user_id) {
            $like = new Like();
            $like->update($tweet_id, $user_id);
        }

        // ホームにリダイレクト
        header('Location: ' . BASE_URL . 'home/');
        exit;
    }

    public function garally()
    {
        $tweet = new Tweet();

        Request::render('home/garally', [
            'auth_user' => $this->authUser,
            'tweets' => $tweet->getImages() ?? [],
        ]);
    }

    public function delete()
    {
        // POSTリクエスト以外は処理しない
        if (!Request::isPost()) {
            header('Location: ' . BASE_URL . 'home/');
            exit;
        }

        // POSTデータを取得
        $posts = sanitize($_POST);

        // ログインユーザのIDと投稿のユーザIDが一致しない場合はホームにリダイレクト
        if ((int) $this->authUser['id'] !== (int) $posts['user_id']) {
            header('Location: ' . BASE_URL . 'home/');
            exit;
        }

        // 削除処理
        $tweet = new Tweet();
        $tweet->delete($posts['tweet_id']);

        // ホームにリダイレクト
        header('Location: ' . BASE_URL . 'home/');
        exit;
    }
}
