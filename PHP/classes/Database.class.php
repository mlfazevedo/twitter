<?php

class Database {
    private $connection;
    private $host = "us-cdbr-azure-southcentral-f.cloudapp.net";
    private $username = "b6be0ce0ae9169";
    private $password = "10ecf166";
    private $database = "acsm_1f4da07b9663f60";

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
















