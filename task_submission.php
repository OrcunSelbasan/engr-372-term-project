<?php
include_once('./controller/ControllerStorage.php');
include_once('./controller/ControllerRegions.php');
include_once('./controller/ControllerEmployees.php');
include_once('./model/Task.php');
function validate()
{
    $hasPostReq = isset($_POST) && isset($_POST['employee_id']) && isset($_POST['storage_id']) && isset($_POST['interaction_time']) && isset($_POST['region_id']);

    if ($hasPostReq) {
        $storage = new ControllerStorage();
        $employee = new ControllerEmployees();
        $region = new ControllerRegions();

        $storage = $storage->getEntity();
        $employee = $employee->getEntity();
        $region = $region->getEntity();

        $eid = htmlspecialchars(strip_tags(trim($_POST['employee_id'])));
        $sid = htmlspecialchars(strip_tags(trim($_POST['storage_id'])));
        $rid = htmlspecialchars(strip_tags(trim($_POST['region_id'])));
        $it = htmlspecialchars(strip_tags(trim($_POST['interaction_time'])));


        try {
            $eid = intval($eid);
            $sid = intval($sid);
            $rid = intval($rid);
        } catch (\Throwable $th) {
        }

        $storage = $storage->getById($sid);
        $employee = $employee->getById($eid);
        $region = $region->getById($rid);

        // IF ANY GET RESULT IS ZERO THEN MULTIPLICATION WILL RESULT 0
        // WHICH MEANS SOMETHING IS WRONG
        if ($storage->num_rows * $employee->num_rows * $region->num_rows !== 0) {
            return true;
        }
    }

    return false;
}

$isValid = validate();
$detailedMessage = $isValid ? "Congratulations! Your submission was successful. Thank you for your contribution, and we appreciate your time and effort." : "We regret to inform you that your submission was unsuccessful. We apologize for any inconvenience this may have caused. ";
$message = $isValid ? "Success!" : "Failure!";
$bgColor = $isValid ? "#3BB143" : "#DC143C";

if ($isValid) {
    $task = new Task();
    $task->create($_POST['employee_id'], $_POST['storage_id'], $_POST['interaction_time'], $_POST['region_id']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="./jquery/jquery-3.7.1.js"></script>
    <link rel="stylesheet" href="./css/index.css">
    <title>WMS Inventory - Add Record</title>
</head>

<body style=" flex-direction: row;background-color: <?php echo $bgColor ?>">
    <main class="storage-main">
        <h1><?php echo $message ?></h1>
    </main>
    <section style="position: absolute; top: 30%; left: 100px;">
        <p><?php echo $detailedMessage ?></p>
        <p style="font-size: 24px; padding: 10px 50px; border-bottom: 1px solid <?php echo $bgColor ?>"><a href="./task.php">Fill Again</a></p>
    </section>
</body>

</html>