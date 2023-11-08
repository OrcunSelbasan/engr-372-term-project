<header>
    <nav>
        <h1>WMS - <?php 
            $tmp = explode('/', $_SERVER['REQUEST_URI']);
            $res = explode('.', end($tmp))[0]; 
            echo ucfirst($res);
        ?></h1>
        <ul class="nav_link_list">
            <li class="nav_link_item"><a href="./storage.php">Storage</a></li>
            <li class="nav_link_item"><a href="./regions.php">Regions</a></li>
            <li class="nav_link_item"><a href="./cities.php">Cities</a></li>
            <li class="nav_link_item"><a href="./employees.php">Employees</a></li>
            <li class="nav_link_item"><a href="./reports.php">Reports</a></li>
        </ul>
        <a class="nav_link nav_link_item" href="./logout.php">Logout</a>
    </nav>
</header>