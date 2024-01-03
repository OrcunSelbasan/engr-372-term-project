<?php
// Setting absoulute path to prevent errors caused by nesting in the folders
$rootPath = $_SERVER['DOCUMENT_ROOT'];
$storageModelPath = $rootPath . "/model/Storage.php";
include_once($storageModelPath);
// TODO: VALIDATE DATA AND SANITIZE
class ControllerStorage
{
    private $entity;

    public function __construct()
    {
        $this->entity = new Storage();
    }

    public function getEntity() {
        return $this->entity;
    }

    public function createRecord($post)
    {
        $category = $post['storage-category'];
        $volume = $post['storage-volume'];
        $volumeUnit = $post['storage-volume-unit'];
        $type = $post['storage-type'];
        $initialStatus = $post['storage-initial-status'];
        $value = $post['storage-value'];
        $valueUnit = $post['storage-value-unit'];
        $autonotfier = $post['storage-notifier'];
        $quantity = $post['storage-quantity'];
        $lifetime = $post['storage-estimated-lifetime'];
        $lifetimeUnit = $post['storage-estimated-lifetime-unit'];
        $temporaryStorage = $category === 'bin' ? 'false' : 'true';
        $modificationDate = date('Y-m-d');

        $isSuccess = $this->entity->create(
            $category,
            $volume,
            $volumeUnit,
            $type,
            $initialStatus,
            $value,
            $valueUnit,
            $autonotfier,
            $quantity,
            $lifetime,
            $lifetimeUnit,
            $temporaryStorage,
            $modificationDate
        );

        return $isSuccess;
    }

    public function updateRecord($post)
    {
        $id = $post['storage-object-id'];
        $category = $post['storage-category'];
        $volume = $post['storage-volume'];
        $volumeUnit = $post['storage-volume-unit'];
        $type = $post['storage-type'];
        $initialStatus = $post['storage-initial-status'];
        $value = $post['storage-value'];
        $valueUnit = $post['storage-value-unit'];
        $autonotfier = $post['storage-notifier'];
        $quantity = $post['storage-quantity'];
        $lifetime = $post['storage-estimated-lifetime'];
        $lifetimeUnit = $post['storage-estimated-lifetime-unit'];
        $temporaryStorage = $category === 'bin' ? 'false' : 'true';
        $modificationDate = date('Y-m-d');
        $isSuccess = $this->entity->updateById($id, [
            'category' => $category,
            'volume' => $volume,
            'volume_unit' => $volumeUnit,
            'type' => $type,
            'initial_status' => $initialStatus,
            'value' => $value,
            'value_unit' => $valueUnit,
            'autonotifier' => $autonotfier,
            'quantity' => $quantity,
            'lifetime' => $lifetime,
            'lifetime_unit' => $lifetimeUnit,
            'temporary_storage' => $temporaryStorage,
            'modification_date' => $modificationDate
        ]);

        return $isSuccess;
    }

    // public function getAllRecordsFiltered($conditions = []) {
    //     // Create a database connection -----yeni eklendi
    //     $db = $this->connectDatabase();

    //     // Prepare query string from conditions
    //     $queryString = "";
    //     foreach ($conditions as $key => $value) {
    //         if ($key == (count($conditions) - 1)) {
    //             $queryString = $queryString;
    //         } else {
    //             $queryString = $value . " AND ";
    //         }
    //     }


    //     // Prepare a SQL query with search criteria
    //     $query = "SELECT * FROM storage WHERE  ?";
    //     $stmt = $db->prepare($query);
    //     $searchTerm = '%' . $search . '%';
    //     $stmt->bind_param("s", $searchTerm);

    //     // Execute the query and fetch results
    //     $stmt->execute();
    //     $result = $stmt->get_result();

    //     $records = [];
    //     while ($row = $result->fetch_assoc()) {
    //         $records[] = $row;
    //     }

    //     return $records;
    // }

    public function setActive($id){
        $this->entity->setActive($id);
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
    public function getAvailableBins()
    {
        $queryResult =  $this->entity->getAvailableBins();
        if ($queryResult->num_rows > 0) {
            // MYSQLI_ASSOC is used because it gives column names to,
            // otherwise array keys will be indexes instead of column names
            $fetchResult = $queryResult->fetch_all(MYSQLI_ASSOC);
            return $fetchResult;
        }
        return false;
    }
    public function getTrucks()
    {
        $queryResult =  $this->entity->getTrucks();
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

    public function getStats()
    {
        $storageObjs =  $this->entity->getStat("category", "category='bin'")->fetch_row()[0];
        $activeStorageObjs =  $this->entity->getStat("category", "category='bin' AND initial_status='active'")->fetch_row()[0];
        $inctiveStorageObjs =  $this->entity->getStat("category", "category='bin' AND initial_status<>'active'")->fetch_row()[0];

        $transportationObjs =  $this->entity->getStat("category", "category='truck'")->fetch_row()[0];
        $activeTransportationObjs =  $this->entity->getStat("category", "category='truck' AND initial_status='active'")->fetch_row()[0];
        $inctiveTransportationObjs =  $this->entity->getStat("category", "category='truck' AND initial_status<>'active'")->fetch_row()[0];

        $totalObjects =  $this->entity->getStat("id", "id>-1")->fetch_row()[0];

        $totalVolume =  $this->entity->getStat("volume", "volume>-1", "sum")->fetch_row()[0];
        $totalPrice =  $this->entity->getStat("value", "value>-1", "sum")->fetch_row()[0];
        return [
            'storageObjs' => $storageObjs,
            'activeStorageObjs' => $activeStorageObjs,
            'inctiveStorageObjs' => $inctiveStorageObjs,
            'transportationObjs' => $transportationObjs,
            'activeTransportationObjs' => $activeTransportationObjs,
            'inctiveTransportationObjs' => $inctiveTransportationObjs,
            'totalObjects' => $totalObjects,
            'totalVolume' => $totalVolume,
            'totalPrice' => $totalPrice,
        ];
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
