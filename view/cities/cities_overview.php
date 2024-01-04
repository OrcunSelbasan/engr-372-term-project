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
$cities = $controller->getAllRecords();
$cities = $cities == false ? array() : $cities;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../../jquery/jquery-3.7.1.js"></script>
    <script src="/js/cities.js"></script>

    <title>City Module</title>
    <link rel="stylesheet" href="../../css/index.css">
    <link rel="stylesheet" href="../../css/cities.css">

</head>

<body>
    <?php include("../header.php"); ?>

    <main>
        <h1>
            Welcome to City Module: Overview
        </h1>

        <section class="storage-form-wrapper">
            <p>
            <h2>Cities you can check:</h2>
            <table class="cities-table">

                <div class="submit-container">
                    <button class="submit_buttton">
                        <a href="<?php echo $rootPath . "/view/cities/cities_add.php" ?>">Add a new City</a>
                    </button>
                </div>

                <br><br><br>

                <tr>
                    <th>
                        Name
                    </th>
                    <th>
                        Delete
                    </th>
                    <th>
                        Edit
                    </th>
                </tr>

                <?php
                foreach ($cities as $city) {
                    $name = $city["name"];
                    $id = $city["id"];
                    $link = $rootPath . "/view/cities/cities_resources.php?id=$id";
                    echo
                        "<tr>
                        <td><a class=\"text_Link\" href=\"$link\">$name</a></td>
                        <td><a class=\"text_Link\" href=\"#\" onclick=\"deleteItem($id)\">Delete</a></td>
                        <td><a class=\"text_Link\" href=\"cities_edit.php?id=$id\">Edit</a></td>
                    </tr>";
                }

                ?>

            </table>

            </p>
        </section>




        <br>

    </main>

</body>

</html>