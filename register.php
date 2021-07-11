<?php
    require_once "./Model/User.php";

    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $user = new User($_POST["emailreg"], $_POST["namereg"], $_POST["addressreg"]);

        if ($user->insertUser($_POST["passwordreg"])) {
            echo 1;
        }
        else {
            echo "Email has already been used";
        }
    }
?>