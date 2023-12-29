<?php
    include("../../controller/ControllerAuth.php");
    include("../../controller/ControllerStorage.php");
    // * Check if the user is authenticated
    $auth = new ControllerAuth();
    $auth->checkAuth();
    $storage = new ControllerStorage();
    $bins = $storage->getAvailableBins();
    $bins = is_array($bins) ? $bins : [];
    $trucks = $storage ->getTrucks();
    $trucks = is_array($trucks) ? $trucks : [];
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
        <h2>ADD A NEW TASK</h2>
        <section class="employee-form-container" id="employee-form-container">
            <form class="employee-form" autocomplete="off" id="task-form" action="../../utils/submission.php" method="POST">
                <input id="form-submission-type" name="form-submission-type" type="text" id="" style="display: none;">
                <table class="employee-form-table">
        <tr>
            <td><label for="task-title">Title</label></td>
            <td><input name="task-title" id="task-title" type="text" required></td>
        </tr>
    <td><label for="task-team">Team</label></td>
    <td >
        <select name="task-team" id="task-team" required>
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
<tr>
            <td>Available Bins</td>
            <td></td>
        </tr>
<?php
if (sizeof($bins) > 0) {
                    
                    foreach ($bins as $bin) {
                        $id = $bin['id'];  
                        $vol = $bin['volume'];
                        $unit = $bin['volume_unit'];                    
                        echo "<tr>";
                        echo "<td><input type='radio' id='$id' name='task-binId' value='$id'></td>";
                        echo "<td class='storage-table-data'><a href='../storage/storage-view-record.php?id=$id'>Bin $id - Volume $vol $unit</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='12' align='center'>No information.</td></tr>";
                }
echo "<tr><td>Available Trucks</td><td></td></tr>";
if (sizeof($bins) > 0) {
                    
                    foreach ($trucks as $truck) {
                        $id = $truck['id'];  
                        $vol = $truck['volume'];
                        $unit = $truck['volume_unit'];                    
                        echo "<tr>";
                        echo "<td><input type='radio' id='$id' name='task-truckId' value='$id'></td>";
                        echo "<td class='storage-table-data'><a href='../storage/storage-view-record.php?id=$id'>Truck $id - Volume $vol $unit</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='12' align='center'>No information.</td></tr>";
                }
                

?>
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
                    
                        <button class="reset-button" id="task-reset"  >Reset</button>
                        <button type="submit" class="btn-add-employee" id="task-create">Create Task</button>   
                           
                </div>
        </div>
           
    </main>
</body>
<script src="../../js/tasks.js"></script>
</html>