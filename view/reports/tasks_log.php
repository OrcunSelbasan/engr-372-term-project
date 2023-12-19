<?php
include("../../controller/ControllerAuth.php");
include("../../model/Task.php");
include("../../model/Employees.php");
include("../../model/Region.php");
include("../../model/Storage.php");
// * Check if the user is authenticated
$auth = new ControllerAuth();
$auth->checkAuth();

$task = new Task();
$e = new Employees();
$s = new Storage();
$r = new Region();

$records = $task->getAll();



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../../jquery/jquery-3.7.1.js"></script>
    <link rel="stylesheet" href="../../css/index.css">
    <!-- I added it for days -->
    <title>WMS Inventory - Reports</title>
</head>
<?php include("../header.php"); ?>
<main class="report-main">
    <h2 class="report-header">REPORT</h2>
    <section class="select-dropdown">
        <div class="dropdown">
            <span>Please Select A Category Below </span>
            <ul style="display: flex; flex-direction: row; gap: 20px;">
                <li style="list-style: none;"><a href="./storage_reports.php">Storage</a></li>
                <li style="list-style: none;"><a href='./regions_report.php'>Regions</a></li>
                <li style="list-style: none;"><a href='./cities_report.php'>Cities</a></li>
                <li style="list-style: none;"><a href='./employees_report.php'>Employees</a></li>
                <li style="list-style: none; border-bottom: 1px solid black;"><a href='./tasks_log.php'>Tasks Log</a></li>
            </ul>
        </div>
    </section>
    <table class="storage-table">
        <tr class="storage-table-header">
            <th class="storage-table-header-data">ID</th>
            <th class="storage-table-header-data">Employee</th>
            <th class="storage-table-header-data">Region</th>
            <th class="storage-table-header-data">Storage Category</th>
            <th class="storage-table-header-data">Date</th>
        </tr>
        <?php
        if (sizeof($records) > 0) {
            $records = array_reverse($records);
            foreach ($records as $record) {
                $id = $record['id'];
                $employee = $e->getById($record['employee_id'])->fetch_all(MYSQLI_ASSOC)[0]['fname'];
                $region = $r->getById($record['region_id'])->fetch_all(MYSQLI_ASSOC)[0]['name'];
                $storageType = $s->getById($record['storage_id'])->fetch_all(MYSQLI_ASSOC)[0]['category'];
                $date = $record['interaction_time'];
                echo "<tr>";
                echo "<td class='storage-table-data'>$id</td>";
                echo "<td class='storage-table-data'>$employee</td>";
                echo "<td class='storage-table-data'>$region</td>";
                echo "<td class='storage-table-data'>$storageType</td>";
                echo "<td class='storage-table-data'>$date</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='12' align='center'>No information.</td></tr>";
        }

        ?>
    </table>
</main>
</body>

</html>