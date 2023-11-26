<?php
    include("../model/User.php");
    include("../controller/ControllerAuth.php");

    $auth = new ControllerAuth();
    $root = $auth::getRoot();
    $user = new User();

    if (empty($_POST['email']) || empty($_POST['password'])) {
        header("Location: $root");
    }

    $userQuery = $user->getByEmail($_POST['email']);

    if ($userQuery->num_rows > 0) {
        $data = $userQuery->fetch_assoc();
        if ($data) {
            $isEmailMatch = $data['email'] === $_POST['email'];
            $isPasswordMatch = password_verify($_POST['password'], $data['password']);
            $isValidCredentials = $isEmailMatch && $isPasswordMatch;
            
            if ($isValidCredentials) {
                $auth::setLogin(true);
                header("Location: $root/view/storage.php");
            } else {
                header("Location: $root");
            }
        }
    }
?>
