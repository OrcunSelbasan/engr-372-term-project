<?php
    include("./controller/ControllerAuth.php");

    $auth = new ControllerAuth();

    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
        $root = $auth::getRoot();
        header("Location: $root/view/storage.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./css/index.css">
        <script src="./jquery/jquery-3.7.1.js"></script>
        <!-- TODO: UPDATE THE TITLE -->
        <title>Document</title>
    </head>
    <body>
        <main class="login-wrapper">
            <form class="login" action="./utils/auth.php" method="POST">
                <h1>Waste Management System - Login</h1>
                <div class="form-element">
                    <label for="email"><b>Email</b></label>
                    <input type="email" name="email" id="email" placeholder="test@test.com">
                </div>
                <div class="form-element">
                    <label for="password"><b>Password</b></label>
                    <input type="password" name="password" id="password">
                </div>
                <button class="form-element-btn" type="submit">Login</button>
            </form>
        </main>
    </body>
</html>