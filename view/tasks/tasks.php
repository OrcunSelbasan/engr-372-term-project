<?php
$rootPath = $_SERVER['DOCUMENT_ROOT'];
$authControllerPath = $rootPath . "/controller/ControllerAuth.php";
$taskControllerPath = $rootPath . "/controller/ControllerTasks.php";
include($authControllerPath);
include($taskControllerPath);
    // * Check if the user is authenticated
    $auth = new ControllerAuth();
    $auth->checkAuth();
    
    $controller = new ControllerTask();

    $sortAttribute = isset($_GET['sort']) ? $_GET['sort'] : 'all';

    $records = $controller->getAllRecords();
    $count=count($records);

    if($sortAttribute=="all"){
        $records = $controller->getAllRecords();
    }elseif ($sortAttribute=="ip") {
        $records = $controller->getRecordsByStatus("in progress");
    }elseif ($sortAttribute=="done") {
        $records = $controller->getRecordsByStatus("done");
    }

    
    
    
    $records = is_array($records) ? $records : [];

    $lastModificationDate = $controller->getLastModDate();

    

    

    function addButtons($id)
{   
    return "
            <td class='table-data'>
            <button class='table-action-button' onclick='viewTask($id)'>View</button>
            <form method='post' action='../../utils/submission.php'>
                <input type='hidden' name='taskId' id='taskId' value='$id'>
                <input id='form-submission-type' name='form-submission-type' type='text' value='TASKDONE' style='display: none;'>
                
                <button class='table-action-button-delete' type='submit' name='markDone'>Done</button>
            </form>
        </td>
    ";
}

    function addButtonsDone($id)
{   
    return "
            <td class='table-data'>
            
                
                <button class='table-action-button' onclick='viewTask($id)'>View</button>
                
           
        </td>
    ";
}

    function setSorted($target, $sortAttribute){
        if($sortAttribute == $target){
            echo"selected";
        }else{
            echo "";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WMS - Employee Overview</title>
    <link rel="stylesheet" href="../../css/tasks.css">
    <script src="../../jquery/jquery-3.7.1.js"></script>
    <!-- <script src="../js/employees.js"></script> -->
    <script>
        function viewTask(id) {
            console.log("Edit "+id);
            window.location.href = `./view-task.php?id=${id}`;
        }
        function addTask() {
            window.location.href = "./add_task.php";
        }
       function sortTable() {
        var sortAttribute = document.getElementById('sortAttribute').value;
        window.location.href = `tasks.php?sort=${sortAttribute}`;
        }
    </script>
    
</head>
<body>
    <?php include("../header.php"); ?>
    <main class="employee-container">
    <h2>TASK INVENTORY</h2>
    <div class="header-flex">
            <h3 style="font-weight: 500;">Last Modification Date:  <?php echo"$lastModificationDate"; ?></h3>
            <div class="employee-subheader-buttons">
                <button class="btn-create-employee" onclick="addTask()">
                    Add Task
                </button>
            </div>
            
    </div>
    <div class="stats-flex">
        <?php echo "<div style='font-size:16px;'>Total number of tasks: "." "."<span style='font-weight: 500;margin-left:4px;'>".$count ."</span></div>"?>
        <div class="sorting-options">
            <label for="sortAttribute">Show</label>
            <select id="sortAttribute" onchange="sortTable()" style="margin-left:5px;">
                <option value="all" <?php setSorted("all",$sortAttribute);?>>All</option>
                <option value="ip" <?php setSorted("ip",$sortAttribute);?>>In Progress</option>
                <option value="done" <?php setSorted("done",$sortAttribute);?>>Finished</option>
            </select>
        </div>
        <!-- <div class="sorting-options">
            <label for="sortAttribute">Sort by:</label>
            <select id="sortAttribute" onchange="sortTable()" style="margin-left:5px;">
                <option value="fname">First Name</option>
                <option value="lname">Last Name</option>
                <option value="email>E-Mail</option>
                <option value="salary" >Salary</option>
                <option value="modification_date" >Date</option>
            </select>
            <label for="desc" style="margin-left:10px;">Descending</label>
            <input type="checkbox" name="desc" id="desc" onchange="sortTable()" value="Descending">
        </div> -->
    </div>
    
    <div class="employee-entries">
        <table class="employee-table">
            <tr class="table-header">
                <!-- <th class="table-header-data">ID</th> -->
                <th class="table-header-data">Title</th>
                <th class="table-header-data">Team Number</th>
                <th class="table-header-data">Status</th>
                <th class="table-header-data">Bin</th>
                <th class="table-header-data">Truck</th>
                <th class="table-header-data">Modification Date</th>
                <th class="table-header-data">Actions</th>
            </tr>
            <?php
                if (sizeof($records) > 0) {
                    $records = array_reverse($records);
                    
                    // usort($records, function($a, $b) use ($sortAttribute) {
                    //     return strnatcmp($a[$sortAttribute], $b[$sortAttribute]);
                    // });

                    // if ($sortDescending=='true') {
                    //     $records = array_reverse($records);
                    // }
                   
                    foreach ($records as $record) {
                        
                            $id = $record['id'];
                            $title = $record['title'];
                            $team = $record['team'];
                            $status = $record['status'];
                            $binId = $record['binId'];
                            $truckId = $record['truckId'];
                            $date = $record['modification_date'];
                            echo "<tr>";
                            // echo "<td class='table-data'>$id</td>";
                            echo "<td class='table-data'>$title</td>";
                            echo "<td class='table-data'>$team</td>";
                            echo "<td class='table-data'>$status</td>";
                            echo "<td class='table-data'>$binId</td>";
                            echo "<td class='table-data'>$truckId</td>";
                            echo "<td class='table-data'>$date</td>";
                            if ($status=="done") {
                                echo addButtonsDone($id);
                            }else {
                                echo addButtons($id);
                            }
                            echo "</tr>";
                            
                        
                    }
                } else {
                    echo "<tr><td colspan='12' align='center'>No information.</td></tr>";
                }

                ?>

        </table>

    </div>
    
    
</main>
    
</body>
</html>