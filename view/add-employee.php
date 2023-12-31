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
        <link rel="stylesheet" href="../../css/employees.css">
        <title>WMS Inventory - Add Employee</title>
    </head>
<body>
    <?php include("./header.php"); ?>
    <main class="employee-container">
        <h2>ADD A NEW EMPLOYEE</h2>
        <section class="employee-form-container" id="employee-form-container">
            <form class="employee-form" autocomplete="off" id="employee-form" action="../utils/submission.php" method="POST">
                <input id="form-submission-type" name="form-submission-type" type="text" id="" style="display: none;">
                <table class="employee-form-table">
        <tr>
            <td><label for="employee-fname">First Name</label></td>
            <td><input name="employee-fname" id="employee-fname" type="text" required ></td>
        </tr>
        <tr>
            <td><label for="employee-lname">Last Name</label></td>
            <td><input name="employee-lname" id="employee-lname" type="text" required></td>
        </tr>
        <tr>
            <td><label for="employee-email">E-Mail</label></td>
            <td><input name="employee-email" id="employee-email" type="text" required></td>
        </tr>
        <tr>
            <td><label for="employee-phone">Phone Number</label></td>
            <td><input name="employee-phone" id="employee-phone" type="text" required></td>
        </tr>
       <tr>
    <td><label for="employee-salary">Monthly Salary</label></td>
    <td class="employee-salary-container">
        <input name="employee-salary" id="employee-salary" type="number" min="1" required>
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
        <select name="employee-team" id="employee-team" required>
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
                    
                        <button class="reset-button" id="employee-reset" >Reset</button>
                        <button type="submit" class="btn-add-employee" id="employee-create">Add Employee</button>   
                           
                </div>
        </div>
           
    </main>
</body>
<script src="../js/employees.js"></script>
</html>