<?php
include_once("Database.class.php");
include("Tweet.class.php");


class User {

    private $username;
    private $mysqli;

    /**
     * User constructor.
     * @param $username name of this user
     */
    public function __construct($username) {
        $this->username = $username;
        $db = new Database();
        $this->mysqli = $db->getConnection();
    }

    /**
     * @return bool True if this user exists
     */
    public function exists() {
        $query = "SELECT * FROM USERS WHERE username='$this->username'";
        $result = $this->mysqli->query($query);
        return mysqli_num_rows($result);
    }

    public function validPassword($password) {
        $pwd = md5(mysqli_real_escape_string($this->mysqli, $password));

        $query = "SELECT username FROM USERS WHERE username = '" . $this->username . "' AND password = '" . $pwd . "'";
        $checklogin = $this->mysqli->query($query);
        $result = mysqli_fetch_array($checklogin);

        return count($result);
    }


    /**
     * Insert new user into DB
     * @param $first_name
     * @param $last_name
     * @param $email
     * @param $password
     * @return string Indicates if insertion succeeded
     */
    public function createUser($first_name, $last_name, $email, $password) {

        $first_name = mysqli_real_escape_string($this->mysqli, $first_name);
        $last_name = mysqli_real_escape_string($this->mysqli, $last_name);
        $password = md5(mysqli_real_escape_string($this->mysqli, $password));
        $email = mysqli_real_escape_string($this->mysqli, $email);

        $query = "SELECT email FROM USERS where email='".$email."'";
        $result_email = mysqli_query($this->mysqli, $query);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return "invalid_email";
        }
        elseif(mysqli_num_rows($result_email)) {
            return "email_already_exists";
        }
        elseif ($this->exists()) {
            return "username_already_exists";
        }
        else {
            $query = "INSERT INTO USERS ".
                "(username, email, password, last_name, first_name) ".
                "VALUES ".
                "('$this->username','$email','$password', '$last_name', '$first_name')";
            mysqli_query($this->mysqli, $query);

            $query = "INSERT INTO USER_STATS ".
                "(username, tweets, followers, following) ".
                "VALUES ".
                "('$this->username', 0, 0, 0)";
            mysqli_query($this->mysqli, $query);
            return "success";
        }
    }
    
    /**
     * @param $other_user String Username of user to follow
     * @return bool True if $other_user is followed by current user
     */
    public function isFollowing($other_user) {
        $query = "SELECT * FROM FOLLOWERS " .
            "WHERE username='$other_user' AND follower='$this->username';";
        $result = $this->mysqli->query($query);
        $follower = mysqli_fetch_array($result);

        return count($follower) > 0;
    }

    /**
     * @return int Number of tweets sent
     */
    public function getNbTweets() {
        $query = "SELECT tweets FROM USER_STATS ".
            "WHERE username = '$this->username';";
        $result = $this->mysqli->query($query);
        $row = mysqli_fetch_assoc($result);

        return $row["tweets"];
    }

    /**
     * @return int Number of followers
     */
    public function getNbFollowers() {
        $query = "SELECT followers FROM USER_STATS ".
            "WHERE username = '$this->username';";
        $result = $this->mysqli->query($query);
        $row = mysqli_fetch_assoc($result);

        return $row["followers"];
    }

    /**
     * @return int Number of following
     */
    public function getNbFollowing() {
        $query = "SELECT following FROM USER_STATS ".
            "WHERE username = '$this->username';";
        $result = $this->mysqli->query($query);
        $row = mysqli_fetch_assoc($result);

        return $row["following"];
    }

    /**
     * @return array Latest tweets sent by current user
     */
    public function getTweets() {
        $tweets = [];
        $query = "SELECT * FROM TWEETS " .
            "WHERE username = '$this->username'" .
            "ORDER BY date DESC ";
        $result = $this->mysqli->query($query);
        foreach ($result as $line) {
            $tweets[] = new Tweet($line['username'], $line['tweet'], $line['date']);
        }
        return $tweets;
    }

    /**
     * @return array Latest tweets sent by current user and users followed
     */
    public function getTweetsFollowing() {
        $tweets = [];
        $query1 = "SELECT T1.* FROM TWEETS as T1 ".
            "JOIN (SELECT username FROM FOLLOWERS WHERE follower='$this->username') AS T2 ".
            "ON T1.username = T2.username";

        // select tweets of current user
        $query2 = "SELECT * FROM TWEETS WHERE username='$this->username'";

        $query3 = "$query1 UNION $query2 ".
            "ORDER BY date DESC ";
        $result = $this->mysqli->query($query3);
        foreach ($result as $line) {
            $tweets[] = new Tweet($line['username'], $line['tweet'], $line['date']);
        }
        return $tweets;
    }

    /**
     * @return array Contains username, nb of tweets, nb of followers and nb of following
     */
    public function getStats() {
        $stats = [];
        $query = "SELECT * FROM USER_STATS ".
            "WHERE username='$this->username'";
        $result = $this->mysqli->query($query);
        foreach ($result as $line) {
            $stats[] = array(
                "username" => $line['username'],
                "tweets" => $line['tweets'],
                "followers" => $line['followers'],
                "following" => $line['following']);
        }
        return $stats;
    }

    /**
     * @param $tweet_text Tweet to be sent
     * @return Tweet Instance of Tweet
     */
    public function sendTweet($tweet_text) {
        $curdate = date('Y-m-d H:i:s');
        $tweet = new Tweet($this->username, $tweet_text, $curdate);
        
        // Insert tweet into DB
        $query = "INSERT INTO TWEETS ".
            "(username, tweet, date) ".
            "VALUES ".
            "('$this->username','$tweet_text','$curdate')";
        mysqli_query($this->mysqli, $query);

        // Increment number of tweets sent
        $query = "UPDATE USER_STATS ".
            "SET tweets = tweets + 1 ".
            "WHERE username = '$this->username';";
        mysqli_query($this->mysqli, $query);
        
        return $tweet;
    }

    /**
     * @param $other_user User to follow
     */
    public function follow($other_user) {
        $username = $this->username;

        // Insert follower into DB
        $query = "INSERT INTO FOLLOWERS ".
            "(username, follower) ".
            "VALUES ".
            "('$other_user','$username')";
        mysqli_query($this->mysqli, $query);

        // Increment followers of 'searched_user'
        $query = "UPDATE USER_STATS ".
            "SET followers = followers + 1 ".
            "WHERE username = '$other_user';";
        mysqli_query($this->mysqli, $query);

        // Increment following of 'username'
        $query = "UPDATE USER_STATS ".
            "SET following = following + 1 ".
            "WHERE username = '$username';";
        mysqli_query($this->mysqli, $query);
    }

    /**
     * @param $other_user User to unfollow
     */
    public function unfollow($other_user) {
        $username = $this->username;

        // Delete follower
        $query = "DELETE FROM FOLLOWERS ".
            "WHERE username='$other_user' AND follower='$username';";
        mysqli_query($this->mysqli, $query);

        // Decrement followers of 'searched_user'
        $query = "UPDATE USER_STATS ".
            "SET followers = followers - 1 ".
            "WHERE username = '$other_user';";
        mysqli_query($this->mysqli, $query);

        // Decrement following of 'username'
        $query = "UPDATE USER_STATS ".
            "SET following = following - 1 ".
            "WHERE username = '$username';";
        mysqli_query($this->mysqli, $query);
    }

    /**
     * @return string Username of current user
     */
    public function getUsername() {
        return $this->username;
    }
}
