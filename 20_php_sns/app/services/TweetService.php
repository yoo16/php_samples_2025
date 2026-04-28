<?php

namespace App\Services;

use App\Models\Reply;
use App\Models\Tweet;
use App\Models\User;

class TweetService
{
    public function getTimelineTweets(int $authUserId, string $tab = 'public', int $limit = 10, int $offset = 0): array
    {
        $tweet = new Tweet();
        $tweets = match ($tab) {
            'followers' => $tweet->getByFollowingUsers($authUserId, $limit, $offset),
            default => $tweet->get($authUserId, $limit, $offset),
        };

        return $this->hydrateTweets($tweets, $authUserId);
    }

    public function searchTweets(string $keyword, int $authUserId): array
    {
        $tweet = new Tweet();
        return $this->hydrateTweets($tweet->search($keyword, $authUserId), $authUserId);
    }

    public function getTweetDetail(int $tweetId, int $authUserId): ?array
    {
        $tweet = new Tweet();
        $reply = new Reply();

        $tweetData = $tweet->findWithUser($tweetId, $authUserId);
        if (!$tweetData) {
            return null;
        }

        $tweetData = $this->hydrateTweet($tweetData, $authUserId);
        $tweetData['replies'] = $this->hydrateReplies($reply->getByTweetId($tweetId));

        return $tweetData;
    }

    public function hydrateTweets(?array $tweets, int $authUserId): array
    {
        if (!$tweets) return [];

        foreach ($tweets as &$tweet) {
            $tweet = $this->hydrateTweet($tweet, $authUserId);
        }
        unset($tweet);

        return $tweets;
    }

    public function hydrateTweet(array $tweet, int $authUserId): array
    {
        // プロフィール画像を設定
        $tweet['profile_image_url'] = User::profileImage($tweet['profile_image'] ?? null);
        $tweet['liked'] = (bool) ($tweet['liked'] ?? false);

        if (empty($tweet['image_path'])) {
            $tweet['image_path'] = null;
        }

        $tweet['like_count'] = (int) ($tweet['like_count'] ?? 0);
        $tweet['reply_count'] = (int) ($tweet['reply_count'] ?? 0);

        return $tweet;
    }

    public function hydrateReplies(?array $replies): array
    {
        if (!$replies) {
            return [];
        }

        foreach ($replies as &$reply) {
            $reply['profile_image_url'] = User::profileImage($reply['profile_image'] ?? null);
        }
        unset($reply);

        return $replies;
    }
}
