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
        <!-- TODO: UPDATE THE TITLE -->
        <title>Document</title>
    </head>
    <body>
        <?php include("./header.php"); ?>
        <div style="width: 260px;"></div>
        <main class="storage-main">
            <h2 class="storage-header">PLACEHOLDER'S INVENTORY</h2>
            <section class="storage-subheader-wrapper">
                <h3 class="storage-subheader">Lorem ipsum dolor sit amet</h3>
            </section>
        </main>
    </body>
</html>