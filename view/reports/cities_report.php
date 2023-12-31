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
        $filters["cities_name"] = $_GET["cities_name"];
    }
    if (isset($_GET["inhabitants"]) && $_GET["inhabitants"] != "") {
        $filters["inhabitants"] = $_GET["inhabitants"];
    }
    if (isset($_GET["Employees"]) && $_GET["Employees"] != "") {
        $filters["Employees"] = $_GET["Employees"];
    }
    if (isset($_GET["Coordinates"]) && $_GET["Coordinates"] != "") {
        $filters["Coordinates"] = $_GET["Coordinates"];
    }
    if (isset($_GET["Objects"]) && $_GET["Objects"] != "") {
        $filters["Objects"] = $_GET["Objects"];
    }
    if (isset($_GET["Region"]) && $_GET["Region"] != "") {
        $filters["Region"] = $_GET["Region"];
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
	<h2 class="report-header">REPORT</h2>
    <section class="select-dropdown">
		<div class="dropdown">
		    <span>Please Select A Category Below </span>
		    <ul style="display: flex; flex-direction: row; gap: 20px;">
			    <li style="list-style: none;"><a href="./storage_reports.php">Storage</a></li>
			    <li style="list-style: none;"><a href='./regions_report.php'>Regions</a></li>
			    <li style="list-style: none; border-bottom: 1px solid black;"><a href='./cities_report.php'>Cities</a></li>
			    <li style="list-style: none;"><a href='./employees_report.php'>Employees</a></li>
			    <li style="list-style: none;"><a href='./tasks_log.php'>Tasks Log</a></li>
		    </ul>
		</div>
	</section>
	<h3>Cities<h3>
        <section class="report-table-wrapper">
            <form action="./cities_report.php" method="GET">
                <input type="text" hidden value="storage" name="referrer">
			    <table class="report-table">
                    <tr>
                        <th>City Name</th>
                        <th>Amount of Inhabitants</th>
                        <th>Amount of Employees</th>
                        <th>Coordinates</th>
                        <th>Amount of Objects</th>
                        <th>Region</th>
                    </tr>
                    <tr>
                            <td>
                                <input name="city name" id="city-name" type="text" style="flex-grow: 1;">
                            </td>
                            <td>
                                <input name="inhabitants" id="city-inhabitants" type="number" min="0" style="width: 180px">
                            </td>
                            <td>
                                <input name="employees" id="city-employees" type="number" min="0" style="flex-grow: 1;">
                            </td>
                            <td>
                                <input name="coordinates" id="city-coordinates" type="text" style="flex-grow: 1;">
                            </td>
                            <td>
                                <input name="objects" id="city-objects" type="number" min="0" style="flex-grow: 1;">
                            </td>
                            <td>
                                <input name="region" id="city-region"  type="text" style="flex-grow: 1;">
                            </td>
                    </tr>
                </table>
                <div style="display: flex; flex-direction: row; justify-content: end;">
                    <button type="submit">Search</button>
                </div>
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
                        <th class="storage-table-header-data">Modification Date</th>
                    </tr>
                    <?php
                    if (sizeof($records) > 0) {
                        $records = array_reverse($records);
                        foreach ($records as $record) {
                            $name = $record['cities_name'];
                            $inhabitants = $record['inhabitants'];
                            $employees = $record['Employees'];
                            $coordinates = $record['Coordinates'];
                            $objects = $record['Objects'];
                            $region = $record['Region'];
                            $date = $record['modification_date'];
                            echo "<tr>";
                            echo "<td class='storage-table-data'>$name</td>";
                            echo "<td class='storage-table-data'>$inhabitants</td>";
                            echo "<td class='storage-table-data'>$employees</td>";
                            echo "<td class='storage-table-data'>$coordinates</td>";
                            echo "<td class='storage-table-data'>$objects</td>";
                            echo "<td class='storage-table-data'>$region</td>";
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