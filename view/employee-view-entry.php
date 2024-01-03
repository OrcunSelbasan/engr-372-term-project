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
                    <input id="employee-method" name="employee-method" type="text" id="" style="display: none;">
                    <input id="employee-object-id" name="employee-object-id" data-identifier='<?php echo $record['id']?>' type="text" style="display: none;">
                    <table class="employee-form-table">
                        <tr>
            <td><label for="employee-fname">First Name</label></td>
            <td><input name="employee-fname" id="employee-fname" type="text" required <?php $setValue('fname'); ?>></td>
        </tr>
        <tr>
            <td><label for="employee-lname">Last Name</label></td>
            <td><input name="employee-lname" id="employee-lname" type="text" required <?php  $setValue('lname'); ?>></td>
        </tr>
        <tr>
            <td><label for="employee-email">E-Mail</label></td>
            <td><input name="employee-email" id="employee-email" type="text" required <?php  $setValue('email'); ?>></td>
        </tr>
        <tr>
            <td><label for="employee-phone">Phone Number</label></td>
            <td><input name="employee-phone" id="employee-phone" type="text" required <?php  $setValue('phone'); ?>></td>
        </tr>
       <tr>
    <td><label for="employee-salary">Monthly Salary</label></td>
    <td class="employee-salary-container">
        <input name="employee-salary" id="employee-salary" type="number" min="1" required <?php $setValue('salary'); ?>>
        <select name="employee-salary-unit" id="employee-salary-unit" required>
            <option value="lira">&#8378;</option>
            <option value="dollar">&#36;</option>
            <option value="euro">&#8364;</option>
        </select>
    </td>
</tr>
<tr>
    <td>
        <label for="employee-team">Team</label>
    </td>
    <td>
        <select name="employee-team" id="employee-team" required <?php $setValue('team'); ?>>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>
        </select>
    </td>
</tr>
                    </table>
                    
                    
                
                </form>
            </section>
            <div style="display: flex;justify-content: flex-end;width:70%;">
            <div id="validate-error" class="validate-error"></div>  
             <div class="add-buttons-container">
                
                    <button class="delete-employee" id="employee-delete"  <?php echo "onclick='deleteItem($recordId)'" ?>>Delete</button>
                    <button type="submit" class="btn-add-employee" id="employee-update">Update</button>    
                       
            </div>
    </div>
        </main>
    </body>
   <script src="../js/employees.js"></script> 
</html>