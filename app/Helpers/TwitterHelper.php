<?php

namespace App\Helpers;


use Abraham\TwitterOAuth\TwitterOAuth;

/**
 * Class TwitterHelper
 *
 * @package App\Helpers
 * @author  Ankit
 */
class TwitterHelper
{
    /**
     * @var \Abraham\TwitterOAuth\TwitterOAuth
     */
    private $twitterClient;

    /**
     * @var null
     */
    private $error = null;

    /**
     * Setting twitter client.
     *
     * Twitter constructor.
     */
    public function __construct()
    {
        $this->twitterClient = new TwitterOAuth(env('TWITTER_CONSUMER_KEY'), env('TWITTER_CONSUMER_SECRET'), env('TWITTER_ACCESS_TOKEN'), env('TWITTER_ACCESS_TOKEN_SECRET'));
    }

    /**
     * Fetch tweets by hitting Twitter API on the basis
     *
     * @param $query
     * @param int $count
     * @param null $sinceId
     *
     * @return array|bool
     * @author Ankit
     */
    public function fetchTweets($query, $count = 20, $sinceId = null)
    {

        try {
            $content = $this->twitterClient->get("search/tweets", ["q" => $query, 'result_type' => 'popular', 'count' => $count, 'since_id' => $sinceId]);
            if ($this->twitterClient->getLastHttpCode() != 200) {
                $this->setError('Something seems to be gone wrong!');
                return false;
            }
        } catch (\Exception $e) {
            $this->setError($e->getMessage());
            return false;
        }
        $tweets = $this->sanitizeTweets((array)$content->statuses);
        return array_map([$this, 'mapTweetData'], $tweets);
    }

    /**
     * Map Twitter data
     *
     * @param $tweet
     *
     * @return array
     * @author Ankit
     */
    private function mapTweetData($tweet)
    {
        return [
            'id' => $tweet->id,
            'text' => $tweet->text,
            'twitter_handle' => $tweet->user->screen_name,
            'retweet_count' => $tweet->retweet_count
        ];
    }

    /**
     * Remove Tweet having retweet count less then zero.
     *
     * @param array $tweets
     *
     * @return array
     * @author Ankit
     */
    private function sanitizeTweets(array $tweets)
    {
        return array_filter($tweets, function ($tweet) {
            return !!$tweet->retweet_count;
        });
    }

    /**
     * Check for error.
     *
     * @return bool
     * @author Ankit
     */
    public function hasError()
    {
        return !empty($this->error);
    }

    /**
     * @return null
     * @author Ankit
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * @param $error
     *
     * @author Ankit
     */
    public function setError($error)
    {
        $this->error = $error;
    }

}