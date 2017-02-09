<html>
<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script type="text/javascript" src="/js/tweet.js"></script>
    <script type="text/javascript" src="/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="/css/tweet.css" />
</head>
<body>
{{--Tweets Container--}}
<div class="container-fluid">
    <div class="page-header">
        <h2 class="text-center"><code>#custserv</code> Tweets</h2>
    </div>
    <div class="row row-eq-height twitter-home">

    </div>
    <div class="text-center"><button type="button" class="btn btn-primary tweet-button" onclick="getTweets()">Get Me Some Tweets</button></div>

</div>
{{--Error Modal--}}
<div class="modal fade" id="error-modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header alert-danger">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Error</h4>
            </div>
            <div class="modal-body">
                <p id="error" class="text-center"></p>
            </div>
        </div>

    </div>
</div>
</body>
</html>