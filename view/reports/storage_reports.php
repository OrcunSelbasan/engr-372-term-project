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
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: white;
            margin: 0;
            padding: 0;
            display: flex;
            height: 100vh;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #fff;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            min-width: 160px;
            z-index: 1;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .dropdown-content ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        .dropdown-content li {
            padding: 10px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        .dropdown-content a {
            color: #333;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #f0f0f0;
        }
    </style>
    <title>WMS Inventory - Reports</title>
</head>
<?php include("../header.php"); ?>
<main class="report-main">
    <h2 class="report-header">REPORT</h2>
    <section class="select-dropdown">
        <div class="dropdown">
            <span>Please Select A Category Below </span>
            <ul style="display: flex; flex-direction: row; gap: 20px;">
                <li style="list-style: none; border-bottom: 1px solid black;"><a href="./storage_reports.php">Storage</a></li>
                <li style="list-style: none;"><a href='./regions_report.php'>Regions</a></li>
                <li style="list-style: none;"><a href='./cities_report.php'>Cities</a></li>
                <li style="list-style: none;"><a href='./employees_report.php'>Employees</a></li>
            </ul>
        </div>
    </section>
    <h3>Storage</h3>
    <!-- Report Table-->
    <section class="report-table-wrapper">
        <form action="./storage_reports.php" method="GET">
            <input type="text" hidden value="storage" name="referrer">
            <table class="report-table">
                <tr>
                    <th>Category</th>
                    <th>Storage Volume</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Purchase Value</th>
                    <th>Auto-notifier</th>
                    <th>Quantity</th>
                    <th>Estimated Lifetime</th>
                </tr>
                <tr>
                    <td>
                        <select name="storage-category">
                            <option value=></option>
                            <option value="bin">Bin</option>
                            <option value="truck">Truck</option>
                        </select>
                    </td>
                    <td>
                        <input name="storage-volume" id="storage-volume" type="number" min="1" max="4000" style="flex-grow: 1;">
                    </td>
                    <td>
                        <select name="storage-type">
                            <option value=></option>
                            <option value="smart">Smart</option>
                            <option value="regular">Regular</option>
                        </select>
                    </td>
                    <td>
                        <select name="storage-initial-status">
                            <option value=></option>
                            <option value="maintenance">Maintenance</option>
                            <option value="passive">Passive</option>
                            <option value="active">Active</option>
                        </select>
                    </td>
                    <td>
                        <input name="storage-value" id="storage-value" type="number" min="1" style="flex-grow: 1;">
                    </td>
                    <td>
                        <input type="checkbox" name="storage-notifier" id="storage-notifier">
                    </td>
                    <td>
                        <input type="number" min="1" name="storage-quantity" id="storage-quantity" style="width: 300px">
                    </td>
                    <td>
                        <input name="storage-estimated-lifetime" id="storage-estimated-lifetime" type="number" min="1" style="flex-grow: 1;">
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