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

    <title>City Modul</title>
    <link rel="stylesheet" href="../../css/index.css">
    <link rel="stylesheet" href="../../css/cities.css">

</head>

<body>
    <?php include("../header.php"); ?>

    <main>
        <h2 class="storage-header">Welcome to City Modul: ADD</h2>
        <section class="storage-subheader-wrapper">
            <h3 class="storage-subheader" style="max-width: 700px; font-weight: 500;">Lorem ipsum dolor sit amet
                consectetur adipisicing elit. Illo laborum vitae eveniet iusto et. Unde non officiis omnis.
                Explicabo nemo provident accusantium quisquam, officiis maiores facere? Perferendis voluptatum
                impedit nam!</h3>
        </section>

        <section class="storage-form-wrapper">
            <table class="cities-table">
                <tr>
                    <td>
                        <button >
                            <a href="<?php echo $rootPath . "/view/cities/cities_add.php" ?>">Add a new City</a>
                        </button>
                    </td>
                    <td>
                        <button >
                            <a href="<?php echo $rootPath . "/view/cities/cities_edit.php" ?>">Edit a City</a>
                        </button>
                    </td>
                </tr>

            </table>
        </section>









    </main>




</body>

</html>