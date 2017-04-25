<?php

class Database {
    private $connection;
    private $host = "eu-cdbr-azure-north-e.cloudapp.net";
    private $username = "b13cdde2b359d8";
    private $password = "6d4431bf";
    private $database = "twitter";

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
















