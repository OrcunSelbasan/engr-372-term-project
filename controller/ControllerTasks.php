<?php
// Setting absoulute path to prevent errors caused by nesting in the folders
$rootPath = $_SERVER['DOCUMENT_ROOT'];
$taskModelPath = $rootPath . "/model/Task.php";
include($taskModelPath);


class ControllerTask{
    private $entity;

    public function __construct() {
        $this -> entity = new Task();
    }

    public function createRecord($post)
    {
        $title = $post['task-title'];
        $team = $post['task-team'];
        $status = "in progress";
        $binId = $post['task-binId'];
        $truckId = $post['task-truckId'];
        $modificationDate = date('Y-m-d');

        

        $isSuccess = $this->entity->create(
            $title,
            $team ,
            $status ,
            $binId,
            $truckId,
            $modificationDate
        );

        return $isSuccess;
    }

    public function updateRecord($post)
    {
        $id = $post['task-object-id'];
        $title = $post['task-title'];
        $team = $post['task-team'];
        $status = $post['task-status'];
        $binId = $post['task-binId'];
        $truckId = $post['task-truckId'];
        $modificationDate = date('Y-m-d');
        $isSuccess = $this->entity->updateById($id, [
            'title' => $title,
            'team' => $team,
            'status' => $status,
            'binId' => $binId,
            'truckId' => $truckId,
            'modification_date' => $modificationDate
        ]);

        return $isSuccess;
    }

    public function markDone($post){
        $id = $post['taskId'];
        $isSuccess = $this->entity->markDone($id);
        return $isSuccess;
    }

    public function getRecord($qs, $root)
    {
        $queryString = $qs;
        $queryArray = [];
        parse_str($queryString, $queryArray);

        $id = isset($queryArray['id']) ? $queryArray['id'] : "false";
        $isEdit = isset($queryArray['edit']) ? $queryArray['edit'] : "false";

        if ($id == "false") {
            header("Location: $root/view/storage/storage.php");
            exit();
        }

        if (sizeof($queryArray) > 0 && $id != "false") {
            $record = $this->fetchRecord(intval($queryArray['id']))[0];
        }

        if ($record == null) {
            header("Location: $root/view/storage/storage.php");
            exit();
        }

        $record['isEdit'] = $isEdit;
        return $record;
    }

    private function fetchRecord($id)
    {
        $queryResult =  $this->entity->getById($id);
        if ($queryResult->num_rows > 0) {
            // MYSQLI_ASSOC is used because it gives column names to,
            // otherwise array keys will be indexes instead of column names
            $fetchResult = $queryResult->fetch_all(MYSQLI_ASSOC);
            return $fetchResult;
        }
        return false;
    }

    public function getAllRecords()
    {
        $queryResult =  $this->entity->getAll();
        if ($queryResult->num_rows > 0) {
            // MYSQLI_ASSOC is used because it gives column names to,
            // otherwise array keys will be indexes instead of column names
            $fetchResult = $queryResult->fetch_all(MYSQLI_ASSOC);
            return $fetchResult;
        }
        return false;
    }

    public function getRecordsByStatus($s)
    {
        $queryResult =  $this->entity->getRecordsByStatus($s);
        if ($queryResult->num_rows > 0) {
            // MYSQLI_ASSOC is used because it gives column names to,
            // otherwise array keys will be indexes instead of column names
            $fetchResult = $queryResult->fetch_all(MYSQLI_ASSOC);
            return $fetchResult;
        }
        return false;
    }

    public function getLastModDate(){
        return $this->entity->getLastModDate();
    }

    public function deleteRecord($id)
    {
        $queryResult =  $this->entity->deleteById($id);
        return $queryResult == true;
    }

    public function getByFilters($filters)
    {
        $result = $this->entity->getByFilters($filters);
        $records = [];
        try {
            if (!is_array($result)) {
                while ($row = $result->fetch_assoc()) {
                    $records[] = $row;
                }
            }
        } catch (Exception $e) {
            var_dump($e->getMessage());
            return $records;
        }
        return $records;
    }
}