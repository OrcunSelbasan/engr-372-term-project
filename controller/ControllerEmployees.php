<?php
// Setting absoulute path to prevent errors caused by nesting in the folders
$rootPath = $_SERVER['DOCUMENT_ROOT'];
$employeeModelPath = $rootPath . "/model/Employees.php";
include($employeeModelPath);

class ControllerEmployees{
    private $entity;

    public function __construct() {
        $this -> entity = new Employees();
    }

    public function getEntity() {
        return $this->entity;
    }

    public function createRecord($post)
    {
        $fname = $post['employee-fname'];
        $lname = $post['employee-lname'];
        $email = $post['employee-email'];
        $phone = $post['employee-phone'];
        $salary = $post['employee-salary'];
        $team = $post['employee-team'];
        $modificationDate = date('Y-m-d');
        

        $isSuccess = $this->entity->create(
            $fname,
            $lname,
            $email,
            $phone,
            $salary,
            $team,
            $modificationDate
        );

        return $isSuccess;
    }

    public function updateRecord($post)
    {
        $id = $post['employee-object-id'];
        $fname = $post['employee-fname'];
        $lname = $post['employee-lname'];
        $email = $post['employee-email'];
        $phone = $post['employee-phone'];
        $salary = $post['employee-salary'];
        $team = $post['employee-team'];
        $modificationDate = date('Y-m-d');
        $isSuccess = $this->entity->updateById($id, [
            'fname' => $fname,
            'lname' => $lname,
            'email' => $email,
            'phone' => $phone,
            'salary' => $salary,
            'team' => $team,
            'modification_date' => $modificationDate
        ]);

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

    public function getTeamMembers($team){
        $queryResult =  $this->entity->getTeamMembers($team);
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