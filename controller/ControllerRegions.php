<?php
// Setting absoulute path to prevent errors caused by nesting in the folders
$rootPath = $_SERVER['DOCUMENT_ROOT'];
$regionModelPath = $rootPath . "/model/Region.php";
include_once($regionModelPath);
// TODO: VALIDATE DATA AND SANITIZE
class ControllerRegions
{
    private $entity;

    public function __construct()
    {
        $this->entity = new Region();
    }

    public function createRecord($post)
    {
        $name = $post['region-name'];
        $lat = $post['region-location-lat'];
        $lon = $post['region-location-lon'];
        $collection_interval = $post['region-collection-interval'];
        $threshold = $post['region-threshold'];
        $budget = $post['region-budget'];
        $modificationDate = date('Y-m-d');

        $isSuccess = $this->entity->create(
            $name,
            $lat,
            $lon,
            $collection_interval,
            $threshold,
            $budget,
            $modificationDate
        );

        return $isSuccess;
    }

    public function updateRecord($post)
    {
        $id = $post['regions-object-id'];
        $name = $post['region-name'];
        $lat = $post['region-location-lat'];
        $lon = $post['region-location-lon'];
        $collection_interval = $post['region-collection-interval'];
        $threshold = $post['region-threshold'];
        $budget = $post['region-budget'];
        $modificationDate = date('Y-m-d');

        $isSuccess = $this->entity->updateById($id, 
        [
            "name" => $name,
            "lat" => $lat,
            "lon" => $lon,
            "collection_interval" => $collection_interval,
            "threshold" =>$threshold,
            "budget" => $budget,
            "modification_date" => $modificationDate
            ]
        );
        
        return $isSuccess;
    }

    public function getRecord($qs, $root)
    {
        $queryString = $qs;
        $queryArray = [];
        parse_str($queryString, $queryArray);

        $id = isset($queryArray['id']) ? $queryArray['id'] : "false";
        $isEdit = isset($queryArray['edit']) ? $queryArray['edit'] : "false";

        // No id means trouble just redirect to storage main page
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

    public function deleteRecord($id)
    {
        $queryResult =  $this->entity->deleteById($id);
        return $queryResult == true;
    }
}
