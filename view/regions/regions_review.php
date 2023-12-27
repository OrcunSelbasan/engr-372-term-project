<?php
$rootPath = $_SERVER['DOCUMENT_ROOT'];
$authControllerPath = $rootPath . "/controller/ControllerAuth.php";
$regionsControllerPath = $rootPath . "/controller/ControllerRegions.php";

include($authControllerPath);
include($regionsControllerPath);
// * Check if the user is authenticated
$auth = new ControllerAuth();
$controller = new ControllerRegions();

$auth->checkAuth();
$root = $auth->getRoot();

$record = $controller->getRecord($_SERVER['QUERY_STRING'], $root);
$recordId = isset($record['id']) ? $record['id'] : null;


function checkIsEdit($record, $type = "disabled")
{
    $output = ($record['isEdit'] == "false") ? $type : "";
    echo $output;
    return $output == "";
};

function editBtn($record, $id = "")
{
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

function showBtn($record)
{
    $output = $record['isEdit'] == "false" ? "display: none;" : "";
    echo $output;
}

$setSelected = function ($propName, $result) use ($record) {
    if (isset($record[$propName]) && $record[$propName] == $result) {
        echo "selected";
    }
};

$setValue = function ($propName) use ($record) {
    if (isset($record[$propName])) {
        $res = $record[$propName];
        echo " value='$res'";
    }
};
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
                <input id="regions-object-id" name="regions-object-id" value='<?php echo $record['id'] ?>' type="text" style="position: absolute; left: -1000px;">
                <input id="regions-method" name="regions-method" value="PUT" type="text" id="" style="display: none;">
                <div class="storage-form-lines-wrapper">
                    <div class="storage-form-line">
                        <label for="region-name">Region Name</label>
                        <input type="text" name="region-name" id="region-name" style="width: 300px;" placeholder="Silahtaraga" required <?php checkIsEdit($record);
                                                                                                                                        $setValue('name');  ?>>
                        <?php editBtn($record) ?>
                    </div>
                    <div class="storage-form-line">
                        <label for="region-location">Location (Lat., Lon.)</label>
                        <input name="region-location-lat" id="region-location-lat" type="number" style="border-right: none; width: 100px;" placeholder="40.985496058" required <?php checkIsEdit($record);
                                                                                                                                                                                $setValue('lat'); ?>>
                        <input name="region-location-lon" id="region-location-lon" type="number" style="width: 100px;" placeholder="29.035333192" required <?php checkIsEdit($record);
                                                                                                                                                            $setValue('lon'); ?>>
                        <?php editBtn($record) ?>
                    </div>
                    <div class="storage-form-line">
                        <label for="region-collection-interval">Collection Interval</label>
                        <select name="region-collection-interval" id="region-collection-interval" style="width: 120px;" required <?php checkIsEdit($record); ?>>
                            <option value="" selected disabled>Please Select</option>
                            <option value="daily" <?php $setSelected('collection_interval', 'daily') ?>>Daily</option>
                            <option value="weekly" <?php $setSelected('collection_interval', 'weekly') ?>>Weekly</option>
                            <option value="biweekly" <?php $setSelected('collection_interval', 'biweekly') ?>>Biweekly</option>
                        </select>
                        <?php editBtn($record) ?>
                    </div>
                    <div class="storage-form-line">
                        <label for="region-threshold">Threshold</label>
                        <input name="region-threshold" id="region-threshold" type="number" min="1" style="width: 100px;" placeholder="1000" required <?php checkIsEdit($record);
                                                                                                                                                        $setValue('threshold'); ?>>
                        <?php editBtn($record) ?>
                    </div>
                    <div class="storage-form-line">
                        <label for="region-budget">Allocated Max Budget</label>
                        <input name="region-budget" id="region-budget" type="number" min="1" style="width: 100px;" placeholder="100000" required <?php checkIsEdit($record);
                                                                                                                                                    $setValue('budget'); ?>>
                        <?php editBtn($record) ?>
                    </div>
                </div>
                <button type="submit">Update</button>
            </form>
        </section>
    </main>
    <script>
        document
            .querySelectorAll(".change-loc")
            .forEach((el) => el.addEventListener("click", activateInput));

        function activateInput(params) {
            const currentPath = window.location.href;
            const url = `${currentPath}&edit=1`;
            window.location.replace(url);
        }
    </script>
</body>

</html>