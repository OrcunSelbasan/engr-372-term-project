<?php
$rootPath = "//" . $_SERVER['HTTP_HOST'];
$storagePath = $rootPath . "/view/storage/storage.php";
$regionsRootPath = $rootPath . "/view/regions/";
$regionsPath = $rootPath . "/view/regions/regions.php";
$citiesPath = $rootPath . "/view/cities.php";
$employeesPath = $rootPath . "/view/employees.php";
$reportsPath = $rootPath . "/view/reports/storage_reports.php";
$tasksPath = $rootPath . "/view/tasks/tasks.php";
$logoutPath = $rootPath . "/view/logout.php";

function getCurrentDirectoryName()
{
    $tmp = explode('/', $_SERVER['REQUEST_URI']);
    $res = explode('.', end($tmp))[0];
    return $res;
}

function getHeader()
{
    $directoryName = getCurrentDirectoryName();
    switch ($directoryName) {
        case 'storage-add-record':
            return "Add Record";
            break;
        case 'storage-view-record':
            if (isset($_GET['edit']) && $_GET['edit'] == '1') {
                return "Edit Record";
            }
            return "View Record";
            break;
        case "employees":
            return "Employees";
            break;
        case "add-employee":
            return "Add Employee";
            break;
        case "employee-view-entry":
            return "Employee";
            break;
        case "tasks":
            return "Tasks";
            break;
        case "add_task":
            return "Tasks";
            break;
        case "view-task":
            return "Tasks";
            break;
        case "storage_reports":
            return "Storage Report";
            break;
        case "cities_report":
            return "Cities Report";
            break;
        case "employees_report":
            return "Employees Report";
            break;
        case "regions_report":
            return "Regions Report";
            break;
        case "tasks_log":
            return "Task Log Report";
            break;
        default:
            return "Storage";
            break;
    }
}

function getClasses()
{
    $directoryName = getCurrentDirectoryName();
    switch ($directoryName) {
        case "storage-add-record":
            // return "bg-brown";
            // break;
        case "storage-view-record":
            // return "bg-green";
            break;
        // case "employees":
        //     return "bg-light-green";
        //     break;
        // case "add-employee":
        //     return "bg-light-green";
        //     break;
        // case "employee-view-entry":
        //     return "bg-light-green";
        //     break;
        default:
            break;
    }
}

function dirHandler()
{
    $str = "";
    if (str_contains($_SERVER['REQUEST_URI'], 'reports/') || str_contains($_SERVER['REQUEST_URI'], 'storage/')) {
        $str = ".";
    }
    echo $str;
}

$header = getHeader();
$className = getClasses();

?>
<header class="header <?php echo $className ?>">
    <nav>
        <h1 style="text-align: center;">WMS <br> <?php echo $header ?></h1>
        <ul class="nav_link_list">
            <li class="nav_link_item">
                <a class="nav_link_a" href="<?php echo $storagePath ?>">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M3.6 24C2.94 24 2.375 23.765 1.905 23.295C1.435 22.825 1.2 22.26 1.2 21.6V8.07C0.84 7.85 0.55 7.565 0.33 7.215C0.11 6.865 0 6.46 0 6V2.4C0 1.74 0.235 1.175 0.705 0.705C1.175 0.235 1.74 0 2.4 0H21.6C22.26 0 22.825 0.235 23.295 0.705C23.765 1.175 24 1.74 24 2.4V6C24 6.46 23.89 6.865 23.67 7.215C23.45 7.565 23.16 7.85 22.8 8.07V21.6C22.8 22.26 22.565 22.825 22.095 23.295C21.625 23.765 21.06 24 20.4 24H3.6ZM3.6 8.4V21.6H20.4V8.4H3.6ZM2.4 6H21.6V2.4H2.4V6ZM8.4 14.4H15.6V12H8.4V14.4Z" fill="white" />
                    </svg>
                    <span class="nav_link_a_span">Storage</span>
                </a>
            </li>
            <div class="nav_link_item" id="regions_link_wrapper">
                <li class="nav_link_item">
                    <a class="nav_link_a" id="regions_link" href="<?php echo $regionsPath ?>">
                        <svg width="24" height="24" viewBox="0 0 20 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4 18C2.9 18 1.95833 17.6083 1.175 16.825C0.391667 16.0417 0 15.1 0 14C0 12.9 0.391667 11.9583 1.175 11.175C1.95833 10.3917 2.9 10 4 10C5.1 10 6.04167 10.3917 6.825 11.175C7.60833 11.9583 8 12.9 8 14C8 15.1 7.60833 16.0417 6.825 16.825C6.04167 17.6083 5.1 18 4 18ZM16 18C14.9 18 13.9583 17.6083 13.175 16.825C12.3917 16.0417 12 15.1 12 14C12 12.9 12.3917 11.9583 13.175 11.175C13.9583 10.3917 14.9 10 16 10C17.1 10 18.0417 10.3917 18.825 11.175C19.6083 11.9583 20 12.9 20 14C20 15.1 19.6083 16.0417 18.825 16.825C18.0417 17.6083 17.1 18 16 18ZM4 16C4.55 16 5.02083 15.8042 5.4125 15.4125C5.80417 15.0208 6 14.55 6 14C6 13.45 5.80417 12.9792 5.4125 12.5875C5.02083 12.1958 4.55 12 4 12C3.45 12 2.97917 12.1958 2.5875 12.5875C2.19583 12.9792 2 13.45 2 14C2 14.55 2.19583 15.0208 2.5875 15.4125C2.97917 15.8042 3.45 16 4 16ZM16 16C16.55 16 17.0208 15.8042 17.4125 15.4125C17.8042 15.0208 18 14.55 18 14C18 13.45 17.8042 12.9792 17.4125 12.5875C17.0208 12.1958 16.55 12 16 12C15.45 12 14.9792 12.1958 14.5875 12.5875C14.1958 12.9792 14 13.45 14 14C14 14.55 14.1958 15.0208 14.5875 15.4125C14.9792 15.8042 15.45 16 16 16ZM10 8C8.9 8 7.95833 7.60833 7.175 6.825C6.39167 6.04167 6 5.1 6 4C6 2.9 6.39167 1.95833 7.175 1.175C7.95833 0.391667 8.9 0 10 0C11.1 0 12.0417 0.391667 12.825 1.175C13.6083 1.95833 14 2.9 14 4C14 5.1 13.6083 6.04167 12.825 6.825C12.0417 7.60833 11.1 8 10 8ZM10 6C10.55 6 11.0208 5.80417 11.4125 5.4125C11.8042 5.02083 12 4.55 12 4C12 3.45 11.8042 2.97917 11.4125 2.5875C11.0208 2.19583 10.55 2 10 2C9.45 2 8.97917 2.19583 8.5875 2.5875C8.19583 2.97917 8 3.45 8 4C8 4.55 8.19583 5.02083 8.5875 5.4125C8.97917 5.80417 9.45 6 10 6Z" fill="white" />
                        </svg>
                        <span class="nav_link_a_span">Regions</span>
                    </a>
                </li>
                <div id="regions_dropdown" style="display: none;">
                    <ul class="nav_link_list">
                        <li style="list-style-type: none; padding: 10px 0;" class="regions_dropdown_link_item" id="regions_dropdown_create"><a href="<?php echo $regionsPath ?>">Overview</a></li>
                        <li style="list-style-type: none; padding: 10px 0;" class="regions_dropdown_link_item" id="regions_dropdown_create"><a href="<?php echo $regionsRootPath . "regions_create.php" ?>">Create Region</a></li>
                        <!-- <li style="list-style-type: none; padding: 10px 0;" class="regions_dropdown_link_item" id="regions_dropdown_update"><a href="<?php echo $regionsRootPath . "regions_update.php" ?>">Update Region</a></li>
                        <li style="list-style-type: none; padding: 10px 0;" class="regions_dropdown_link_item" id="regions_dropdown_review"><a href="<?php echo $regionsRootPath . "regions_review.php" ?>">Review Region</li></a> -->
                    </ul>
                </div>
            </div>
            <div class="nav_link_item" id="cities_link_wrapper">
                <li class="nav_link_item">
                    <a class="nav_link_a" id="cities_link" href="<?php echo $citiesPath ?>">
                        <svg width="24" height="24" viewBox="0 0 18 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0 19V5H6V3L9 0L12 3V9H18V19H0ZM2 17H4V15H2V17ZM2 13H4V11H2V13ZM2 9H4V7H2V9ZM8 17H10V15H8V17ZM8 13H10V11H8V13ZM8 9H10V7H8V9ZM8 5H10V3H8V5ZM14 17H16V15H14V17ZM14 13H16V11H14V13Z" fill="white" />
                        </svg>
                        <span class="nav_link_a_span">Cities</span>
                    </a>
                </li>
                <div id="cities_dropdown" style="display: none;">
                    <ul class="nav_link_list">
                        <li style="list-style-type: none; padding: 10px 0;" class="regions_dropdown_link_item" id="regions_dropdown_create"><a href="<?php echo $rootPath . "/view/cities/cities_overview.php" ?>">Overview</a></li>
                        <li style="list-style-type: none; padding: 10px 0;" class="regions_dropdown_link_item" id="regions_dropdown_update"><a href="<?php echo $rootPath . "/view/cities/cities_add.php" ?>">Add a City</a></li>
                    </ul>
                </div>
            </div>
            <li class="nav_link_item">
                <a class="nav_link_a" href="<?php echo $employeesPath ?>">
                    <svg width="24" height="24" viewBox="0 0 22 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0 16V12C0 11.4333 0.195833 10.9583 0.5875 10.575C0.979167 10.1917 1.45 10 2 10H5.275C5.60833 10 5.925 10.0833 6.225 10.25C6.525 10.4167 6.76667 10.6417 6.95 10.925C7.43333 11.575 8.02917 12.0833 8.7375 12.45C9.44583 12.8167 10.2 13 11 13C11.8167 13 12.5792 12.8167 13.2875 12.45C13.9958 12.0833 14.5833 11.575 15.05 10.925C15.2667 10.6417 15.5208 10.4167 15.8125 10.25C16.1042 10.0833 16.4083 10 16.725 10H20C20.5667 10 21.0417 10.1917 21.425 10.575C21.8083 10.9583 22 11.4333 22 12V16H15V13.725C14.4167 14.1417 13.7875 14.4583 13.1125 14.675C12.4375 14.8917 11.7333 15 11 15C10.2833 15 9.58333 14.8875 8.9 14.6625C8.21667 14.4375 7.58333 14.1167 7 13.7V16H0ZM11 12C10.3667 12 9.76667 11.8542 9.2 11.5625C8.63333 11.2708 8.15833 10.8667 7.775 10.35C7.49167 9.93333 7.1375 9.60417 6.7125 9.3625C6.2875 9.12083 5.825 9 5.325 9C5.69167 8.38333 6.46667 7.89583 7.65 7.5375C8.83333 7.17917 9.95 7 11 7C12.05 7 13.1667 7.17917 14.35 7.5375C15.5333 7.89583 16.3083 8.38333 16.675 9C16.1917 9 15.7333 9.12083 15.3 9.3625C14.8667 9.60417 14.5083 9.93333 14.225 10.35C13.8583 10.8833 13.3917 11.2917 12.825 11.575C12.2583 11.8583 11.65 12 11 12ZM3 9C2.16667 9 1.45833 8.70833 0.875 8.125C0.291667 7.54167 0 6.83333 0 6C0 5.15 0.291667 4.4375 0.875 3.8625C1.45833 3.2875 2.16667 3 3 3C3.85 3 4.5625 3.2875 5.1375 3.8625C5.7125 4.4375 6 5.15 6 6C6 6.83333 5.7125 7.54167 5.1375 8.125C4.5625 8.70833 3.85 9 3 9ZM19 9C18.1667 9 17.4583 8.70833 16.875 8.125C16.2917 7.54167 16 6.83333 16 6C16 5.15 16.2917 4.4375 16.875 3.8625C17.4583 3.2875 18.1667 3 19 3C19.85 3 20.5625 3.2875 21.1375 3.8625C21.7125 4.4375 22 5.15 22 6C22 6.83333 21.7125 7.54167 21.1375 8.125C20.5625 8.70833 19.85 9 19 9ZM11 6C10.1667 6 9.45833 5.70833 8.875 5.125C8.29167 4.54167 8 3.83333 8 3C8 2.15 8.29167 1.4375 8.875 0.8625C9.45833 0.2875 10.1667 0 11 0C11.85 0 12.5625 0.2875 13.1375 0.8625C13.7125 1.4375 14 2.15 14 3C14 3.83333 13.7125 4.54167 13.1375 5.125C12.5625 5.70833 11.85 6 11 6Z" fill="white" />
                    </svg>
                    <span class="nav_link_a_span">Employees</span>
                </a>
            </li>
            <li class="nav_link_item">
                <a class="nav_link_a" href="<?php echo $reportsPath ?>">
                    <svg width="24" height="24" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M5 6C5.28333 6 5.52083 5.90417 5.7125 5.7125C5.90417 5.52083 6 5.28333 6 5C6 4.71667 5.90417 4.47917 5.7125 4.2875C5.52083 4.09583 5.28333 4 5 4C4.71667 4 4.47917 4.09583 4.2875 4.2875C4.09583 4.47917 4 4.71667 4 5C4 5.28333 4.09583 5.52083 4.2875 5.7125C4.47917 5.90417 4.71667 6 5 6ZM5 10C5.28333 10 5.52083 9.90417 5.7125 9.7125C5.90417 9.52083 6 9.28333 6 9C6 8.71667 5.90417 8.47917 5.7125 8.2875C5.52083 8.09583 5.28333 8 5 8C4.71667 8 4.47917 8.09583 4.2875 8.2875C4.09583 8.47917 4 8.71667 4 9C4 9.28333 4.09583 9.52083 4.2875 9.7125C4.47917 9.90417 4.71667 10 5 10ZM5 14C5.28333 14 5.52083 13.9042 5.7125 13.7125C5.90417 13.5208 6 13.2833 6 13C6 12.7167 5.90417 12.4792 5.7125 12.2875C5.52083 12.0958 5.28333 12 5 12C4.71667 12 4.47917 12.0958 4.2875 12.2875C4.09583 12.4792 4 12.7167 4 13C4 13.2833 4.09583 13.5208 4.2875 13.7125C4.47917 13.9042 4.71667 14 5 14ZM2 18C1.45 18 0.979167 17.8042 0.5875 17.4125C0.195833 17.0208 0 16.55 0 16V2C0 1.45 0.195833 0.979167 0.5875 0.5875C0.979167 0.195833 1.45 0 2 0H13L18 5V16C18 16.55 17.8042 17.0208 17.4125 17.4125C17.0208 17.8042 16.55 18 16 18H2ZM2 16H16V6H12V2H2V16Z" fill="white" />
                    </svg>
                    <span class="nav_link_a_span">Reports</span>
                </a>
            </li>
            <li class="nav_link_item">
                <a class="nav_link_a" href="<?php echo $tasksPath ?>">
                    
                    <svg xmlns="http://www.w3.org/2000/svg" height="24" width="24" viewBox="0 -960 960 960" width="24"><path d="m438-240 226-226-58-58-169 169-84-84-57 57 142 142ZM240-80q-33 0-56.5-23.5T160-160v-640q0-33 23.5-56.5T240-880h320l240 240v480q0 33-23.5 56.5T720-80H240Zm280-520v-200H240v640h480v-440H520ZM240-800v200-200 640-640Z" fill="white"/></svg>
                    <span class="nav_link_a_span">Tasks</span>
                </a>
            </li>
        </ul>
        <a class="nav_link nav_link_item" href="<?php echo $logoutPath ?>">
            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M2 18C1.45 18 0.979167 17.8042 0.5875 17.4125C0.195833 17.0208 0 16.55 0 16V2C0 1.45 0.195833 0.979167 0.5875 0.5875C0.979167 0.195833 1.45 0 2 0H9V2H2V16H9V18H2ZM13 14L11.625 12.55L14.175 10H6V8H14.175L11.625 5.45L13 4L18 9L13 14Z" fill="white" />
            </svg>
            <span class="nav_link_a_span">Logout</span></a>
    </nav>
    <script>
        $('#regions_link').mouseenter(function() {
            $("#regions_dropdown").slideDown();
        });
        $('#regions_link_wrapper').mouseleave(function() {
            $("#regions_dropdown").slideUp();
        });
        $('#cities_link').mouseenter(function() {
            $("#cities_dropdown").slideDown();
        });
        $('#cities_link_wrapper').mouseleave(function() {
            $("#cities_dropdown").slideUp();
        });
    </script>
</header>