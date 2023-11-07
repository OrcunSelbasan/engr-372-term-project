<?php
include("../utils/constants.php");
class Database
{
    private $connection;

    public function __construct(String $username, String $password)
    {
        $user = isset($username) ? $username : Constants::DB_USER;
        $pwd = isset($password) ? $password : Constants::DB_PASSWORD;
        $this->connection = new mysqli(Constants::DB_HOST, $user, $pwd, Constants::DB_NAME);
        if (isset($this->connection->connect_error)) {
            die("Connection error: " . $this->connection->connect_error);
        }
    }

    public function queryRaw(String $query): mysqli_result|String
    {
        try {
            return $this->connection->query($query);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function ping(): void
    {
        $this->connection->ping();
    }

    public function close(): void
    {
        $this->connection->close();
    }
}
?>
