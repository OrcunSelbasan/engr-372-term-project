<?php
<<<<<<< HEAD
=======
// TODO: CHECK SQL INJECTION PREVENTION
>>>>>>> main
// Setting absoulute path to prevent errors caused by nesting in the folders
$rootPath = $_SERVER['DOCUMENT_ROOT'];
$dbPath = $rootPath . "/database/index.php";
include_once($dbPath);
class Task
{
    private $db;
    private $table = 'tasks';
<<<<<<< HEAD
    private $id ='id';
    private $title = 'title';
    private $team = 'team';
    private $status = 'status';
    private $binId = 'binId';
    private $truckId = 'truckId';
    private $modificationDate = 'modification_date';

     public function __construct()
=======
    private $id = 'id';
    private $employee_id = 'employee_id';
    private $storage_id = 'storage_id';
    private $interaction_time = 'interaction_time';
    private $region_id = 'region_id';

    public function __construct()
>>>>>>> main
    {
        $this->db = new Database();
    }

<<<<<<< HEAD
    

    public function create($title, $team, $status, $binId, $truckId, $modificationDate)
    {
        try {
            $statement = "INSERT INTO $this->table ($this->title, $this->team, $this->status, $this->binId, $this->truckId, $this->modificationDate) VALUES ('$title',  '$team', '$status', '$binId',  '$truckId', '$modificationDate')";
            $query = $this->db->queryRaw($statement);
            if ($query == true) {
                $statement = "UPDATE storage SET initial_status='active' WHERE id='$binId'";
                $query = $this->db->queryRaw($statement);
                $statement = "UPDATE storage SET initial_status='active' WHERE id='$truckId'";
                $query = $this->db->queryRaw($statement);
=======
    // CREATE OPS
    public function create(
        $employee_id,
        $storage_id,
        $interaction_time,
        $region_id
    ) {
        try {
            $statement = "INSERT INTO $this->table ($this->employee_id, $this->storage_id, $this->interaction_time, $this->region_id) VALUES ($employee_id, $storage_id, '$interaction_time', $region_id)";
            $query = $this->db->queryRaw($statement);
            if ($query == true) {
>>>>>>> main
                return true;
            } else {
                throw new Exception("Error Processing Request: troubled statement", 1);
            }
        } catch (Exception $e) {
            return $e;
        }
        return false;
    }

<<<<<<< HEAD
     public function getAll()
    {
        try {
            $result = $this->db->queryRaw("SELECT * FROM $this->table");
=======
    // READ OPS
    public function getAll()
    {
        try {
            $result = $this->db->queryRaw("SELECT * FROM $this->table");
            $result = $result->fetch_all(MYSQLI_ASSOC);
>>>>>>> main
            // $this->db->close();
            return $result;
        } catch (Exception $e) {
            var_dump($e->getMessage());
            return $e;
        }
        return false;
    }
<<<<<<< HEAD

    public function getRecordsByStatus($s)
    {
        try {
            $result = $this->db->queryRaw("SELECT * FROM $this->table WHERE status='$s'");
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
                    $quotes = in_array($key, ["team","binId","truckId"]) ? "" : '"';
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

    public function markDone($id){
        try {
            $entry = $this->db->queryRaw("SELECT * FROM $this->table WHERE $this->id = '$id'");
            $row = $entry->fetch_assoc();
            $binId = $row['binId'];
            $truckId = $row['truckId'];
            $statement = "UPDATE storage SET initial_status='passive' WHERE id='$binId'";
            $this->db->queryRaw($statement);
            $statement = "UPDATE storage SET initial_status='passive' WHERE id='$truckId'";
            $this->db->queryRaw($statement);
            $date = date('Y-m-d');
            $statement = "UPDATE $this->table SET status='done', modification_date='$date' WHERE id =".$id."";
            $result = $this->db->queryRaw($statement);
            $this->db->close();
            return $result;

        } catch (Exception $e) {
            var_dump($e->getMessage());
            return $e;
        }
        return false;
    }

    public function getByFilters($filters) {
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
        $query = "SELECT * FROM employees WHERE $queryString";;
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
=======
}
>>>>>>> main
