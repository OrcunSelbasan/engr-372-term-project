<?php
// TODO: CHECK SQL INJECTION PREVENTION
include("../database/index.php");
class Storage
{
    private $db;
    private $table = 'storage';
    private $id = 'id';
    private $category = 'category';
    private $volume = 'volume';
    private $volumeUnit = 'volume_unit';
    private $type = 'type';
    private $initialStatus = 'initial_status';
    private $value = 'value';
    private $valueUnit = 'value_unit';
    private $autonotfier = 'autonotifier';
    private $quantity = 'quantity';
    private $lifetime = 'lifetime';
    private $lifetimeUnit = 'lifetime_unit';
    private $temporaryStorage = 'temporary_storage';
    private $modificationDate = 'modification_date';
    public $schema;

    public function __construct()
    {
        $this->db = new Database();
    }

    // CREATE OPS
    public function create($category, $volume, $volumeUnit, $type, $initialStatus, $value, $valueUnit, $autonotfier, $quantity, $lifetime, $lifetimeUnit, $temporaryStorage, $modificationDate)
    {
        try {
            $statement = "INSERT INTO $this->table ($this->category, $this->volume, $this->volumeUnit, $this->type, $this->initialStatus, $this->value, $this->valueUnit, $this->autonotfier, $this->quantity, $this->lifetime, $this->lifetimeUnit, $this->temporaryStorage, $this->modificationDate) VALUES ('$category', $volume, '$volumeUnit', '$type', '$initialStatus', $value, '$valueUnit', '$autonotfier', $quantity, $lifetime, '$lifetimeUnit', '$temporaryStorage', '$modificationDate')";
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

    public function getByIds($array)
    {
        try {
            $queryString = "";
            foreach ($array as $key => $value) {
                $queryString = $queryString . " OR $this->id = $value";
            }
            if (empty($queryString)) {
                throw new Exception("Error Processing Request: empty query string", 1);
            }
            $result = $this->db->queryRaw("SELECT * FROM $this->table WHERE $this->id = $value $queryString");
            $this->db->close();
            return $result;
        } catch (Exception $e) {
            var_dump($e->getMessage());
            return $e;
        }
        return false;
    }

    public function getByCategory($value)
    {
        try {
            $result = $this->db->queryRaw("SELECT * FROM $this->table WHERE $this->category = '$value'");
            $this->db->close();
            return $result;
        } catch (Exception $e) {
            var_dump($e->getMessage());
            return $e;
        }
        return false;
    }

    public function getByType($value)
    {
        try {
            $result = $this->db->queryRaw("SELECT * FROM $this->table WHERE $this->type = '$value'");
            $this->db->close();
            return $result;
        } catch (Exception $e) {
            var_dump($e->getMessage());
            return $e;
        }
        return false;
    }

    // UPDATE OPS
    // TODO: Improve this function
    public function updateById($id, $array)
    {
        try {
            $query = "";
            $lastColumnValue = end($array);
            foreach ($array as $key => $value) {
                if ($key == "storage") {
                    continue;
                } else {
                    $quotes = in_array($key, ["volume", "value", "quantity", "lifetime"]) ? "" : '"';
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

    // DELETE OPS
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

    public function deleteByIds($array)
    {
        try {
            $queryString = "";
            foreach ($array as $key => $value) {
                $queryString = $queryString . " OR $this->id = $value";
            }
            $result = $this->db->queryRaw("DELETE FROM $this->table WHERE $this->id = $value $queryString");
            $this->db->close();
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
