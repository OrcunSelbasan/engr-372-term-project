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

    $setValue = function ($propName) use($record) {
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
        <script src="../jquery/jquery-3.7.1.js"></script>
        <link rel="stylesheet" href="../css/employees.css">

        <title>WMS Employee View -</title>
    </head>
    <body>
        <?php include("./header.php"); ?>
        <main class="employee-container">
            <h2>Employee Information - <?php echo $record['fname']." ".$record['lname'];?></h2>
            <section class="employee-form-container" id="employee-form-container">
                <form class="employee-form" id="employee-form" action="../utils/submission.php" method="POST">
                    <input id="form-submission-type" name="form-submission-type" type="text" id="" style="display: none;">
                    <input id="storage-method" name="storage-method" type="text" id="" style="display: none;">
                    <input id="employee-object-id" name="employee-object-id" data-identifier='<?php echo $record['id']?>' type="text" style="display: none;">
                    <div class="employee-form-lines-container">
                        <div class="employee-form-line">
                            <label for="employee-fname">First Name</label>
                            <div class="employee-input">
                                <input name="employee-fname" id="employee-fname" type="text" style="flex-grow: 1;" required <?php $setValue('fname'); ?>>
                            </div>
                           
                        </div>
                    <div class="employee-form-line">
                            <label for="employee-lname">Last Name</label>
                            <div class="employee-input">
                                <input name="employee-lname" id="employee-lname" type="text" style="flex-grow: 1;" required <?php  $setValue('lname'); ?>>
                            </div>
                           
                        </div>
                        <div class="employee-form-line">
                            <label for="employee-email">E-Mail</label>
                            <div class="employee-input">
                                <input name="employee-email" id="employee-email" type="text" style="flex-grow: 1;" required <?php  $setValue('email'); ?>>
                            </div>
                           
                        </div>
                        <div class="employee-form-line">
                            <label for="employee-phone">Phone Number</label>
                            <div class="employee-input">
                                <input name="employee-phone" id="employee-phone" type="text" style="flex-grow: 1;" required <?php  $setValue('phone'); ?>>
                            </div>
                            
                        </div>
                        <div class="employee-form-line">
                            <label for="employee-salary">Monthly Salary</label>
                            <div class="employee-select">
                                <input name="employee-salary" id="employee-salary" type="number" min="1" style="flex-grow: 1;border-right:0" required <?php $setValue('salary'); ?>>
                                <select name="employee-salary-unit" id="employee-salary-unit" required>
                                    <option value="lira">Lira</option>
                                    <option value="dollar">Dollar</option>
                                    <option value="euro">Euro</option>
                                </select>
                            </div>
                        </div> 

                    </div>
                </form>
            </section>
            <div style="display: flex;justify-content: flex-end;padding-bottom:20px;">
            <div id="validate-error" class="validate-error"></div>  
             <div class="add-buttons-container">
                <div>
                    <button class="delete-employee" id="employee-delete"  <?php echo "onclick='deleteItem($recordId)'" ?>>Delete</button>
                    <button type="submit" class="btn-add-employee" id="employee-update">Update</button>    
                </div>       
            </div>
    </div>
        </main>
    </body>
   <script src="../js/employees.js"></script> 
</html>