<?php
// TODO: CHECK SQL INJECTION PREVENTION
// Setting absoulute path to prevent errors caused by nesting in the folders
$rootPath = $_SERVER['DOCUMENT_ROOT'];
$dbPath = $rootPath . "/database/index.php";
include_once($dbPath);
class City
{
    private $db;
    private $table = 'cities';

    public function __construct()
    {
        $this->db = new Database();
    }

    // CREATE OPS
    public function create(
        $name,
        $inhabitants,
        $Employees,
        $Coordinates,
        $Objects,
        $Region
    ) {
        try {
            $statement = "INSERT INTO cities (name, inhabitans_cnt, employees_cnt, coordinates, object_cnt, region) VALUES ('$name', $inhabitants, $Employees, '$Coordinates', $Objects, '$Region')";
            $query = $this->db->queryRaw($statement);
            if ($query == true) {
                return true;
            } else {
                throw new Exception("Error Processing Request: troubled statement", 1);
            }
        } catch (Exception $e) {
            return $e;
        }
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
    }

    public function getById($value)
    {
        try {
            $result = $this->db->queryRaw("SELECT * FROM $this->table WHERE id = $value");
            $this->db->close();
            return $result;
        } catch (Exception $e) {
            var_dump($e->getMessage());
            return $e;
        }
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
        $query = "SELECT * FROM cities WHERE $queryString";;
        try {
            $result = $this->db->queryRaw($query);
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
            $name = $array["cities-name"];
            $inhabitans_cnt = $array["inhabitants"];
            $employees_cnt = $array["Employees"];
            $coordinates = $array["Coordinates"];
            $object_cnt = $array["Objects"];
            $region = $array["Region"];
            $statement = "UPDATE $this->table SET name='$name', inhabitans_cnt=$inhabitans_cnt, employees_cnt=$employees_cnt, coordinates='$coordinates', object_cnt=$object_cnt, region='$region' WHERE id = $id;";
            $result = $this->db->queryRaw($statement);
            $this->db->close();
            return $result;
        } catch (Exception $e) {
            var_dump($e->getMessage());
            return $e;
        }
    }

    // DELETE OPS
    public function deleteById($value)
    {
        try {
            $result = $this->db->queryRaw("DELETE FROM $this->table WHERE id = $value");
            $this->db->close();
            return $result;
        } catch (Exception $e) {
            var_dump($e->getMessage());
            return $e;
        }
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

    public function getStat($column, $condition, $op = "")
    {
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
