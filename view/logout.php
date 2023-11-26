<?php
    include("../controller/ControllerAuth.php");
    
    $auth = new ControllerAuth();
    $root = $auth::getRoot();

    if ($auth::isLoggedIn()) {
        $auth::setLogin(false);
        header("Location: $root");
    } else {
        header("Location: $root");
    }
?>
