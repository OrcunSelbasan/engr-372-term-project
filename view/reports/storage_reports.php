<?php
include("../../controller/ControllerAuth.php");
include("../../controller/ControllerStorage.php");
// * Check if the user is authenticated
$auth = new ControllerAuth();
$auth->checkAuth();

$controller = new ControllerStorage();
$records = [];
function editActionHTML($id)
{
    return  "
        <td class='storage-table-data'>
        <button class='storage-table-data-delete-btn' onclick='deleteItem($id)'>
            <svg width='22' height='24' viewBox='0 0 22 24' fill='none' xmlns='http://www.w3.org/2000/svg'>
                <path d='M4 24C3.26667 24 2.63889 23.7389 2.11667 23.2167C1.59444 22.6944 1.33333 22.0667 1.33333 21.3333V4H0V1.33333H6.66667V0H14.6667V1.33333H21.3333V4H20V21.3333C20 22.0667 19.7389 22.6944 19.2167 23.2167C18.6944 23.7389 18.0667 24 17.3333 24H4ZM17.3333 4H4V21.3333H17.3333V4ZM6.66667 18.6667H9.33333V6.66667H6.66667V18.6667ZM12 18.6667H14.6667V6.66667H12V18.6667Z' fill='black'/>
            </svg>
        </button>
        <a href='./storage-view-record.php?edit=true&id=$id'>
            <svg width='25' height='24' viewBox='0 0 25 24' fill='none' xmlns='http://www.w3.org/2000/svg'>
                <path
                    d='M3.33341 21.3333H5.23342L18.2667 8.3L16.3667 6.4L3.33341 19.4333V21.3333ZM0.666748 24V18.3333L18.2667 0.766667C18.5334 0.522222 18.8279 0.333333 19.1501 0.2C19.4723 0.0666667 19.8112 0 20.1667 0C20.5223 0 20.8667 0.0666667 21.2001 0.2C21.5334 0.333333 21.8223 0.533333 22.0667 0.8L23.9001 2.66667C24.1667 2.91111 24.3612 3.2 24.4834 3.53333C24.6056 3.86667 24.6667 4.2 24.6667 4.53333C24.6667 4.88889 24.6056 5.22778 24.4834 5.55C24.3612 5.87222 24.1667 6.16667 23.9001 6.43333L6.33342 24H0.666748ZM17.3001 7.36667L16.3667 6.4L18.2667 8.3L17.3001 7.36667Z'
                    fill='black' />
            </svg>
        </a>
        <a href='./storage-view-record.php?id=$id'>
            <svg width='24' height='24' viewBox='0 0 24 24' fill='none' xmlns='http://www.w3.org/2000/svg'>
                <path
                    d='M2.66667 24C1.93333 24 1.30556 23.7389 0.783333 23.2167C0.261111 22.6944 0 22.0667 0 21.3333V2.66667C0 1.93333 0.261111 1.30556 0.783333 0.783333C1.30556 0.261111 1.93333 0 2.66667 0H12V2.66667H2.66667V21.3333H21.3333V12H24V21.3333C24 22.0667 23.7389 22.6944 23.2167 23.2167C22.6944 23.7389 22.0667 24 21.3333 24H2.66667ZM8.93333 16.9333L7.06667 15.0667L19.4667 2.66667H14.6667V0H24V9.33333H21.3333V4.53333L8.93333 16.9333Z'
                    fill='black' />
            </svg>
        </a>
    </td>";
}


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



    // $records = $controller->getAllRecords();
    // $records = is_array($records) ? $records : [];
    // $stats = $controller->getStats();
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

        .dropdown-label {
            display: block;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .select-dropdown {
            border: 2px solid #000;
        }
    </style>
    <title>WMS Inventory - Reports</title>
</head>
<?php include("../header.php"); ?>
<main class="report-main">
    <h2 class="report-header">REPORT</h2>
    <section class="select-dropdown">
        <div class="dropdown">
            <span>Please Select A Category </span>
            <div class="dropdown-content">
                <ul>
                    <li><a href="./storage_reports.php">Storage</a></li>
                    <li><a href='./regions_report.php'>Regions</a></li>
                    <li><a href='./cities_report.php'>Cities</a></li>
                    <li><a href='./employees_report.php'>Employees</a></li>
                </ul>
            </div>
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
                <th class="storage-table-header-data">Actions</th>
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
                    echo editActionHTML($id);
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