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
        <script src="../jquery/jquery-3.7.1.js"></script>
        <link rel="stylesheet" href="../css/index.css">
        <title>WMS Inventory - Add Record</title>
    </head>
    <body>
        <?php include("./header.php"); ?>
        <main class="storage-main">
            <h2 class="storage-header">PLACEHOLDER'S INVENTORY</h2>
            <section class="storage-subheader-wrapper">
                <h3 class="storage-subheader" style="max-width: 700px; font-weight: 500;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo laborum vitae eveniet iusto et. Unde non officiis omnis. Explicabo nemo provident accusantium quisquam, officiis maiores facere? Perferendis voluptatum impedit nam!</h3>
            </section>
            <section class="storage-form-wrapper">
                <form class="storage-form" id="storage-form" action="../utils/submission.php" method="POST">
                    <input id="form-submission-type" name="form-submission-type" type="text" id="" style="display: none;">
                    <div class="storage-form-lines-wrapper">
                        <div class="storage-form-line">
                            <label for="storage-category">Category</label>
                            <select name="storage-category" id="storage-category" style="width: 120px;" required>
                                <option value="" selected disabled>Please Select</option>
                                <option value="bin">Bin</option>
                                <option value="truck">Truck</option>
                            </select>
                        </div>
                        <div class="storage-form-line">
                            <label for="storage-volume">Storage Volume</label>
                            <div style="width: 300px; text-align: end; display: flex;">
                                <input name="storage-volume" id="storage-volume" type="number" min="1" max="4000" style="flex-grow: 1;" required>
                                <select name="storage-volume-unit" id="storage-volume-unit" required>
                                    <option value="" selected disabled>Please Select</option>
                                    <option value="liter">Liter</option>
                                    <option value="cubicmeter">Meter&sup3;</option>
                                    <option value="kilogram">Kilogram</option>
                                </select>
                            </div>
                        </div>
                        <div class="storage-form-line">
                            <label for="storage-type">Type</label>
                            <select name="storage-type" id="storage-type" style="width: 120px;" required>
                                <option value="" selected disabled>Please Select</option>
                                <option value="smart">Smart</option>
                                <option value="regular">Regular</option>
                            </select>
                        </div>
                        <div class="storage-form-line">
                            <label for="storage-initial-status">Initial Status</label>
                            <select name="storage-initial-status" id="storage-initial-status" style="width: 120px;" required>
                                <option value="" selected disabled>Please Select</option>
                                <option value="active">Active</option>
                                <option value="maintenance">Maintenance</option>
                                <option value="passive">Passive</option>
                            </select>
                        </div>
                        <div class="storage-form-line">
                            <label for="storage-value">Purchase Value</label>
                            <div style="width: 300px; text-align: end; display: flex;">
                                <input name="storage-value" id="storage-value" type="number" min="1" style="flex-grow: 1;" required>
                                <select name="storage-value-unit" id="storage-value-unit" required>
                                    <option value="" selected disabled>Please Select</option>
                                    <option value="dollar">Dollar</option>
                                    <option value="euro">Euro</option>
                                </select>
                            </div>
                        </div>
                        <div class="storage-form-line">
                            <label for="storage-notifier">Auto-notifier</label>
                            <input type="checkbox" name="storage-notifier" id="storage-notifier">
                        </div>
                        <div class="storage-form-line">
                            <label for="storage-quantity">Quantity</label>
                            <input type="number" min="1" name="storage-quantity" id="storage-quantity" style="width: 300px" required>
                        </div>
                        <div class="storage-form-line">
                            <label for="storage-estimated-lifetime">Estimated Lifetime</label>
                            <div style="width: 300px; text-align: end; display: flex;">
                                <input name="storage-estimated-lifetime" id="storage-estimated-lifetime" type="number" min="1" style="flex-grow: 1;" required>
                                <select name="storage-estimated-lifetime-unit" id="storage-estimated-lifetime-unit" required>
                                    <option value="" selected disabled>Please Select</option>
                                    <option value="year">Year</option>
                                    <option value="month">Months</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </section>
            <div style="width: 100%; padding-top: 20px; margin: auto;">
                <div class="storage-subheader-buttons" style="margin-left: auto;">
                    <button type="button" class="btn btn-white btn-export" id="storage-reset">
                        Reset
                    </button>
                    <button type="submit" class="btn btn-blue btn-create-record" id="storage-create">
                        <span class="storage-action-btn">
                            Create Record
                        </span>
                    </button>
                </div>
            </div>
        </main>
    </body>
    <script src="../js/storage.js"></script>
</html>
