<?php
    require_once "./model/User.php";
    require_once "./model/Supplier.php";
    require_once "./model/Cart.php";

    session_start();

    $user = User::getUser($_POST["email"], $_POST["password"]);
    if (!$user) {
        $user = Supplier::getSupplier($_POST["email"], $_POST["password"]);
        if (!$user) {
            echo 0;
        }
        else {
            $_SESSION["user"] = $user;
            $_SESSION["logedin"] = true;
            $_SESSION["assupplier"] = true;
            echo 1;
        }
    }
    else {
        $_SESSION["user"] = $user;
        $_SESSION["logedin"] = true;
        $_SESSION["cart"] = new Cart();

        require_once "./View/user-header.php";
    }
?>