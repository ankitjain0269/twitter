<?php

namespace App\Http\Controllers;

use App\Helpers\TwitterHelper;

class TwitterController extends Controller
{
    public function getTweets(TwitterHelper $twitterHelper)
    {
        $tweets= $twitterHelper->fetchTweets('#custserv');
        if($twitterHelper->hasError())
            return $twitterHelper->getError();
        return view('tweet',['tweets'=>$tweets]);
    }
}
