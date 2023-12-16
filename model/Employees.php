<?php
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
    private $modificationDate = 'modification_date';

     public function __construct()
    {
        $this->db = new Database();
    }

    public function create($fname, $lname, $email, $phone, $salary, $modificationDate)
    {
        try {
            $statement = "INSERT INTO $this->table ($this->firstName, $this->lastName, $this->email, $this->phone, $this->salary, $this->modificationDate) VALUES ('$fname',  '$lname', '$email', '$phone',  '$salary', '$modificationDate')";
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

     public function deleteById($value)
    {
        try {
            $result = $this->db->queryRaw("DELETE FROM $this->table WHERE $this->id = $value");
            $this->db->close();
            return $result;
        } catch (Exception $e) {
            var_dump($e->getMessage());
            return $e;
        }
        return false;
    }


    public function getById($value)
    {
        try {
            $result = $this->db->queryRaw("SELECT * FROM $this->table WHERE $this->id = $value");
            $this->db->close();
            return $result;
        } catch (Exception $e) {
            var_dump($e->getMessage());
            return $e;
        }
        return false;
    }

    public function updateById($id, $array)
    {
        try {
            $query = "";
            $lastColumnValue = end($array);
            foreach ($array as $key => $value) {
                if ($key == "employees") {
                    continue;
                } else {
                    $quotes = in_array($key, ["salary"]) ? "" : '"';
                    $comma = ($value == $lastColumnValue) ? '' : ',';
                    $query = $query . " $key=$quotes$value$quotes $comma";
                }
            }
            if (empty($array)) {
                throw new Exception("Error Processing Request: empty update array", 1);
            }
            $statement = "UPDATE $this->table SET $query WHERE $this->id = $id";
            $result = $this->db->queryRaw($statement);
            $this->db->close();
            return $result;
        } catch (Exception $e) {
            var_dump($e->getMessage());
            return $e;
        }
        return false;
    }
    public function getLastModDate(){
        return $this->db->queryRaw("SELECT MAX(modification_date) FROM $this->table")->fetch_row()[0];
    }
}