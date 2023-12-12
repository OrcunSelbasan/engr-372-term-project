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
    <title>Cities</title>
</head>

<body>
    <?php include("./header.php"); ?>
    <?php include("./index_cities.html"); ?>

</body>

</html>