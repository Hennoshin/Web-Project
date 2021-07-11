<?php
    require_once "./model/User.php";

    session_start();
    $uname = "";

    if ($_SESSION["logedin"]) {
        $user = $_SESSION["user"];
        $uname = $user->getName();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div>
        <p>Welcome</p>
        <?php echo htmlspecialchars($uname); ?>
    </div>
</body>
</html>