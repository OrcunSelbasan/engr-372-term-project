<?php
    include("./controller/ControllerAuth.php");

    $auth = new ControllerAuth();

    if ($_SESSION['logged_in']) {
    $root = $auth::getRoot();
    header("Location: $root/view/storage.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <script src="./jquery/jquery-3.7.1.js"></script>
    </head>
    <body>
        <form class="login" action="./utils/auth.php" method="POST">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="example@example.com">
            <label for="password">Password</label>
            <input type="password" name="password" id="password">
            <button type="submit">Login</button>
        </form>
    </body>
</html>