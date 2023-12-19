<?php
// TODO: CHECK SQL INJECTION PREVENTION
// Setting absoulute path to prevent errors caused by nesting in the folders
$rootPath = $_SERVER['DOCUMENT_ROOT'];
$dbPath = $rootPath . "/database/index.php";
include_once($dbPath);
class Task
{
    private $db;
    private $table = 'tasks';
    private $id = 'id';
    private $employee_id = 'employee_id';
    private $storage_id = 'storage_id';
    private $interaction_time = 'interaction_time';
    private $region_id = 'region_id';

    public function __construct()
    {
        $this->db = new Database();
    }

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
            $result = $result->fetch_all(MYSQLI_ASSOC);
            // $this->db->close();
            return $result;
        } catch (Exception $e) {
            var_dump($e->getMessage());
            return $e;
        }
        return false;
    }
}
