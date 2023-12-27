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
    <script src="../../jquery/jquery-3.7.1.js"></script>

    <title>City Modul</title>
    <link rel="stylesheet" href="../../css/index.css">
    <link rel="stylesheet" href="../../css/cities.css">

</head>

<body>
    <?php include("../header.php"); ?>



    <main>

        <h1>
            Welcome to City Modul: Details on <?php echo $city["name"] ?>
        </h1>

        <section class="storage-form-wrapper">
            <form class="storage-form" id="storage-form" action="../../utils/submission.php?type=city" method="post">
                <input type="hidden" id="id" name="id" value="<?php echo $id ?>">
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
                                    <?php echo $city["name"] ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="storage-category">Amount of Inhabitans:</label>
                                </td>
                                <td>
                                    <?php echo $city["inhabitans_cnt"] ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="storage-category">Amount of Employees:</label>
                                </td>
                                <td>
                                    <?php echo $city["employees_cnt"] ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="storage-category">Coordinates:</label>
                                </td>
                                <td>
                                    <?php echo $city["coordinates"] ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="storage-category">Amount of Objects:</label>
                                </td>
                                <td>
                                    <?php echo $city["object_cnt"] ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="storage-category">Region:</label>
                                </td>
                                <td>
                                    <?php echo $city["region"] ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </form>
        </section>




    </main>




</body>

</html>