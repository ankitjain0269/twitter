<html>
<body>
<table border="2">
    @foreach($tweets as $tweet)
    <tr>
        <td>id: {{$tweet['id']}}</td>
<td>tweet: {{$tweet['text']}}</td>
<td>Re tweets: {{$tweet['retweet_count']}}</td>

    </tr>
    @endforeach

</table>
</body>
</html>