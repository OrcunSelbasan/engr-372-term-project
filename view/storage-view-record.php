<?php
    include("../controller/ControllerAuth.php");
    include("../controller/ControllerStorage.php");
    // * Check if the user is authenticated
    $auth = new ControllerAuth();
    $controller = new ControllerStorage();

    $auth->checkAuth();
    $root = $auth->getRoot();

    $record = $controller->getRecord($_SERVER['QUERY_STRING'], $root);
    $recordId = isset($record['id']) ? $record['id'] : null;

    function checkIsEdit($record, $type = "disabled") {
        $output = ($record['isEdit'] == "false") ? $type : "";
        echo $output;
        return $output == "";
    };

    function editBtn($record, $id = "") {
        $btn = "
        <button class='change-loc' type='button' style='background-color: transparent; border: none;'>
            <svg width='25' height='24' viewBox='0 0 25 24' fill='none' xmlns='http://www.w3.org/2000/svg'>
                <path
                    d='M3.33341 21.3333H5.23342L18.2667 8.3L16.3667 6.4L3.33341 19.4333V21.3333ZM0.666748 24V18.3333L18.2667 0.766667C18.5334 0.522222 18.8279 0.333333 19.1501 0.2C19.4723 0.0666667 19.8112 0 20.1667 0C20.5223 0 20.8667 0.0666667 21.2001 0.2C21.5334 0.333333 21.8223 0.533333 22.0667 0.8L23.9001 2.66667C24.1667 2.91111 24.3612 3.2 24.4834 3.53333C24.6056 3.86667 24.6667 4.2 24.6667 4.53333C24.6667 4.88889 24.6056 5.22778 24.4834 5.55C24.3612 5.87222 24.1667 6.16667 23.9001 6.43333L6.33342 24H0.666748ZM17.3001 7.36667L16.3667 6.4L18.2667 8.3L17.3001 7.36667Z'
                    fill='black' />
            </svg>
        </button>";
        $output = $record['isEdit'] == "false" ? $btn : "";
        echo $output;
    }

    $setSelected = function ($propName, $result) use($record) {
        if (isset($record[$propName]) && $record[$propName] == $result) {
            echo "selected";
        }
    };

    $setValue = function ($propName) use($record) {
        if (isset($record[$propName])) {
            $res = $record[$propName]; 
            echo " value='$res'";
        }
    };

    $setChecked = function ($propName) use($record) {
        if (isset($record[$propName]) && $record[$propName] == "on") {
            echo " checked";
        }
    };
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="../jquery/jquery-3.7.1.js"></script>
        <link rel="stylesheet" href="../css/index.css">
        <!-- TODO: UPDATE THE TITLE -->
        <title>WMS Inventory - Record</title>
    </head>
    <body>
        <?php include("./header.php"); ?>
        <main class="storage-main">
            <h2 class="storage-header">Inventory Record - Item#<?php echo $record['id']?></h2>
            <section class="storage-subheader-wrapper">
                <h3 class="storage-subheader" style="max-width: 700px; font-weight: 500;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo laborum vitae eveniet iusto et. Unde non officiis omnis. Explicabo nemo provident accusantium quisquam, officiis maiores facere? Perferendis voluptatum impedit nam!</h3>
            </section>
            <section class="storage-form-wrapper">
                <form class="storage-form" id="storage-form" action="../utils/submission.php" method="POST">
                    <input id="form-submission-type" name="form-submission-type" type="text" id="" style="display: none;">
                    <input id="storage-method" name="storage-method" type="text" id="" style="display: none;">
                    <input id="storage-object-id" name="storage-object-id" data-identifier='<?php echo $record['id']?>' type="text" style="display: none;">
                    <div class="storage-form-lines-wrapper">
                        <div class="storage-form-line">
                            <label for="storage-category">Category</label>
                            <select name="storage-category" id="storage-category" style="width: 120px;" required <?php checkIsEdit($record) ?>>
                                <option value="" disabled>Please Select</option>
                                <option value="bin" <?php $setSelected('category', 'bin')?>>Bin</option>
                                <option value="truck" <?php $setSelected('category', 'truck') ?>>Truck</option>
                            </select>
                            <?php editBtn($record) ?>
                        </div>
                        <div class="storage-form-line">
                            <label for="storage-volume">Storage Volume</label>
                            <div style="width: 300px; text-align: end; display: flex;">
                                <input name="storage-volume" id="storage-volume" type="number" min="1" max="4000" style="flex-grow: 1;" required <?php checkIsEdit($record); $setValue('volume'); ?>>
                                <select name="storage-volume-unit" id="storage-volume-unit" required <?php checkIsEdit($record) ?>>
                                    <option value="" disabled>Please Select</option>
                                    <option value="liter" <?php $setSelected('volume_unit', 'liter') ?>>Liter</option>
                                    <option value="cubicmeter" <?php $setSelected('volume_unit', 'cubicmeter') ?>>Meter&sup3;</option>
                                    <option value="kilogram" <?php $setSelected('volume_unit', 'kilogram') ?>>Kilogram</option>
                                </select>
                                <?php editBtn($record) ?>
                            </div>
                        </div>
                        <div class="storage-form-line">
                            <label for="storage-type">Type</label>
                            <select name="storage-type" id="storage-type" style="width: 120px;" required <?php checkIsEdit($record) ?>>
                                <option value="" disabled>Please Select</option>
                                <option value="smart" <?php $setSelected('type', 'smart') ?>>Smart</option>
                                <option value="regular" <?php $setSelected('type', 'regular') ?>>Regular</option>
                            </select>
                            <?php editBtn($record) ?>
                        </div>
                        <div class="storage-form-line">
                            <label for="storage-initial-status">Initial Status</label>
                            <select name="storage-initial-status" id="storage-initial-status" style="width: 120px;" required <?php checkIsEdit($record) ?>>
                                <option value="" disabled>Please Select</option>
                                <option value="active" <?php $setSelected('initial_status', 'active') ?>>Active</option>
                                <option value="maintenance" <?php $setSelected('initial_status', 'maintenance') ?>>Maintenance</option>
                                <option value="passive" <?php $setSelected('initial_status', 'passive') ?>>Passive</option>
                            </select>
                            <?php editBtn($record) ?>
                        </div>
                        <div class="storage-form-line">
                            <label for="storage-value">Purchase Value</label>
                            <div style="width: 300px; text-align: end; display: flex;">
                                <input name="storage-value" id="storage-value" type="number" min="1" style="flex-grow: 1;" required <?php checkIsEdit($record); $setValue('value');  ?>>
                                <select name="storage-value-unit" id="storage-value-unit" required <?php checkIsEdit($record) ?>>
                                    <option value="" disabled>Please Select</option>
                                    <option <?php $setSelected('value_unit', 'dollar') ?> value="dollar">Dollar</option>
                                    <option <?php $setSelected('value_unit', 'euro') ?> value="euro">Euro</option>
                                </select>
                                <?php editBtn($record) ?>
                            </div>
                        </div>
                        <div class="storage-form-line">
                            <label for="storage-notifier">Auto-notifier</label>
                            <input type="checkbox" name="storage-notifier" id="storage-notifier" <?php checkIsEdit($record); $setChecked('autonotifier');  ?>>
                            <?php editBtn($record) ?>
                        </div>
                        <div class="storage-form-line">
                            <label for="storage-quantity">Quantity</label>
                            <input type="number" min="1" name="storage-quantity" id="storage-quantity" style="width: 300px" required <?php checkIsEdit($record); $setValue('quantity');  ?>>
                            <?php editBtn($record) ?>
                        </div>
                        <div class="storage-form-line">
                            <label for="storage-estimated-lifetime">Estimated Lifetime</label>
                            <div style="width: 300px; text-align: end; display: flex;">
                                <input name="storage-estimated-lifetime" id="storage-estimated-lifetime" type="number" min="1" style="flex-grow: 1;" required <?php checkIsEdit($record); $setValue('lifetime'); ?>>
                                <select name="storage-estimated-lifetime-unit" id="storage-estimated-lifetime-unit" required <?php checkIsEdit($record) ?>>
                                    <option value="" disabled>Please Select</option>
                                    <option <?php $setSelected('lifetime_unit', 'year') ?> value="year">Year</option>
                                    <option <?php $setSelected('lifetime_unit', 'month') ?> value="month">Months</option>
                                </select>
                                <?php editBtn($record) ?>
                            </div>
                        </div>
                    </div>
                </form>
            </section>
            <div style="width: 100%; padding-top: 20px; margin: auto;">
                <div class="storage-subheader-buttons" style="margin-left: auto; display: flex; width: 100%;">
                    <div style="flex-grow: 1;">
                        <button type="button" class="btn btn-red btn-delete" <?php echo "onclick='deleteItem($recordId)'" ?> style="width: 100px;" id="storage-delete">
                            Delete
                        </button>
                    </div>
                    <button type="button" class="btn btn-blue btn-create-record" style="max-width: 200px;" id="storage-update">
                        <!-- <span class="storage-action-btn"> -->
                            Update
                        <!-- </span> -->
                    </button>
                </div>
            </div>
        </main>
    </body>
    <script src="../js/storage.js"></script>
</html>