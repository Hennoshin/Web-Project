<?php
    require_once "./model/Cart.php";

    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if ((isset($_SESSION["logedin"])) && ($_SESSION["logedin"] == true)) {
            $cart = $_SESSION["cart"];
            switch ($_POST["op"]) {
                case "add":
                    $cart->addProduct($_POST["pid"]);
                    break;
                case "delete":
                    $cart->deleteProduct($_POST["pid"]);
                    break;
                case "edit":
                    $cart->editProduct($_POST["pid"], $_POST["qty"]);
                    break;
            }

            require_once "./View/cart-view.php";
        }
        else {
            echo -1;
        }
        
    }
?>