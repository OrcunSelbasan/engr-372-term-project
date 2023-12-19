<?php
$rootPath = $_SERVER['DOCUMENT_ROOT'];
$authControllerPath = $rootPath . "/controller/ControllerAuth.php";
include($authControllerPath);
// * Check if the user is authenticated
$auth = new ControllerAuth();
$auth->checkAuth();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../../jquery/jquery-3.7.1.js"></script>

    <title>Region Management</title>
    <link rel="stylesheet" href="../../css/index.css">
</head>

<body>
    <?php include("../header.php"); ?>

    <header>
        <h1>Region Management</h1>
    </header>

    <main>
        <!-- Home Page Content -->
        <div id="home">
            <p>Welcome to the Region Management System! REVIEW</p>
        </div>

        <!-- Create Region Page Content -->
        <div id="create" style="display: none;">
            <form id="regionForm" onsubmit="return false;">
                <label for="regionName">Region Name:</label>
                <input type="text" id="regionName" name="regionName" required>

                <!-- Add more form fields as needed -->

                <button type="button" onclick="submitForm('create')">Create Region</button>
            </form>
        </div>


    </main>

</body>

</html>