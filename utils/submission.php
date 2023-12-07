<?php
include("../controller/ControllerAuth.php");
include("../controller/ControllerStorage.php");
include("../controller/ControllerEmployees.php");
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
                header("Location: $root/view/storage.php");
                if (!boolval($success)) {
                    throw new Exception("Error Processing Request");
                }
            } catch (Exception $e) {
                $root = $auth->getRoot();
                // Server doesn't know how to handle this request, so send code 500
                http_response_code(500);
                // Redirect user to storage main page
                header("Location: $root/view/storage.php");
            }
            break;
         case 'EMPLOYEES':
            $controller = new ControllerEmployees();
            try {
                if (isset($_POST['storage-method']) && $_POST['storage-method'] == 'PUT') {
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
                header("Location: $root/view/storage.php");
            }
            break;
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
    }
     
    else if (str_contains($_SERVER['HTTP_REFERER'], 'employees')) {
        $controller = new ControllerEmployees();
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
    }
        
}

exit();
