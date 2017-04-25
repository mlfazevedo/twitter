<?php

class Tweet {
    private $username;
    private $tweet;
    private $date;

    /**
     * Tweet constructor.
     * @param $username
     * @param $tweet
     * @param $date
     */
    public function __construct($username, $tweet, $date) 
    {
        $this->username = $username;
        $this->tweet = $tweet;
        $this->date = $date;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getTweet()
    {
        return $this->tweet;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }
    
    
}