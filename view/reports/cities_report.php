<?php
include("../../controller/ControllerAuth.php");
include("../../controller/ControllerCity.php");
// * Check if the user is authenticated
$auth = new ControllerAuth();
$auth->checkAuth();

$controller = new ControllerCity();
$records = [];

if (isset($_GET['referrer'])) {
    $filters = [];

    if (isset($_GET["cities_name"]) && $_GET["cities_name"] != "") {
        $filters["name"] = $_GET["cities_name"];
    }
    if (isset($_GET["inhabitants"]) && $_GET["inhabitants"] != "") {
        $filters["inhabitans_cnt"] = $_GET["inhabitants"];
    }
    if (isset($_GET["employees"]) && $_GET["employees"] != "") {
        $filters["employees_cnt"] = $_GET["employees"];
    }
    if (isset($_GET["coordinates"]) && $_GET["coordinates"] != "") {
        $filters["coordinates"] = $_GET["coordinates"];
    }
    if (isset($_GET["objects"]) && $_GET["objects"] != "") {
        $filters["object_cnt"] = $_GET["objects"];
    }
    if (isset($_GET["region"]) && $_GET["region"] != "") {
        $filters["region"] = $_GET["region"];
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
            <li style="list-style: none; font-size: 24px;"><a href='./regions_report.php'>Regions</a></li>
            <li style="list-style: none; font-size: 24px; border-bottom: 2px solid #16558f;"><a href='./cities_report.php'>Cities</a></li>
            <li style="list-style: none; font-size: 24px;"><a href='./employees_report.php'>Employees</a></li>
             
        </ul>
    </section>
    <section class="report-table-wrapper">
        <form action="./cities_report.php" method="GET">
            <input type="text" hidden value="storage" name="referrer">
            <table class="report-table" style="margin: 20px 0; width: 100%;">
                <tr>
                    <th style="text-align: center;">City Name</th>
                    <th style="text-align: center;">Amount of Inhabitants</th>
                    <th style="text-align: center;">Amount of Employees</th>
                    <th style="text-align: center;">Coordinates</th>
                    <th style="text-align: center;">Amount of Objects</th>
                    <th style="text-align: center;">Region</th>
                    <th></th>
                </tr>
                <tr>
                    <td style="text-align: center;">
                        <input name="cities_name" id="city-name" type="text" style="flex-grow: 1;" placeholder="Istanbul">
                    </td>
                    <td style="text-align: center;">
                        <input name="inhabitants" id="city-inhabitants" type="number" min="0" style="width: 180px" placeholder="20400600">
                    </td>
                    <td style="text-align: center;">
                        <input name="employees" id="city-employees" type="number" min="0" style="flex-grow: 1;" placeholder="10300">
                    </td>
                    <td style="text-align: center;">
                        <input name="coordinates" id="city-coordinates" type="text" style="flex-grow: 1;" placeholder="12.2312, 32.123">
                    </td>
                    <td style="text-align: center;">
                        <input name="objects" id="city-objects" type="number" min="0" style="flex-grow: 1;" placeholder="85750">
                    </td>
                    <td style="text-align: center;">
                        <input name="region" id="city-region" type="text" style="flex-grow: 1;" placeholder="Silahtaraga">
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
                <th class="storage-table-header-data">City Name</th>
                <th class="storage-table-header-data">Amount of Inhabitants</th>
                <th class="storage-table-header-data">Amount of Employees</th>
                <th class="storage-table-header-data">Coordinates</th>
                <th class="storage-table-header-data">Amount of Objects</th>
                <th class="storage-table-header-data">Region</th>
            </tr>
            <?php
            if (sizeof($records) > 0) {
                $records = array_reverse($records);
                foreach ($records as $record) {
                    $name = $record['name'];
                    $inhabitants = $record['inhabitans_cnt'];
                    $employees = $record['employees_cnt'];
                    $coordinates = $record['coordinates'];
                    $objects = $record['object_cnt'];
                    $region = $record['region'];
                    echo "<tr>";
                    echo "<td class='storage-table-data'>$name</td>";
                    echo "<td class='storage-table-data'>$inhabitants</td>";
                    echo "<td class='storage-table-data'>$employees</td>";
                    echo "<td class='storage-table-data'>$coordinates</td>";
                    echo "<td class='storage-table-data'>$objects</td>";
                    echo "<td class='storage-table-data'>$region</td>";
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