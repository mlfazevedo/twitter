<div class="jumbotron">
    <div class="col-md-3">
        <h2>@<?=$user->getUsername()?></h2>
        <p><?=$user->getNbTweets()?> Tweets</p>
        <p><?=$user->getNbFollowers()?> Followers</p>
        <p id="nb_following"><?=$user->getNbFollowing()?> Following</p>
    </div>

    <div class="col-md-9">
        <?php
        if ($searched_user->exists()) {
            ?>
            <h2>@<?= $searched_user->getUsername() ?></h2>

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Username</th>
                        <th>Tweets</th>
                        <th>Followers</th>
                        <th>Following</th>
                        <th>Follow</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($stats as $stat) { ?>

                    <tr>
                        <td id="user_found"><?= $stat['username'] ?></td>
                        <td><?= $stat['tweets'] ?></td>
                        <td id="nb_followers"><?= $stat['followers'] ?></td>
                        <td><?= $stat['following'] ?></td>
                        <td><button id="follow_button" class="btn btn-xs btn-primary">Follow</button></td>
                    </tr>
                    <?php
                    }
                    ?>
                    </tbody>
                </table>
            </div>

            <h2>Latest tweets of <?= $searched_user->getUsername() ?></h2>
            <div id="tweets" class="panel-group">
                <?php foreach ($tweets as $tweet) { ?>

                    <div class="panel panel-primary">
                        <div class="panel-heading"><?= $tweet->getUsername() ?> - <?=$tweet->getDate()?></div>
                        <div class="panel-body"><?=$tweet->getTweet()?></div>
                    </div>

                <?php } ?>
            </div>
            <?php
        } else { ?>
            <h2>User @<?=$searched_user->getUsername()?> does not exists.</h2>
            <?php
        }
        ?>
    </div>
</div>