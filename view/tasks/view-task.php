<?php
    include("../../controller/ControllerAuth.php");
    include("../../controller/ControllerTasks.php");
    // * Check if the user is authenticated
    $auth = new ControllerAuth();
    $controller = new ControllerTask();

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

    $setSelected = function ($propName, $result) use($record) {
        if (isset($record[$propName]) && $record[$propName] == $result) {
            echo "selected";
        }
    };

    $setBin = function ($propName) use($record) {
        if (isset($record[$propName])) {
            $res = $record[$propName]; 
            echo " value='Bin $res'";
        }
    };

    $setTruck = function ($propName) use($record) {
        if (isset($record[$propName])) {
            $res = $record[$propName]; 
            echo " value='Truck $res'";
        }
    };
    
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="../../jquery/jquery-3.7.1.js"></script> 
        <link rel="stylesheet" href="../../css/tasks.css">
        <title>WMS Inventory - Add Task</title>
    </head>
<body>
    <?php include("../header.php"); ?>
    <main class="employee-container">
        <h2><?php echo($record['title']); ?></h2>
        <section class="employee-form-container" id="employee-form-container">
            <form class="employee-form" autocomplete="off" id="task-form" action="../../utils/submission.php" method="POST">
                <input id="form-submission-type" name="form-submission-type" type="text" id="" style="display: none;">
                <table class="employee-form-table">
        <!-- <tr>
            <td><label for="task-title">Title</label></td>
            <td><input name="task-title" id="task-title" type="text" <?php $setValue('title'); ?> disabled></td>
        </tr> -->
        <tr>
    <td><label for="task-team"><a <?php $team = $record['team']; echo "href='../team.php?team=$team'"?>><b>Team</b></a></label></td>
    <td >
        <select name="task-team" id="task-team" disabled>
            <option value="1" <?php $setSelected('team', 1)?>>1</option>
            <option value="2" <?php $setSelected('team', 2)?>>2</option>
            <option value="3" <?php $setSelected('team', 3)?>>3</option>
            <option value="4" <?php $setSelected('team', 4)?>>4</option>
            <option value="5" <?php $setSelected('team', 5)?>>5</option>
            <option value="6" <?php $setSelected('team', 6)?>>6</option>
            <option value="7" <?php $setSelected('team', 7)?>>7</option>
            <option value="8" <?php $setSelected('team', 8)?>>8</option>
            <option value="9" <?php $setSelected('team', 9)?>>9</option>
        </select>
    </td>
</tr>
<tr>
            <td><a <?php $binId = $record['binId']; echo "href='../storage/storage-view-record.php?id=$binId'"?>><b>Bin</b></a></td>
            <td>
            <input type='text' id='task-binId' name='task-binId' <?php $setBin('binId') ?> disabled>
           
        </td>
        </tr>
<tr>
            <td><a <?php $truckId = $record['truckId']; echo "href='../storage/storage-view-record.php?id=$truckId'"?>><b>Truck</b></a></td>
            <td>
            <input type='text' id='task-truckId' name='task-truckId' <?php $setTruck('truckId') ?> disabled>
           
        </td>
        </tr>
    </table>
               
                <!-- <div class="employee-form-lines-container"> -->
                   
                    <!-- <div class="employee-form-line">
                            <label for="employee-fname">First Name</label>
                            <div class="employee-input">
                                <input name="employee-fname" id="employee-fname" type="text" style="flex-grow: 1;" required>
                            </div>
                        </div>
                    <div class="employee-form-line">
                            <label for="employee-lname">Last Name</label>
                            <div class="employee-input">
                                <input name="employee-lname" id="employee-lname" type="text" style="flex-grow: 1;" required>
                            </div>
                        </div>
                        <div class="employee-form-line">
                            <label for="employee-email">E-Mail</label>
                            <div class="employee-input">
                                <input name="employee-email" id="employee-email" type="text" style="flex-grow: 1;" required>
                            </div>
                        </div>
                        <div class="employee-form-line">
                            <label for="employee-phone">Phone Number</label>
                            <div class="employee-input">
                                <input name="employee-phone" id="employee-phone" type="text" style="flex-grow: 1;" required>
                            </div>
                        </div>
                        <div class="employee-form-line">
                            <label for="employee-salary">Monthly Salary</label>
                            <div class="employee-select">
                                <input name="employee-salary" id="employee-salary" type="number" min="1" style="flex-grow: 1;border-right:0" required>
                                <select name="employee-salary-unit" id="employee-salary-unit" required>
                                    <option value="lira">Lira</option>
                                    <option value="dollar">Dollar</option>
                                    <option value="euro">Euro</option>
                                </select>
                            </div>
                        </div>  -->
                <!-- </div> -->
            </form>
        </section>
        <div style="display: flex;justify-content: flex-end;width:70%;">
                <div id="validate-error" class="validate-error"></div>  
                <div class="add-buttons-container">
                    
                        <button class="reset-button" id="task-reset"  <?php echo "onclick='deleteItem($recordId)'" ?> >Delete</button>
                          
                        <form method='post' action='../../utils/submission.php'>
                            <input type='hidden' name='taskId' id='taskId' value=<?php echo $record['id']; ?>>
                            <input id='form-submission-type' name='form-submission-type' type='text' value='TASKDONE' style='display: none;'>
                
                            <button type="submit" name="markDone"class="btn-add-employee" id="task-markDone" hidden>Mark as done</button>
                        </form> 
                           
                </div>
        </div>
           
    </main>
</body>
<script src="../../js/tasks.js"></script>
</html>