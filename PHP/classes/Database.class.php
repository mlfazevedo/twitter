<?php

class Database {
    private $connection;
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "PW_Twitter";

    public function __construct() {
        $this->connection = new mysqli($this->host, $this->username, $this->password, $this->database);

        if(mysqli_connect_error()) {
            trigger_error("Failed to connect to Database: " . mysqli_connect_error(), E_USER_ERROR);
        }
    }

    // Get mysqli connection
    public function getConnection() {
        return $this->connection;
    }
}
















