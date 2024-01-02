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

    <title>City Module</title>
    <link rel="stylesheet" href="../../css/index.css">
    <link rel="stylesheet" href="../../css/cities.css">
    
    <style>
        .cities-table td, tr {
            border: none;
        } 
    </style>

</head>

<body>
    <?php include("../header.php"); ?>

    <main class="storage-main">
        <h2 class="storage-header">Welcome to City Module: Add a City</h2>
        <section class="storage-subheader-wrapper">
            <h3 class="storage-subheader" style="max-width: 700px; font-weight: 500;">Here you can add a new city.</h3>
        </section>

        <section class="storage-form-wrapper">
            <form class="storage-form" id="storage-form" action="../../utils/submission.php" method="POST">
                <input id="form-submission-type" name="form-submission-type" type="text" id="" value="CITIES" style="display: none;">
                <div class="storage-form-lines-wrapper">
                    <div class="storage-form-line">
                        <table class="cities-table">
                            <tr>
                                <td>
                                    <label for="storage-category">Name:</label>
                                </td>
                                <td>
                                    <input type="text" id="cities-name" name="cities-name">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="storage-category">Amount of Inhabitans:</label>
                                </td>
                                <td>
                                    <input type="number" id="inhabitants" name="inhabitants">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="storage-category">Amount of Employees:</label>
                                </td>
                                <td>
                                    <input type="number" id="Employees" name="Employees">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="storage-category">Coordinates:</label>
                                </td>
                                <td>
                                    <input type="text" id="Coordinates" name="Coordinates">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="storage-category">Amount of Objects:</label>
                                </td>
                                <td>
                                    <input type="number" id="Objects" name="Objects">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="storage-category">Region:</label>
                                </td>
                                <td>
                                    <input type="text" id="Region" name="Region">
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="submit-container">
                    <input type="submit" value="Create City" class="submit_button">
                </div>
            </form>
        </section>

    </main>


</body>

</html>