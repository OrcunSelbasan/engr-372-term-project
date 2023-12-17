<?php
    include("../controller/ControllerAuth.php");
    // * Check if the user is authenticated
    $auth = new ControllerAuth();
    $auth->checkAuth();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="./jquery/jquery-3.7.1.js"></script>
        <link rel="stylesheet" href="../css/index.css">
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
            box-shadow: 0 8px 16px rgba(0,0,0,0.2);
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
    <?php include("./header.php"); ?>
    <main class="report-main">
        <h2 class="report-header">REPORT</h2>
        <section class="select-dropdown">
            <div class="dropdown">
                <span>Please Select A Category </span>
                <div class="dropdown-content">
                    <ul>
                        <li><a href="./reports.php">Storage</a></li>
                        <li><a href='./regions_report.php'>Regions</a></li>
                        <li><a href='./cities_report.php'>Cities</a></li>
                        <li><a href='./employees_report.php'>Employees</a></li>
                    </ul>
                 </div>
            </div>
        </section>
        <h3>Cities</h3>
    </main>
</body>

</html>