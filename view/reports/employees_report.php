<?php
include("../../controller/ControllerAuth.php");
include("../../controller/ControllerEmployees.php");
// * Check if the user is authenticated
$auth = new ControllerAuth();
$auth->checkAuth();

$controller = new ControllerEmployees();
$records = [];

if (isset($_GET['referrer'])) {
    $filters = [];

    if (isset($_GET["employee-fname"]) && $_GET["employee-fname"] != "") {
        $filters["fname"] = $_GET["employee-fname"];
    }
    if (isset($_GET["employee-lname"]) && $_GET["employee-lname"] != "") {
        $filters["lname"] = $_GET["employee-lname"];
    }
    if (isset($_GET["employee-email"]) && $_GET["employee-email"] != "") {
        $filters["email"] = $_GET["employee-email"];
    }
    if (isset($_GET["employee-phone"]) && $_GET["employee-phone"] != "") {
        $filters["phone"] = $_GET["employee-phone"];
    }
    if (isset($_GET["employee-salary"]) && $_GET["employee-salary"] != "") {
        $filters["salary"] = $_GET["employee-salary"];
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

    <section class="select-dropdown">
        <ul style="display: flex; flex-direction: row; gap: 20px; padding: 0; margin-bottom: 60px;">
            <li style="list-style: none; font-size: 24px;"><a href="./storage_reports.php">Storage</a></li>
            <li style="list-style: none; font-size: 24px;"><a href='./regions_report.php'>Regions</a></li>
            <li style="list-style: none; font-size: 24px;"><a href='./cities_report.php'>Cities</a></li>
            <li style="list-style: none; font-size: 24px; border-bottom: 2px solid #16558f;"><a href='./employees_report.php'>Employees</a></li>
             
        </ul>
    </section>
    <section class="report-table-wrapper">
        <form action="./employees_report.php" method="GET">
            <input type="text" hidden value="storage" name="referrer">
            <table class="report-table" style="margin: 20px 0; width: 100%;">
                <tr>
                    <th style="text-align: center;">First Name</th>
                    <th style="text-align: center;">Last Name</th>
                    <th style="text-align: center;">E-Mail</th>
                    <th style="text-align: center;">Phone Number</th>
                    <th style="text-align: center;">Monthly Salary</th>
                    <th></th>
                </tr>
                <tr>
                    <td style="text-align: center;">
                        <input name="employee-fname" id="employee-fname" type="text" style="flex-grow: 1;" placeholder="John">
                    </td>
                    <td style="text-align: center;">
                        <input name="employee-lname" id="employee-lname" type="text" style="flex-grow: 1;" placeholder="Doe">
                    </td>
                    <td style="text-align: center;">
                        <input name="employee-email" id="employee-email" type="text" style="flex-grow: 1;" placeholder="john.doe@wms.com">
                    </td>
                    <td style="text-align: center;">
                        <input name="employee-phone" id="employee-phone" type="text" style="flex-grow: 1;" placeholder="5554443322">
                    </td>
                    <td style="text-align: center;">
                        <input name="employee-salary" id="employee-salary" type="number" min="1" style="flex-grow: 1;" placeholder="50123">
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
                <th class="storage-table-header-data">First Name</th>
                <th class="storage-table-header-data">Last Name</th>
                <th class="storage-table-header-data">E-Mail</th>
                <th class="storage-table-header-data">Phone Number</th>
                <th class="storage-table-header-data">Monthly Salary</th>
                <th class="storage-table-header-data">Modification Date</th>
            </tr>
            <?php
            if (sizeof($records) > 0) {
                $records = array_reverse($records);
                foreach ($records as $record) {
                    $fname = $record['fname'];
                    $lname = $record['lname'];
                    $email = $record['email'];
                    $phone = $record['phone'];
                    $salary = $record['salary'];
                    $date = $record['modification_date'];
                    echo "<tr>";
                    echo "<td class='storage-table-data'>$fname</td>";
                    echo "<td class='storage-table-data'>$lname</td>";
                    echo "<td class='storage-table-data'>$email</td>";
                    echo "<td class='storage-table-data'>$phone</td>";
                    echo "<td class='storage-table-data'>$salary</td>";
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