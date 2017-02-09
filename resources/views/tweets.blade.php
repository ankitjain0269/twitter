{{--Create tweet block--}}
@foreach($tweets as $tweet)
    <div class="col-xs-12 col-md-6 col-lg-4">
        <div class="card panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">{{'@'.$tweet['twitter_handle']}}</h3>
            </div>
            <div class="panel-body">
                {{$tweet['text']}}
            </div>
            <div class="panel-footer  alert-info">
                <span class="glyphicon glyphicon-retweet" aria-hidden="true"></span> <span>Retweet Count</span>
                <span class="label label-warning">{{$tweet['retweet_count']}}</span>
            </div>
        </div>
    </div>
@endforeach

