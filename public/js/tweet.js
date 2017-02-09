var sinceId = 0;
$(document).ready(function () {
    getTweets(sinceId);
});

//Get tweets from server
function getTweets() {

    $.ajax("get-tweets", {
        data: {since_id: sinceId},
        success: displayTweets,
        type: "GET",
        error: renderError,
        beforeSend: function () {
            $(".tweet-button").text('loading ...');
            $(".tweet-button").attr('disabled', 'disabled');
        },
    });
}

//Display Tweets
var displayTweets = function (data) {
    data = JSON.parse(data);
    if (data['since_id'] != null)
        sinceId = data['since_id'];
    $(".twitter-home").append(data['tweets']);
    enableButton(".tweet-button", 'Get Me Some Tweets');
};

//Show error
var renderError = function (data) {
    var dataArray = jQuery.parseJSON(data.responseText);
    $('#error').text(dataArray['error']);
    $('#error-modal').modal("show");
    enableButton(".tweet-button", 'Get Me Some Tweets');
};

//Enable buttons
function enableButton(buttonIdentifier, text) {
    $(buttonIdentifier).text(text);
    $(buttonIdentifier).removeAttr('disabled');
}