<div class="jumbotron">
    <div class="col-md-3">
        <h2>@<?=$user->getUsername()?></h2>
        <p id="nb_tweets"><?=$user->getNbTweets()?> Tweets</p>
        <p><?=$user->getNbFollowers()?> Followers</p>
        <p><?=$user->getNbFollowing()?> Following</p>
    </div>

    <div class="col-md-9">
        <div class="form-group">
            <form>
                <textarea class="form-control" rows="2" id="tweet_msg" maxlength="140" placeholder="What's happening?"></textarea>
                <button type="submit" class="btn btn-default" id="tweet_button">Tweet</button>
            </form>
        </div>

        <h2>Latest tweets</h2>
        <div id="tweets" class="panel-group">
            <?php foreach ($tweets as $tweet) { ?>

            <div class="panel panel-primary">
                <div class="panel-heading"><?= $tweet->getUsername() ?> - <?=$tweet->getDate()?></div>
                <div class="panel-body"><?=$tweet->getTweet()?></div>
            </div>

            <?php } ?>
        </div>
    </div>
</div>