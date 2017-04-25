</div> 

</body>

<footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function(){
            checkFollowBttnState();

            $('#tweet_button').click(function(){
                sendTweet();
            });

            $('#follow_button').click(function () {
                follow();
            })
        });

        function checkFollowBttnState() {
            var data = "username=" + $("#user_found").text();
            $.post(
                '../scripts/follow_bttn_state.php',
                data,
                function(data){
                    if (data === "unfollow") {
                        $('#follow_button').html("Unfollow");
                    }
                    else if (data === "follow") {
                        $('#follow_button').html("Follow");
                    }
                    else if (data === "yourself") {
                        $('#follow_button').prop('disabled', true);
                        $('#follow_button').prop('title', "You cannot follow yourself");
                    }
                }
            );
        }

        function sendTweet() {
            var data = "tweet_msg="+$("#tweet_msg").val();
            $.post(
                '../scripts/send_tweet.php',
                data,
                function(data){
                    $("#tweets").prepend(data);
                    var tweets = parseInt($("#nb_tweets").text(), 10);
                    $("#nb_tweets").html(tweets + 1 + " Tweets");
                },
                'html'
            );
            return false;
        }

        function follow() {
            var data = "username=" + $("#user_found").text();
            if ($('#follow_button').text() === "Follow") {
                $.post(
                    '../scripts/follow.php',
                    data,
                    function () {
                        var following = parseInt($("#nb_following").text(), 10);
                        var followers = parseInt($("#nb_followers").text(), 10);
                        $("#nb_following").html(following + 1 + " Following");
                        $("#nb_followers").html(followers + 1);
                        $('#follow_button').html("Unfollow");
                    }
                );
            }
            else if ($('#follow_button').text() === "Unfollow") {
                $.post(
                    '../scripts/unfollow.php',
                    data,
                    function (data) {
                        var following = parseInt($("#nb_following").text(), 10);
                        var followers = parseInt($("#nb_followers").text(), 10);
                        $("#nb_following").html(following - 1 + " Following");
                        $("#nb_followers").html(followers - 1);
                        $('#follow_button').html("Follow");
                    }
                );
            }
        }
    </script>
</footer>
</html>
