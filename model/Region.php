<?php
// TODO: CHECK SQL INJECTION PREVENTION
// Setting absoulute path to prevent errors caused by nesting in the folders
$rootPath = $_SERVER['DOCUMENT_ROOT'];
$dbPath = $rootPath . "/database/index.php";
include_once($dbPath);
class Region
{
    private $db;
    private $table = 'regions';
    private $id = 'id';
    private $name = 'name';
    private $lat = 'lat';
    private $lon = 'lon';
    private $collection_interval = 'collection_interval';
    private $threshold = 'threshold';
    private $budget = 'budget';
    private $modification_date = 'modification_date';
    public $schema;

    public function __construct()
    {
        $this->db = new Database();
    }

    // CREATE OPS
    public function create($name, $lat, $lon, $collection_interval, $threshold, $budget, $modificationDate)
    {
        try {
            $statement = "INSERT INTO $this->table ($this->name, $this->lat, $this->lon, $this->collection_interval, $this->threshold, $this->budget, $this->modification_date)  VALUES ('$name', $lat, $lon, '$collection_interval', $threshold, $budget, '$modificationDate')";
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

    public function getByInterval($value)
    {
        try {
            $result = $this->db->queryRaw("SELECT * FROM $this->table WHERE $this->collection_interval = '$value'");
            $this->db->close();
            return $result;
        } catch (Exception $e) {
            var_dump($e->getMessage());
            return $e;
        }
        return false;
    }

    // UPDATE OPS
    public function updateById($id, $array)
    {
        try {
            $query = "";
            $lastColumnValue = end($array);
            foreach ($array as $key => $value) {
                if ($key == "storage") {
                    continue;
                } else {
                    $quotes = in_array($key, ["lat", "lon", "threshold", "budget"]) ? "" : '"';
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

    public function getByFilters($filters)
    {
        // Prepare query string from conditions
        if ($filters == []) {
            return [];
        }
        $lastElement = count($filters) - 1;
        $counter = 0;
        $queryString = "";
        foreach ($filters as $key => $value) {
            if ($counter == $lastElement) {
                $queryString = $queryString . "$key='$value'";
            } else {
                $queryString = $queryString . "$key='$value'" . " AND ";
            }
            $counter += 1;
        }
        $query = "SELECT * FROM regions WHERE $queryString";;
        try {
            $result = $this->db->queryRaw($query);
            return $result;
        } catch (Exception $e) {
            var_dump($e->getMessage());
            return $e;
        }
        return false;
    }
}
