<?php


$app->get('/', 'TwitterController@index');
$app->get('get-tweets', 'TwitterController@getTweets');
