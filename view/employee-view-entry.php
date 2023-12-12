<?php
    include("../controller/ControllerAuth.php");
    include("../controller/ControllerEmployees.php");
    // * Check if the user is authenticated
    $auth = new ControllerAuth();
    $controller = new ControllerEmployees();

    $auth->checkAuth();
    $root = $auth->getRoot();

    $record = $controller->getRecord($_SERVER['QUERY_STRING'], $root);
    $recordId = isset($record['id']) ? $record['id'] : null;
    echo"<script>console.log(\"hey\");</script>";

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

    function showBtn($record) {
        $output = $record['isEdit'] == "false" ? "display: none;" : "";
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
        
        <link rel="stylesheet" href="../css/employees.css">
        <!-- TODO: UPDATE THE TITLE -->
        <title>WMS Employee View -</title>
    </head>
    <body>
        <?php include("./header.php"); ?>
        <main class="storage-main">
            <h2 class="storage-header">Employee Information - <?php echo $record['fname']." ".$record['lname'];?></h2>
            <section class="storage-subheader-wrapper">
                <h3 class="storage-subheader" style="max-width: 700px; font-weight: 500;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo laborum vitae eveniet iusto et. Unde non officiis omnis. Explicabo nemo provident accusantium quisquam, officiis maiores facere? Perferendis voluptatum impedit nam!</h3>
            </section>
            <section class="storage-form-wrapper">
                <form class="employee-form" id="employee-form" action="../utils/submission.php" method="POST">
                    <input id="form-submission-type" name="form-submission-type" type="text" id="" style="display: none;">
                    <input id="storage-method" name="storage-method" type="text" id="" style="display: none;">
                    <input id="employee-object-id" name="employee-object-id" data-identifier='<?php echo $record['id']?>' type="text" style="display: none;">
                    <div class="storage-form-lines-wrapper">
                        
                        
                        <div class="storage-form-line">
                            <label for="employee-fname">First Name</label>
                            <input type="text"  name="employee-fname" id="employee-fname" style="width: 300px" required <?php checkIsEdit($record); $setValue('fname'); ?>>
                            <?php editBtn($record) ?>
                        </div>
                        <div class="storage-form-line">
                            <label for="employee-lname">Last Name</label>
                            <input type="text"  name="employee-lname" id="employee-lname" style="width: 300px" required <?php checkIsEdit($record); $setValue('lname'); ?>>
                            <?php editBtn($record) ?>
                        </div>
                        <div class="storage-form-line">
                            <label for="employee-email">E-Mail</label>
                            <input type="text"  name="employee-email" id="employee-email" style="width: 300px" required <?php checkIsEdit($record); $setValue('email'); ?>>
                            <?php editBtn($record) ?>
                        </div>
                        <div class="storage-form-line">
                            <label for="employee-phone">Phone Number</label>
                            <input type="text"  name="employee-phone" id="employee-phone" style="width: 300px" required <?php checkIsEdit($record); $setValue('phone'); ?>>
                            <?php editBtn($record) ?>
                        </div>
                        <div class="storage-form-line">
                            <label for="employee-salary">Monthly Salary</label>
                            <input type="number"  name="employee-salary" id="employee-salary" style="width: 300px" required <?php checkIsEdit($record); $setValue('salary'); ?>>
                            <?php editBtn($record) ?>
                        </div>
                        
                    </div>
                </form>
            </section>
            <div style="width: 100%; padding-top: 20px; margin: auto;">
                <div class="storage-subheader-buttons" style="margin-left: auto; display: flex; width: 100%; <?php showBtn($record) ?>">
                    <div style="flex-grow: 1;" >
                        <button type="button" class="btn btn-red btn-delete" <?php echo "onclick='deleteItem($recordId)'" ?> style="width: 100px;" id="employee-delete">
                            Delete
                        </button>
                    </div>
                    <button type="button" class="btn btn-green btn-create-record" style="max-width: 200px;" id="employee-update">
                        <!-- <span class="storage-action-btn"> -->
                            Update
                        <!-- </span> -->
                    </button>
                </div>
            </div>
        </main>
    </body>
   <script src="../js/employees.js"></script> 
</html>