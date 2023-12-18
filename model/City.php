<?php
// TODO: CHECK SQL INJECTION PREVENTION
include_once("../database/index.php");
class City
{
    private $db;
    private $table = '';

    public function __construct()
    {
        $this->db = new Database();
    }

    // CREATE OPS
    public function create()
    {
    }

    // READ OPS
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

    public function getById($value)
    {
        // try {
        //     $result = $this->db->queryRaw("SELECT * FROM $this->table WHERE $this->id = $value");
        //     $this->db->close();
        //     return $result;
        // } catch (Exception $e) {
        //     var_dump($e->getMessage());
        //     return $e;
        // }
        // return false;
    }

    public function getByIds($array)
    {
        // try {
        //     $queryString = "";
        //     foreach ($array as $key => $value) {
        //         $queryString = $queryString . " OR $this->id = $value";
        //     }
        //     if (empty($queryString)) {
        //         throw new Exception("Error Processing Request: empty query string", 1);
        //     }
        //     $result = $this->db->queryRaw("SELECT * FROM $this->table WHERE $this->id = $value $queryString");
        //     $this->db->close();
        //     return $result;
        // } catch (Exception $e) {
        //     var_dump($e->getMessage());
        //     return $e;
        // }
        // return false;
    }

    public function getByCategory($value)
    {
        // try {
        //     $result = $this->db->queryRaw("SELECT * FROM $this->table WHERE $this->category = '$value'");
        //     $this->db->close();
        //     return $result;
        // } catch (Exception $e) {
        //     var_dump($e->getMessage());
        //     return $e;
        // }
        // return false;
    }

    public function getByType($value)
    {
        // try {
        //     $result = $this->db->queryRaw("SELECT * FROM $this->table WHERE $this->type = '$value'");
        //     $this->db->close();
        //     return $result;
        // } catch (Exception $e) {
        //     var_dump($e->getMessage());
        //     return $e;
        // }
        // return false;
    }

    // UPDATE OPS
    // TODO: Improve this function
    public function updateById($id, $array)
    {
        // try {
        //     $query = "";
        //     $lastColumnValue = end($array);
        //     foreach ($array as $key => $value) {
        //         if ($key == "storage") {
        //             continue;
        //         } else {
        //             $quotes = in_array($key, ["volume", "value", "quantity", "lifetime"]) ? "" : '"';
        //             $comma = ($value == $lastColumnValue) ? '' : ',';
        //             $query = $query . " $key=$quotes$value$quotes $comma";
        //         }
        //     }
        //     if (empty($array)) {
        //         throw new Exception("Error Processing Request: empty update array", 1);
        //     }
        //     $statement = "UPDATE $this->table SET $query WHERE $this->id = $id";
        //     $result = $this->db->queryRaw($statement);
        //     $this->db->close();
        //     return $result;
        // } catch (Exception $e) {
        //     var_dump($e->getMessage());
        //     return $e;
        // }
        // return false;
    }

    // DELETE OPS
    public function deleteById($value)
    {
        // try {
        //     $result = $this->db->queryRaw("DELETE FROM $this->table WHERE $this->id = $value");
        //     $this->db->close();
        //     return $result;
        // } catch (Exception $e) {
        //     var_dump($e->getMessage());
        //     return $e;
        // }
        // return false;
    }

    public function deleteByIds($array)
    {
        // try {
        //     $queryString = "";
        //     foreach ($array as $key => $value) {
        //         $queryString = $queryString . " OR $this->id = $value";
        //     }
        //     $result = $this->db->queryRaw("DELETE FROM $this->table WHERE $this->id = $value $queryString");
        //     $this->db->close();
        //     return $result;
        // } catch (Exception $e) {
        //     var_dump($e->getMessage());
        //     return $e;
        // }
        // return false;
    }

    public function getStat($column, $condition, $op = "") {
        // try {
        //     $statement = "SELECT COUNT($column) FROM $this->table WHERE $condition";
        //     if ($op == "sum") {
        //         $statement = "SELECT SUM($column) FROM $this->table";
        //     }
        //     $result = $this->db->queryRaw($statement);
        //     return $result;
        // } catch (Exception $e) {
        //     var_dump($e->getMessage());
        //     return $e;
        // }
        // return false;
        
    }
}
