<?php
    include("../controller/ControllerAuth.php");
    include("../controller/ControllerEmployees.php");
    // * Check if the user is authenticated
    $auth = new ControllerAuth();
    $auth->checkAuth();
    
    $controller = new ControllerEmployees();
    $records = $controller->getAllRecords();
    $records = is_array($records) ? $records : [];

    function editActionHTML($id)
{
    return  "
        <td class='table-data'>
        <button class='table-data-delete-btn' onclick='deleteItem($id)'>
            <svg width='22' height='24' viewBox='0 0 22 24' fill='none' xmlns='http://www.w3.org/2000/svg'>
                <path d='M4 24C3.26667 24 2.63889 23.7389 2.11667 23.2167C1.59444 22.6944 1.33333 22.0667 1.33333 21.3333V4H0V1.33333H6.66667V0H14.6667V1.33333H21.3333V4H20V21.3333C20 22.0667 19.7389 22.6944 19.2167 23.2167C18.6944 23.7389 18.0667 24 17.3333 24H4ZM17.3333 4H4V21.3333H17.3333V4ZM6.66667 18.6667H9.33333V6.66667H6.66667V18.6667ZM12 18.6667H14.6667V6.66667H12V18.6667Z' fill='black'/>
            </svg>
        </button>
        <a href='./employee-view-entry.php?edit=true&id=$id'>
            <svg width='25' height='24' viewBox='0 0 25 24' fill='none' xmlns='http://www.w3.org/2000/svg'>
                <path
                    d='M3.33341 21.3333H5.23342L18.2667 8.3L16.3667 6.4L3.33341 19.4333V21.3333ZM0.666748 24V18.3333L18.2667 0.766667C18.5334 0.522222 18.8279 0.333333 19.1501 0.2C19.4723 0.0666667 19.8112 0 20.1667 0C20.5223 0 20.8667 0.0666667 21.2001 0.2C21.5334 0.333333 21.8223 0.533333 22.0667 0.8L23.9001 2.66667C24.1667 2.91111 24.3612 3.2 24.4834 3.53333C24.6056 3.86667 24.6667 4.2 24.6667 4.53333C24.6667 4.88889 24.6056 5.22778 24.4834 5.55C24.3612 5.87222 24.1667 6.16667 23.9001 6.43333L6.33342 24H0.666748ZM17.3001 7.36667L16.3667 6.4L18.2667 8.3L17.3001 7.36667Z'
                    fill='black' />
            </svg>
        </a>
        <a href='./employee-view-entry.php?id=$id'>
            <svg width='24' height='24' viewBox='0 0 24 24' fill='none' xmlns='http://www.w3.org/2000/svg'>
                <path
                    d='M2.66667 24C1.93333 24 1.30556 23.7389 0.783333 23.2167C0.261111 22.6944 0 22.0667 0 21.3333V2.66667C0 1.93333 0.261111 1.30556 0.783333 0.783333C1.30556 0.261111 1.93333 0 2.66667 0H12V2.66667H2.66667V21.3333H21.3333V12H24V21.3333C24 22.0667 23.7389 22.6944 23.2167 23.2167C22.6944 23.7389 22.0667 24 21.3333 24H2.66667ZM8.93333 16.9333L7.06667 15.0667L19.4667 2.66667H14.6667V0H24V9.33333H21.3333V4.53333L8.93333 16.9333Z'
                    fill='black' />
            </svg>
        </a>
    </td>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WMS - Employee Overview</title>
    <script src="../jquery/jquery-3.7.1.js"></script>
    <script src="../js/employees.js"></script>
    <link rel="stylesheet" href="../css/employees.css">
</head>
<body>
    <?php include("./header.php"); ?>
    <main class="employee-container">
    <h1>Employees</h1>
    <div class="header-flex">
            <h2 style="font-weight: 400;">Last Modification Date:  <?php echo(end($records)['modification_date']) ?></h2>
            <button class="btn-create-employee">
                    <a href="./add-employee.php" >
                        Add employee
                    </a>
                </button>
    </div>
    <div class="stats-flex">
        <?php echo "Total number of employees: "." "."<span style='font-weight: 500;margin-left:4px;'>".count($records) ."</span>"?>
    </div>
    <div class="employee-entries">
        <table class="employee-table">
            <tr class="table-header">
                <th class="table-header-data">ID</th>
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
                    
                    // sort the entries by last name
                     function compare_lastname($a, $b){
                        return strnatcmp($a['lname'], $b['lname']);
                    }

                    // sort alphabetically by name
                    usort($records, 'compare_lastname');

                    
                    foreach ($records as $record) {
                        $id = $record['id'];
                        $fname = $record['fname'];
                        $lname = $record['lname'];
                        $email = $record['email'];
                        $phone = $record['phone'];
                        $salary = $record['salary'];
                        $date = $record['modification_date'];
                        echo "<tr>";
                        echo "<td class='table-data'>$id</td>";
                        echo "<td class='table-data'>$fname</td>";
                        echo "<td class='table-data'>$lname</td>";
                        echo "<td class='table-data'>$email</td>";
                        echo "<td class='table-data'>$phone</td>";
                        echo "<td class='table-data'>$salary</td>";
                        echo "<td class='table-data'>$date</td>";
                        echo editActionHTML($id);
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