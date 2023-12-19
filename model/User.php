<?php
// Setting absoulute path to prevent errors caused by nesting in the folders
$rootPath = $_SERVER['DOCUMENT_ROOT'];
$dbPath = $rootPath . "/database/index.php";
include_once($dbPath);
class User
{
    private $db;
    private $table = 'auth';

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getById($id)
    {
        $result = $this->db->queryRaw("SELECT * FROM $this->table WHERE id = $id");
        $this->db->close();
        return $result;
    }

    public function getByEmail($email)
    {
        $result = $this->db->queryRaw("SELECT * FROM $this->table WHERE email = '$email'");
        $this->db->close();
        return $result;
    }
}
