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
        
        <link rel="stylesheet" href="../css/employees.css">
        <title>WMS Inventory - Add Employee</title>
    </head>
<body>
    <?php include("./header.php"); ?>
    <main class="employee-container">
        <h2>ADD A NEW EMPLOYEE</h2>
        <section class="employee-form-container">
            <form class="employee-form" autocomplete="off" id="employee-form" action="../utils/submission.php" method="POST">
                <input id="form-submission-type" name="form-submission-type" type="text" id="" style="display: none;">
                <div class="employee-form-lines-container">
                    <div class="employee-form-line">
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
                        </div> 
                </div>
            
        </form>

    </section>
            <!-- <section class="storage-form-wrapper">
                <form class="storage-form" id="storage-form" action="../utils/submission.php" method="POST">
                    <input id="form-submission-type" name="form-submission-type" type="text" id="" style="display: none;">
                    <div class="storage-form-lines-wrapper">
                        <div class="storage-form-line">
                            <label for="employee-fname">First Name</label>
                            <div style="width: 300px; text-align: end; display: flex; border-right: 2px solid #000;">
                                <input name="employee-fname" id="employee-fname" type="text" style="flex-grow: 1;" required>
                            </div>
                        </div>
                        <div class="storage-form-line">
                            <label for="employee-lname">Last Name</label>
                            <div style="width: 300px; text-align: end; display: flex; border-right: 2px solid #000;">
                                <input name="employee-lname" id="employee-lname" type="text" style="flex-grow: 1;" required>
                            </div>
                        </div>
                        <div class="storage-form-line">
                            <label for="employee-email">E-Mail</label>
                            <div style="width: 300px; text-align: end; display: flex; border-right: 2px solid #000;">
                                <input name="employee-email" id="employee-email" type="text" style="flex-grow: 1;" required>
                            </div>
                        </div>
                        <div class="storage-form-line">
                            <label for="employee-phone">Phone Number</label>
                            <div style="width: 300px; text-align: end; display: flex; border-right: 2px solid #000;">
                                <input name="employee-phone" id="employee-phone" type="text" style="flex-grow: 1;" required>
                            </div>
                        </div>
                        <div class="storage-form-line">
                            <label for="employee-salary">Monthly Salary</label>
                            <div style="width: 300px; text-align: end; display: flex;">
                                <input name="employee-salary" id="employee-salary" type="number" min="1" style="flex-grow: 1;" required>
                                <select name="employee-salary-unit" id="employee-salary-unit" required>
                                    <option value="lira">Lira</option>
                                    <option value="dollar">Dollar</option>
                                    <option value="euro">Euro</option>
                                </select>
                            </div>
                        </div>    
                    </div>
                </form>
            </section> -->
            <div style="width: 100%; padding-top: 20px; margin: auto;">
                <div class="storage-subheader-buttons" style="margin-left: auto;">
                    <button type="button" class="btn btn-white btn-export" id="employee-reset">
                        Reset
                    </button>
                    <button type="submit" class="btn btn-green btn-create-record" id="employee-create">
                        <span class="storage-action-btn">
                            Create Record
                        </span>
                    </button>
                </div>
            </div>
    </main>
</body>
<script src="../js/employees.js"></script>
</html>