<?php
echo "Hello World";
include './controller/ControllerTest.php';
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
    <a href="./view/test.php" id="hi">Go to Test</a>
    <p id="output"></p>
    <button id="test">Test JQuery</button>
    <script src="./js/index.js"></script>
    <?php
    $testVar = new ControllerTest();
    $testVar->execHelper();
    ?>
</body>

</html>