<?php
include("../../controller/ControllerAuth.php");
include("../../controller/ControllerStorage.php");
// * Check if the user is authenticated
$auth = new ControllerAuth();
$auth->checkAuth();

$controller = new ControllerStorage();
$records = [];

if (isset($_GET['referrer'])) {
    $filters = [];

    if (isset($_GET["storage-category"]) && $_GET["storage-category"] != "") {
        $filters["category"] = $_GET["storage-category"];
    }
    if (isset($_GET["storage-volume"]) && $_GET["storage-volume"] != "") {
        $filters["volume"] = $_GET["storage-volume"];
    }
    if (isset($_GET["storage-type"]) && $_GET["storage-type"] != "") {
        $filters["type"] = $_GET["storage-type"];
    }
    if (isset($_GET["storage-initial-status"]) && $_GET["storage-initial-status"] != "") {
        $filters["initial_status"] = $_GET["storage-initial-status"];
    }
    if (isset($_GET["storage-value"]) && $_GET["storage-value"] != "") {
        $filters["value"] = $_GET["storage-value"];
    }
    if (isset($_GET["storage-quantity"]) && $_GET["storage-quantity"] != "") {
        $filters["quantity"] = $_GET["storage-quantity"];
    }
    if (isset($_GET["storage-estimated-lifetime"]) && $_GET["storage-estimated-lifetime"] != "") {
        $filters["lifetime"] = $_GET["storage-estimated-lifetime"];
    }

    $records = $controller->getByFilters($filters);
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../../jquery/jquery-3.7.1.js"></script>
    <link rel="stylesheet" href="../../css/index.css">
    <!-- I added it for days -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <title>WMS Inventory - Reports</title>
</head>
<?php include("../header.php"); ?>
<main class="report-main" style="width: 700px;">
    <section class="select-dropdown">
        <ul style="display: flex; flex-direction: row; gap: 20px; padding: 0; margin-bottom: 60px;">
            <li style="list-style: none; font-size: 24px; border-bottom: 2px solid #16558f;"><a href="./storage_reports.php">Storage</a></li>
            <li style="list-style: none; font-size: 24px;"><a href='./regions_report.php'>Regions</a></li>
            <li style="list-style: none; font-size: 24px;"><a href='./cities_report.php'>Cities</a></li>
            <li style="list-style: none; font-size: 24px;"><a href='./employees_report.php'>Employees</a></li>
             
        </ul>
    </section>
    <!-- Report Table-->
    <section class="report-table-wrapper" style="overflow-x: scroll;">
        <form action="./storage_reports.php" method="GET">
            <input type="text" hidden value="storage" name="referrer">
            <table class="report-table" style="margin: 20px 0; width: 100%;">
                <tr>
                    <th style="text-align: center;">Category</th>
                    <th style="text-align: center;">Storage Volume</th>
                    <th style="text-align: center;">Type</th>
                    <th style="text-align: center;">Status</th>
                    <th style="text-align: center;">Purchase Value</th>
                    <th style="text-align: center;">Auto-notifier</th>
                    <th style="text-align: center;">Quantity</th>
                    <th style="text-align: center;">Estimated Lifetime</th>
                    <th></th>
                </tr>
                <tr>
                    <td style="text-align: center;">
                        <select name="storage-category">
                            <option value="" selected disabled>Please Select</option>
                            <option value="bin">Bin</option>
                            <option value="truck">Truck</option>
                        </select>
                    </td>
                    <td style="text-align: center;">
                        <input name="storage-volume" id="storage-volume" type="number" min="1" max="4000" style="width: 150px" placeholder="100">
                    </td>
                    <td style="text-align: center;">
                        <select name="storage-type">
                            <option value="" selected disabled>Please Select</option>
                            <option value="smart">Smart</option>
                            <option value="regular">Regular</option>
                        </select>
                    </td>
                    <td style="text-align: center;">
                        <select name="storage-initial-status">
                            <option value="" selected disabled>Please Select</option>
                            <option value="maintenance">Maintenance</option>
                            <option value="passive">Passive</option>
                            <option value="active">Active</option>
                        </select>
                    </td>
                    <td style="text-align: center;">
                        <input name="storage-value" id="storage-value" type="number" min="1" style="flex-grow: 1;" placeholder="1000">
                    </td>
                    <td style="text-align: center;">
                        <input type="checkbox" name="storage-notifier" id="storage-notifier">
                    </td>
                    <td style="text-align: center;">
                        <input type="number" min="1" name="storage-quantity" id="storage-quantity" style="flex-grow: 1;" placeholder="1">
                    </td>
                    <td style="text-align: center;">
                        <input name="storage-estimated-lifetime" id="storage-estimated-lifetime" type="number" min="1" style="flex-grow: 1;" placeholder="5">
                    </td>
                    <td style="text-align: center;">
                        <button class="btn btn-blue" style="width: 100px; height: 25px;" type="submit">Search</button>
                    </td>
                </tr>
            </table>
        </form>
    </section>
    <section class="storage-table-wrapper">
        <table class="storage-table">
            <tr class="storage-table-header">
                <th class="storage-table-header-data">ID</th>
                <th class="storage-table-header-data">Category</th>
                <th class="storage-table-header-data">Volume</th>
                <th class="storage-table-header-data">Type</th>
                <th class="storage-table-header-data">Status</th>
                <th class="storage-table-header-data">Modification Date</th>
            </tr>
            <?php
            if (sizeof($records) > 0) {
                $records = array_reverse($records);
                foreach ($records as $record) {
                    $id = $record['id'];
                    $category = $record['category'];
                    $volume = $record['volume'];
                    $type = $record['type'];
                    $status = $record['initial_status'];
                    $date = $record['modification_date'];
                    echo "<tr>";
                    echo "<td class='storage-table-data'>$id</td>";
                    echo "<td class='storage-table-data'>$category</td>";
                    echo "<td class='storage-table-data'>$volume</td>";
                    echo "<td class='storage-table-data'>$type</td>";
                    echo "<td class='storage-table-data'>$status</td>";
                    echo "<td class='storage-table-data'>$date</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='12' align='center'>No information.</td></tr>";
            }
            ?>
        </table>
    </section>
</main>
</body>

</html>