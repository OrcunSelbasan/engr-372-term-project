<?php
// TODO: CHECK SQL INJECTION PREVENTION
include_once("../database/index.php");
class Employees
{
    private $db;
    private $table = 'employees';
    private $id ='id';
    private $firstName = 'fname';
    private $lastName = 'lname';
    private $email = 'email';
    private $phone = 'phone';
    private $salary = 'salary';

     public function __construct()
    {
        $this->db = new Database();
    }

    public function create($fname, $lname, $email, $phone, $salary)
    {
        try {
            $statement = "INSERT INTO $this->table ($this->firstName, $this->lastName, $this->email, $this->phone, $this->salary) VALUES ('$fname',  '$lname', '$email', '$phone',  '$salary')";
            $query = $this->db->queryRaw($statement);
            if ($query == true) {
                return true;
            } else {
                throw new Exception("Error Processing Request: troubled statement", 1);
            }
        } catch (Exception $e) {
            return $e;
        }
        return false;
    }

     public function getAll()
    {
        try {
            $result = $this->db->queryRaw("SELECT * FROM $this->table");
            // $this->db->close();
            return $result;
        } catch (Exception $e) {
            var_dump($e->getMessage());
            return $e;
        }
        return false;
    }
    public function getStat($column, $condition, $op = "") {
        try {
            $statement = "SELECT COUNT($column) FROM $this->table WHERE $condition";
            if ($op == "sum") {
                $statement = "SELECT SUM($column) FROM $this->table";
            }
            $result = $this->db->queryRaw($statement);
            return $result;
        } catch (Exception $e) {
            var_dump($e->getMessage());
            return $e;
        }
        return false;
        
    }
}