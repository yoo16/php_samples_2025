<?php

namespace App\Controllers;

use App\Models\Tweet;
use App\Models\User;
use App\Models\AuthUser;
use Lib\Request;

class UserController
{
    public function __construct()
    {
        AuthUser::checkLogin();
    }

    public function update()
    {
        if (!Request::isPost()) {
            header('Location: ' . BASE_URL . 'user/edit/');
            exit;
        }

        $auth_user = AuthUser::get();
        $posts = sanitize($_POST);

        $user = new User();
        $user->update($auth_user['id'], $posts);

        // ユーザ情報をセッションに保存
        AuthUser::set($user->find($auth_user['id']));

        header('Location: ' . BASE_URL . 'user/edit/');
        exit;
    }

    public function edit()
    {
        $auth_user = AuthUser::get();

        // ユーザ情報をDBから再読み込み
        $user = new User();
        $auth_user = $user->find($auth_user['id']);

        // Viewをレンダリング: app/views/user/edit.view.php
        Request::render('user/edit', ['auth_user' => $auth_user]);
    }

    public function index()
    {
        $auth_user = AuthUser::get();
        $user_id = $_GET['id'] ?? $auth_user['id'];

        $user = new User();
        $user_data = $user->find($user_id);
        if (!$user_data) {
            header('Location: ' . BASE_URL . 'home/');
            exit;
        }

        $tweet = new Tweet();
        $tweets = $tweet->getByUserID($user_data['id']);
        $tweet_count = count($tweets);

        // Viewをレンダリング: app/views/user/index.view.php
        Request::render('user/index', [
            'auth_user'   => $auth_user,
            'user_data'   => $user_data,
            'tweets'      => $tweets,
            'tweet_count' => $tweet_count,
        ]);
    }
}
