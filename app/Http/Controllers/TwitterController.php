<?php

namespace App\Http\Controllers;

use App\Helpers\TwitterHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

/**
 * Class TwitterController
 *
 * @package App\Http\Controllers
 * @author  Ankit
 */
class TwitterController extends Controller
{

    /**
     * Return home view.
     *
     * @return \Illuminate\Support\Facades\View
     * @author Ankit
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Returns Tweet in a formatted html on the basis of user input.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Helpers\TwitterHelper $twitterHelper
     *
     * @return \Illuminate\Http\Response|\Laravel\Lumen\Http\ResponseFactory|string
     * @author Ankit
     */
    public function getTweets(Request $request, TwitterHelper $twitterHelper)
    {
        $tweets = $twitterHelper->fetchTweets($request->get('keyword', '#custserv'), $request->get('count', 10), $request->since_id);
        if ($twitterHelper->hasError())
            return response(['error' => $twitterHelper->getError()], 422);

        $sinceId = !empty($tweets) ? end($tweets)['id'] : null;
        return json_encode(['since_id' => $sinceId, 'tweets' => View::make('tweets', compact('tweets'))->render()], 200);
    }
}
