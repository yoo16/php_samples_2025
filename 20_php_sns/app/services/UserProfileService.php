<?php

namespace App\Services;

use App\Models\Follow;
use App\Models\Tweet;
use App\Models\User;

class UserProfileService
{
    public function findRequestedUser(?int $requestedUserId, int $authUserId): ?array
    {
        $userId = $requestedUserId ?: $authUserId;
        $user = new User();

        return $user->find($userId);
    }

    public function buildProfileData(array $userData, int $authUserId): array
    {
        $tweet = new Tweet();
        $follow = new Follow();

        return [
            'tweet_count' => $tweet->countByUserID($userData['id']),
            'follow_count' => $follow->countFollowing((int) $userData['id']),
            'follower_count' => $follow->countFollowers((int) $userData['id']),
            'is_following' => (int) $authUserId === (int) $userData['id']
                ? false
                : (bool) $follow->fetch((int) $authUserId, (int) $userData['id']),
        ];
    }
}
