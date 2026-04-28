<?php

namespace App\Controllers;

use App\Models\Tweet;
use App\Models\User;
use App\Models\AuthUser;
use App\Models\Follow;
use App\Requests\UserUpdateRequest;
use App\Services\TweetService;
use Lib\Request;
use Lib\View;

class UserController extends AuthenticatedController
{
    private function findRequestedUser(): ?array
    {
        $user_id = (int) ($_GET['id'] ?? $this->authUser['id']);

        $user = new User();
        return $user->find($user_id);
    }

    private function buildProfileData(array $user_data): array
    {
        $tweet = new Tweet();
        $follow = new Follow();

        return [
            'tweet_count' => (int) $tweet->countByUserID($user_data['id']),
            'follow_count' => $follow->countFollowing((int) $user_data['id']),
            'follower_count' => $follow->countFollowers((int) $user_data['id']),
            'is_following' => (int) $this->authUser['id'] === (int) $user_data['id']
                ? false
                : (bool) $follow->fetch((int) $this->authUser['id'], (int) $user_data['id']),
        ];
    }

    public function update()
    {
        $posts = UserUpdateRequest::validateOrRedirect();

        $user = new User();
        $result = $user->update($this->authUser['id'], $posts);

        if (!$result) {
            $_SESSION[APP_KEY]['user_edit'] = [
                'form' => $posts,
                'error' => '更新に失敗しました。',
            ];
            header('Location: ' . BASE_URL . 'user/edit.php');
            exit;
        }

        // ユーザ情報をセッションに保存
        $this->authUser = $user->find($this->authUser['id']);
        AuthUser::set($this->authUser);
        $_SESSION[APP_KEY]['user_edit'] = [
            'success' => '保存しました。',
        ];

        header('Location: ' . BASE_URL . 'user/edit.php');
        exit;
    }

    public function edit()
    {
        // ユーザ情報をDBから再読み込み
        $user = new User();
        $this->authUser = $user->find($this->authUser['id']);
        $editState = $_SESSION[APP_KEY]['user_edit'] ?? [];
        unset($_SESSION[APP_KEY]['user_edit']);

        // Viewをレンダリング: app/views/user/edit.view.php
        View::render('user/edit', [
            'auth_user' => $this->authUser,
            'form' => $editState['form'] ?? [],
            'error' => $editState['error'] ?? null,
            'success' => $editState['success'] ?? null,
        ]);
    }

    public function follow()
    {
        if (!Request::isPost()) {
            header('Location: ' . BASE_URL . 'user/');
            exit;
        }

        $followee_id = (int) ($_POST['followee_id'] ?? 0);

        if ($followee_id && $followee_id !== (int) $this->authUser['id']) {
            $follow = new Follow();
            $follow->insert($this->authUser['id'], $followee_id);
        }

        header('Location: ' . BASE_URL . 'user/?id=' . $followee_id);
        exit;
    }

    public function unfollow()
    {
        if (!Request::isPost()) {
            header('Location: ' . BASE_URL . 'user/');
            exit;
        }

        $followee_id = (int) ($_POST['followee_id'] ?? 0);

        if ($followee_id) {
            $follow = new Follow();
            $follow->delete($this->authUser['id'], $followee_id);
        }

        header('Location: ' . BASE_URL . 'user/?id=' . $followee_id);
        exit;
    }

    public function index()
    {
        $user_data = $this->findRequestedUser();
        if (!$user_data) {
            header('Location: ' . BASE_URL . 'home/');
            exit;
        }

        $profile = $this->buildProfileData($user_data);
        $tweet = new Tweet();
        $tweetService = new TweetService();

        View::render('user/index', [
            'auth_user' => $this->authUser,
            'user_data' => $user_data,
            'tweets' => $tweetService->hydrateTweets(
                $tweet->getByUserID((int) $user_data['id'], (int) $this->authUser['id']),
                (int) $this->authUser['id']
            ),
            'active_tab' => 'posts',
            ...$profile,
        ]);
    }

    public function following()
    {
        $user_data = $this->findRequestedUser();
        if (!$user_data) {
            header('Location: ' . BASE_URL . 'home/');
            exit;
        }

        $follow = new Follow();
        $users = $follow->getFollowingUsers((int) $user_data['id']);

        View::render('user/following', [
            'auth_user' => $this->authUser,
            'user_data' => $user_data,
            'users' => $users,
            'active_tab' => 'following',
            ...$this->buildProfileData($user_data),
        ]);
    }

    public function followers()
    {
        $user_data = $this->findRequestedUser();
        if (!$user_data) {
            header('Location: ' . BASE_URL . 'home/');
            exit;
        }

        $follow = new Follow();
        $users = $follow->getFollowerUsers((int) $user_data['id']);

        View::render('user/followers', [
            'auth_user' => $this->authUser,
            'user_data' => $user_data,
            'users' => $users,
            'active_tab' => 'followers',
            ...$this->buildProfileData($user_data),
        ]);
    }
}
