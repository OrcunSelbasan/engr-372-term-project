<?php
    include("../controller/ControllerAuth.php");
    include("../controller/ControllerEmployees.php");
    // * Check if the user is authenticated
    $auth = new ControllerAuth();
    $auth->checkAuth();
    $team = $_GET['team'];
    $controller = new ControllerEmployees();
    $records = $controller->getTeamMembers($team);
    $records = is_array($records) ? $records : [];

    // $sortAttribute = isset($_GET['sort']) ? $_GET['sort'] : 'lname';
    // $sortDescending = isset($_GET['desc']) ? $_GET['desc'] : false;

    // $lastModificationDate = $controller->getLastModDate();

    function addButtons($id)
{   
    return "
            <td class='table-data' >
            <button class='table-action-button' onclick='editItem($id)'>View</button>
             
            </td>
    ";
}

//     function setSorted($target, $sortAttribute){
//         if($sortAttribute == $target){
//             echo"selected";
//         }else{
//             echo "";
//         }
// }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WMS - Team Overview</title>
    <script src="../jquery/jquery-3.7.1.js"></script>
    <script src="../js/employees.js"></script>
    <script>
        function editItem(id) {
            console.log("Edit "+id);
            window.location.href = `employee-view-entry.php?id=${id}`;
        }
        // function addEmployee() {
        //     window.location.href = "add-employee.php";
        // }
        // function sortTable() {
        // var sortAttribute = document.getElementById('sortAttribute').value;
        // var descCheckbox = document.getElementById("desc");
        // var isDescending = descCheckbox.checked;
        // if (isDescending) {
        //     window.location.href = `employees.php?sort=${sortAttribute}&desc=true`;
        // } else {
        //     window.location.href = `employees.php?sort=${sortAttribute}&desc=false`;
        //     }
        // }
    </script>
    <link rel="stylesheet" href="../css/employees.css">
</head>
<body>
    <?php include("./header.php"); ?>
    <main class="employee-container">
    <h2>TEAM <?php echo($team); ?></h2>
    
    <div class="employee-entries">
        <table class="employee-table">
            <tr class="table-header">
                <th class="table-header-data">First Name</th>
                <th class="table-header-data">Last Name</th>
                <th class="table-header-data">E-Mail</th>
                <th class="table-header-data">Phone</th>
                <th class="table-header-data">Salary</th>
                <th class="table-header-data">Modification Date</th>
                <th class="table-header-data">Actions</th>
            </tr>
            <?php
                if (sizeof($records) > 0) {
                    $records = array_reverse($records);
                   
                    foreach ($records as $record) {
                        $id = $record['id'];
                        $team = $record['team'];
                        $fname = $record['fname'];
                        $lname = $record['lname'];
                        $email = $record['email'];
                        $phone = $record['phone'];
                        $salary = $record['salary'];
                        $date = $record['modification_date'];
                        echo "<tr>";
                        echo "<td class='table-data'>$fname</td>";
                        echo "<td class='table-data'>$lname</td>";
                        echo "<td class='table-data'>$email</td>";
                        echo "<td class='table-data'>$phone</td>";
                        echo "<td class='table-data'>$salary</td>";
                        echo "<td class='table-data'>$date</td>";
                        echo addButtons($id);
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