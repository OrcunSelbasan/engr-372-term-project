<?php
    
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="./jquery/jquery-3.7.1.js"></script>
        <link rel="stylesheet" href="./css/index.css">
        <title>WMS Inventory - Add Record</title>
    </head>
    <body>
        <main class="storage-main">
            <h2 class="storage-header" style="text-align: center;">Storage Update Form</h2>
            <section class="storage-form-wrapper" style="width: 700px; margin: auto;">
                <form class="storage-form" id="storage-form" style="width: 600px; height: 350px; margin: auto;" action="./task_submission.php" method="POST">
                    <input id="form-submission-type" name="form-submission-type" type="text" id="" style="display: none;">
                    <div class="storage-form-lines-wrapper" style="justify-content: start;">
                        <div class="storage-form-line" style="flex-grow: 0; margin: 10px;">
                            <label for="employee_id">Employee ID</label>
                            <input name="employee_id" id="employee_id" type="text" style="width: 300px;" required>
                        </div>
                        <div class="storage-form-line" style="flex-grow: 0; margin: 10px;">
                            <label for="storage_id">Storage ID</label>
                            <input name="storage_id" id="storage_id" type="text" style="width: 300px;" required>
                        </div>
                        <div class="storage-form-line" style="flex-grow: 0; margin: 10px;">
                            <label for="region_id">Region ID</label>
                            <input name="region_id" id="region_id" type="text" style="width: 300px;" required>
                        </div>
                        <div class="storage-form-line" style="flex-grow: 0; margin: 10px;">
                            <label for="interaction_time">Interaction Time</label>
                            <input name="interaction_time" id="interaction_time" type="date" style="width: 300px;" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-blue" style="height: 30px; margin-top: 50px;" id="storage-create">
                        <span class="storage-action-btn" style="height: 30px;">
                            Submit
                        </span>
                    </button>
                </form>
            </section>
        </main>
    </body>
</html>
