<?php
// Setting absoulute path to prevent errors caused by nesting in the folders
$rootPath = $_SERVER['DOCUMENT_ROOT'];
$authControllerPath = $rootPath . "/controller/ControllerAuth.php";
$storageControllerPath = $rootPath . "/controller/ControllerStorage.php";
$employeesControllerPath = $rootPath . "/controller/ControllerEmployees.php";
$regionsControllerPath = $rootPath . "/controller/ControllerRegions.php";
$authControllerPath = $rootPath . "/controller/ControllerAuth.php";
$cityControllerPath = $rootPath . "/controller/ControllerCity.php";

include($authControllerPath);
include($storageControllerPath);
include($employeesControllerPath);
include($regionsControllerPath);
include($cityControllerPath);
// * Check if the user is authenticated
$auth = new ControllerAuth();
$auth->checkAuth();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    switch ($_POST['form-submission-type']) {
        case 'STORAGE':
            $controller = new ControllerStorage();
            try {
                if (isset($_POST['storage-method']) && $_POST['storage-method'] == 'PUT') {
                    $success = $controller->updateRecord($_POST);
                } else {
                    $success = $controller->createRecord($_POST);
                }
                header("Location: $root/view/storage/storage.php");
                if (!boolval($success)) {
                    throw new Exception("Error Processing Request");
                }
            } catch (Exception $e) {
                $root = $auth->getRoot();
                // Server doesn't know how to handle this request, so send code 500
                http_response_code(500);
                // Redirect user to storage main page
                header("Location: $root/view/storage/storage.php");
            }
            break;
        case 'EMPLOYEES':
            $controller = new ControllerEmployees();
            try {
                if (isset($_POST['employee-method']) && $_POST['employee-method'] == 'PUT') {
                    $success = $controller->updateRecord($_POST);
                } else {
                    $success = $controller->createRecord($_POST);
                }
                header("Location: $root/view/employees.php");
                if (!boolval($success)) {
                    throw new Exception("Error Processing Request");
                }
            } catch (Exception $e) {
                $root = $auth->getRoot();
                // Server doesn't know how to handle this request, so send code 500
                http_response_code(500);
                // Redirect user to storage main page
                header("Location: $root/view/storage/storage.php");
            }
            break;
        case 'REGIONS':
            $controller = new ControllerRegions();
            try {
                if (isset($_POST['regions-method']) && $_POST['regions-method'] == 'PUT') {
                    $success = $controller->updateRecord($_POST);
                } else {
                    $success = $controller->createRecord($_POST);
                }
                header("Location: $root/view/regions/regions.php");
                if (!boolval($success)) {
                    throw new Exception("Error Processing Request");
                }
            } catch (Exception $e) {
                $root = $auth->getRoot();
                // Server doesn't know how to handle this request, so send code 500
                http_response_code(500);
                // Redirect user to storage main page
                header("Location: $root/view/storage/storage.php");
            }
            break;
        case 'CITIES':
            $controller = new ControllerCity();
            print_r($_POST);
            if(isset($_POST['city-method']) && $_POST['city-method'] == 'PUT') {
                $controller->updateRecord($_POST);
            } else {
                $controller->createRecord($_POST);
            }
            header("Location: $root/view/cities/cities_overview.php");
        default:
            # code...
            break;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {

    if (str_contains($_SERVER['HTTP_REFERER'], 'storage')) {
        $controller = new ControllerStorage();
        $queryString = $_SERVER['QUERY_STRING'];
        $queryArray = [];
        parse_str($queryString, $queryArray);
        if (sizeof($queryArray) > 0 && isset($queryArray['id'])) {
            $result = $controller->deleteRecord($queryArray['id']);
            if ($result) {
                echo "true";
            } else {
                var_dump('An error occurred while deleting!');
            }
        }
    } else if (str_contains($_SERVER['HTTP_REFERER'], 'employee')) {
        $controller = new ControllerEmployees();
        $queryString = $_SERVER['QUERY_STRING'];
        $queryArray = [];
        parse_str($queryString, $queryArray);

        if (sizeof($queryArray) > 0 && isset($queryArray['id'])) {

            $result = $controller->deleteRecord($queryArray['id']);
            if ($result) {
                echo "true";
            } else {
                echo "$result";
            }
        }
    } else if (str_contains($_SERVER['HTTP_REFERER'], 'regions/')) {
        $controller = new ControllerRegions();
        $queryString = $_SERVER['QUERY_STRING'];
        $queryArray = [];
        parse_str($queryString, $queryArray);

        if (sizeof($queryArray) > 0 && isset($queryArray['id'])) {

            $result = $controller->deleteRecord($queryArray['id']);
            if ($result) {
                echo "true";
            } else {
                echo "$result";
            }
        }
    }  else if (str_contains($_SERVER['HTTP_REFERER'], 'cities')) {
        $controller = new ControllerCity();
        $queryString = $_SERVER['QUERY_STRING'];
        $queryArray = [];
        parse_str($queryString, $queryArray);

        if (sizeof($queryArray) > 0 && isset($queryArray['id'])) {

            $result = $controller->deleteRecord($queryArray['id']);
            if ($result) {
                echo "true";
            } else {
                echo "$result";
            }
        }
    }
}

exit();
