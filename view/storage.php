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
        <title>Document</title>
        <script src="./jquery/jquery-3.7.1.js"></script>
    </head>
    <body>
        <header>
            <nav>
                <ul>
                    <li><a href="">Storage</a></li>
                    <li><a href="">Regions</a></li>
                    <li><a href="">Cities</a></li>
                    <li><a href="">Employees</a></li>
                    <li><a href="">Reports</a></li>
                </ul>
                <a href="./logout.php">Logout</a>
            </nav>
        </header>
        <h1>STORAGE PAGE</h1>
    </body>
</html>