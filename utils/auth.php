<?php
    include("../model/User.php");
    include("../controller/ControllerAuth.php");

    $auth = new ControllerAuth();

    session_start();

    $user = new User();

    $userQuery = $user->getByEmail($_POST['email']);

    if ($userQuery->num_rows > 0) {
        $data = $userQuery->fetch_assoc();
        if ($data) {
            $isEmailMatch = $data['email'] === $_POST['email'];
            $isPasswordMatch = password_verify($_POST['password'], $data['password']);
            $isValidCredentials = $isEmailMatch && $isPasswordMatch;
            $root = $auth::getRoot();

            if ($isValidCredentials) {
                $auth::setLogin(true);
                header("Location: $root/view/storage.php");
            } else {
                header("Location: $root");
            }
        }
    }
?>
