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
        <script src="./jquery/jquery-3.7.1.js"></script>
        <link rel="stylesheet" href="../css/index.css">
        <!-- TODO: UPDATE THE TITLE -->
        <title>Document</title>
    </head>
    <body>
        <?php include("./header.php"); ?>
        <div style="width: 260px;"></div>
        <main class="storage-main">
            <h2 class="storage-header">PLACEHOLDER'S INVENTORY</h2>
            <section class="storage-subheader-wrapper">
                <h3 class="storage-subheader">Lorem ipsum dolor sit amet</h3>
                <div class="storage-subheader-buttons">
                    <button class="btn btn-white btn-export">Export</button>
                    <button class="btn btn-blue btn-create-report">Create Report</button>
                </div>
            </section>
            <section class="storage-summary">
                <h3>Summary</h3>
                <div class="storage-summary-row">
                    <div class="storage-summary-row-item">
                        <p>Storage Object: <span>VALUE</span></p>
                    </div>
                    <div class="storage-summary-row-item">
                        <p>Storage Object: <span>VALUE</span></p>
                    </div>
                    <div class="storage-summary-row-item">
                        <p>Storage Object: <span>VALUE</span></p>
                    </div>
                </div>
                <div class="storage-summary-row">
                    <div class="storage-summary-row-item">
                        <p>Storage Object: <span>VALUE</span></p>
                    </div>
                    <div class="storage-summary-row-item">
                        <p>Storage Object: <span>VALUE</span></p>
                    </div>
                    <div class="storage-summary-row-item">
                        <p>Storage Object: <span>VALUE</span></p>
                    </div>
                </div>
                <div class="storage-summary-row">
                    <div class="storage-summary-row-item">
                        <p>Storage Object: <span>VALUE</span></p>
                    </div>
                    <div class="storage-summary-row-item">
                        <p>Storage Object: <span>VALUE</span></p>
                    </div>
                    <div class="storage-summary-row-item">
                        <p>Storage Object: <span>VALUE</span></p>
                    </div>
                </div>
                <div class="storage-summary-row">
                    <button class="btn btn-blue btn-storage-get-snapshot">Get Snapshot</button>
                </div>
            </section>
        </main>
    </body>
</html>