<?php
    require_once "./model/User.php";

    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (!User::getUser($_SESSION["user"]->getEmail(), $_POST["pass"])) {
            echo "Wrong password";
        }
        else {
            if ($_POST["newpass"] != $_POST["cnewpass"]) {
                echo "Confirm password should be the same";
            }
            else {
                $_SESSION["user"]->setNewPass($_POST["newpass"]);
                echo 1;
            }
        }
    }
?>