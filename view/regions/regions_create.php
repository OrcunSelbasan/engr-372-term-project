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
    <main class="storage-main">
        <h2 class="storage-header">Welcome to the Region Management System! CREATE</h2>
        <section class="storage-subheader-wrapper">
            <h3 class="storage-subheader" style="max-width: 700px; font-weight: 500;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo laborum vitae eveniet iusto et. Unde non officiis omnis. Explicabo nemo provident accusantium quisquam, officiis maiores facere? Perferendis voluptatum impedit nam!</h3>
        </section>
        <section class="storage-form-wrapper" style="width: 700px;">
            <form class="storage-form" id="region-form" style="height: 300px;" action="../../utils/submission.php" method="POST">
                <input id="form-submission-type" name="form-submission-type" value="REGIONS" type="text" id="" style="position: absolute; left: -1000px;">
                <input id="regions-method" name="regions-method" type="text" id="" style="display: none;">
                <div class="storage-form-lines-wrapper">
                    <div class="storage-form-line">
                        <label for="region-name">Region Name</label>
                        <input type="text" name="region-name" id="region-name" style="width: 300px;" placeholder="Silahtaraga" required>
                    </div>
                    <div class="storage-form-line">
                        <label for="region-location">Location (Lat., Lon.)</label>
                        <input name="region-location-lat" id="region-location-lat" type="number" style="border-right: none; width: 100px;" placeholder="40.985496058" required>
                        <input name="region-location-lon" id="region-location-lon" type="number" style="width: 100px;" placeholder="29.035333192" required>
                    </div>
                    <div class="storage-form-line">
                        <label for="region-collection-interval">Collection Interval</label>
                        <select name="region-collection-interval" id="region-collection-interval" style="width: 120px;" required>
                            <option value="" selected disabled>Please Select</option>
                            <option value="daily">Daily</option>
                            <option value="weekly">Weekly</option>
                            <option value="biweekly">Biweekly</option>
                        </select>
                    </div>
                    <div class="storage-form-line">
                        <label for="region-threshold">Threshold</label>
                        <input name="region-threshold" id="region-threshold" type="number" min="1" style="width: 100px;" placeholder="1000" required>
                    </div>
                    <div class="storage-form-line">
                        <label for="region-budget">Allocated Max Budget</label>
                        <input name="region-budget" id="region-budget" type="number" min="1" style="width: 100px;" placeholder="100000" required>
                    </div>
                </div>
                <button type="submit"> Create</button>
            </form>
        </section>


    </main>
</body>

</html>