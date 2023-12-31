<?php
$rootPath = $_SERVER['DOCUMENT_ROOT'];
$authControllerPath = $rootPath . "/controller/ControllerAuth.php";
include($authControllerPath);
// * Check if the user is authenticated
$auth = new ControllerAuth();
$auth->checkAuth();

$cityControllerPath = $rootPath . "/controller/ControllerCity.php";

include($cityControllerPath);
$controller = new ControllerCity();

$id = $_GET["id"];

$city = $controller->fetchRecord($id);

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="/jquery/jquery-3.7.1.js"></script>

    <title>City Module</title>
    <link rel="stylesheet" href="/css/index.css">
    <link rel="stylesheet" href="/css/cities.css">

</head>

<body>
    <?php include("../header.php"); ?>

    <main>
        <h1>
            Welcome to City Module: Edit a City
        </h1>
        <section class="storage-subheader-wrapper">
            <h3 class="storage-subheader" style="max-width: 700px; font-weight: 500;">Here you can edit a City.</h3>
        </section>

        <section class="storage-form-wrapper">
            <form class="storage-form" id="storage-form" action="../../utils/submission.php?type=city" method="post">
                <input type="hidden" id="id" name="id" value="<?php echo $id?>">
                <input type="hidden" name="form-submission-type" value="CITIES" />
                <input type="hidden" name="city-method" value="PUT" />
                <div class="storage-form-lines-wrapper">
                    <div class="storage-form-line">
                        <table class="cities-table">
                            <tr>
                                <td>
                                    <label for="storage-category">Name:</label>
                                </td>
                                <td>
                                    <input type="text" id="cities-name" name="cities-name" value="<?php echo $city["name"]?>">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="storage-category">Amount of Inhabitans:</label>
                                </td>
                                <td>
                                    <input type="number" id="inhabitants" name="inhabitants" value="<?php echo $city["inhabitans_cnt"]?>">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="storage-category">Amount of Employees:</label>
                                </td>
                                <td>
                                    <input type="number" id="Employees" name="Employees" value="<?php echo $city["employees_cnt"]?>">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="storage-category">Coordinates:</label>
                                </td>
                                <td>
                                    <input type="text" id="Coordinates" name="Coordinates" value="<?php echo $city["coordinates"]?>">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="storage-category">Amount of Objects:</label>
                                </td>
                                <td>
                                    <input type="number" id="Objects" name="Objects" value="<?php echo $city["object_cnt"]?>">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="storage-category">Region:</label>
                                </td>
                                <td>
                                    <input type="text" id="Region" name="Region" value="<?php echo $city["region"]?>">
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="submit-container">
                    <input type="submit" value="Update City" class="submit_button">
                </div>
            </form>
        </section>

        </div>




    </main>




</body>

</html>