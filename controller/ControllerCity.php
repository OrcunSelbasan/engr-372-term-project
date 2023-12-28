<?php
// Setting absoulute path to prevent errors caused by nesting in the folders
$rootPath = $_SERVER['DOCUMENT_ROOT'];
$cityModelPath = $rootPath . "/model/City.php";
include($cityModelPath);

class ControllerCity{
    private $entity;

    public function __construct() {
        $this -> entity = new City();
    }

    public function createRecord($post)
    {
        $name = $post['cities-name']; //* TODO: cities_add.php Variablen einfügen
        $inhabitants = $post['inhabitants'];
        $Employees = $post['Employees'];
        $Coordinates = $post['Coordinates'];
        $Objects = $post['Objects'];
        $Region = $post['Region'];
        

        $isSuccess = $this->entity->create(
            $name,
            $inhabitants,
            $Employees,
            $Coordinates,
            $Objects,
            $Region,

        );

        return $isSuccess;
    }

    public function updateRecord($post)
    {
        $this->entity->updateById($post["id"], $post);
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

    public function fetchRecord($id)
    {
        $queryResult =  $this->entity->getById($id);
        if ($queryResult->num_rows > 0) {
            // MYSQLI_ASSOC is used because it gives column names to,
            // otherwise array keys will be indexes instead of column names
            $fetchResult = $queryResult->fetch_all(MYSQLI_ASSOC);
            return $fetchResult[0];
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