<?php
include("../../controller/ControllerAuth.php");
include("../../controller/ControllerRegions.php");
// * Check if the user is authenticated
$auth = new ControllerAuth();
$auth->checkAuth();

$controller = new ControllerRegions();
$records = [];

if (isset($_GET['referrer'])) {
    $filters = [];

    if (isset($_GET["name"]) && $_GET["name"] != "") {
        $filters["name"] = $_GET["name"];
    }
    if (isset($_GET["lat"]) && $_GET["lat"] != "") {
        $filters["lat"] = $_GET["lat"];
    }
    if (isset($_GET["lon"]) && $_GET["lon"] != "") {
        $filters["lon"] = $_GET["lon"];
    }
    if (isset($_GET["collection_interval"]) && $_GET["collection_interval"] != "") {
        $filters["collection_interval"] = $_GET["collection_interval"];
    }
    if (isset($_GET["threshold"]) && $_GET["threshold"] != "") {
        $filters["threshold"] = $_GET["threshold"];
    }
    if (isset($_GET["budget"]) && $_GET["budget"] != "") {
        $filters["budget"] = $_GET["budget"];
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
    <title>WMS Inventory - Reports</title>
</head>
<?php include("../header.php"); ?>
<main class="report-main">
    <section class="select-dropdown">
        <ul style="display: flex; flex-direction: row; gap: 20px; padding: 0; margin-bottom: 60px;">
            <li style="list-style: none; font-size: 24px;"><a href="./storage_reports.php">Storage</a></li>
            <li style="list-style: none; font-size: 24px; border-bottom: 2px solid #16558f;"><a href='./regions_report.php'>Regions</a></li>
            <li style="list-style: none; font-size: 24px;"><a href='./cities_report.php'>Cities</a></li>
            <li style="list-style: none; font-size: 24px;"><a href='./employees_report.php'>Employees</a></li>
            <li style="list-style: none; font-size: 24px;"><a href='./tasks_log.php'>Tasks Log</a></li>
        </ul>
    </section>
    <section class="report-table-wrapper">
        <form action="./regions_report.php" method="GET">
            <input type="text" hidden value="storage" name="referrer">
            <table class="report-table" style="margin: 20px 0; width: 100%;">
                <tr>
                    <th style="text-align: center;">Name</th>
                    <th style="text-align: center;">Lat</th>
                    <th style="text-align: center;">Lon</th>
                    <th style="text-align: center;">Interval</th>
                    <th style="text-align: center;">Threshold</th>
                    <th style="text-align: center;">Budget</th>
                    <th></th>
                </tr>
                <tr>
                    <td style="text-align: center;">
                        <input name="name" id="region-name" type="text" style="flex-grow: 1;" placeholder="Silahtaraga">
                    </td>
                    <td style="text-align: center;">
                        <input name="lat" id="region-lat" type="text" style="flex-grow: 1;" placeholder="12.123">
                    </td>
                    <td style="text-align: center;">
                        <input name="lon" id="region-lon" type="text" style="flex-grow: 1;" placeholder="12.123">
                    </td>
                    <td style="text-align: center;">
                        <select name="collection_interval" id="region-collection-interval" style="width: 120px;" required>
                            <option value="" selected disabled>Please Select</option>
                            <option value="daily">Daily</option>
                            <option value="weekly">Weekly</option>
                            <option value="biweekly">Biweekly</option>
                        </select>
                    </td>
                    <td style="text-align: center;">
                        <input name="threshold" id="region-threshold" type="text" style="flex-grow: 1;" placeholder="1000">
                    </td>
                    <td style="text-align: center;">
                        <input name="budget" id="region-budget" type="number" min="1" style="flex-grow: 1;" placeholder="200000">
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
                <th class="storage-table-header-data">Name</th>
                <th class="storage-table-header-data">Lat</th>
                <th class="storage-table-header-data">Lon</th>
                <th class="storage-table-header-data">Interval</th>
                <th class="storage-table-header-data">Threshold</th>
                <th class="storage-table-header-data">Budget</th>
                <th class="storage-table-header-data">Modification Date</th>
            </tr>
            <?php
            if (sizeof($records) > 0) {
                $records = array_reverse($records);
                foreach ($records as $record) {
                    $name = $record['name'];
                    $lat = $record['lat'];
                    $lon = $record['lon'];
                    $collection_interval = $record['collection_interval'];
                    $threshold = $record['threshold'];
                    $budget = $record['budget'];
                    $date = $record['modification_date'];
                    echo "<tr>";
                    echo "<td class='storage-table-data'>$name</td>";
                    echo "<td class='storage-table-data'>$lat</td>";
                    echo "<td class='storage-table-data'>$lon</td>";
                    echo "<td class='storage-table-data'>$collection_interval</td>";
                    echo "<td class='storage-table-data'>$threshold</td>";
                    echo "<td class='storage-table-data'>$budget</td>";
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