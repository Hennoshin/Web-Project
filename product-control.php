<?php
    require_once "./model/Product.php";
    require_once "./model/Supplier.php";

    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $GLOBALS["products"] = getProductArray();
        if ($_SESSION["assupplier"] == true) {
            require_once "./View/product-view.php";
        }
        else {
            $regex = "/" . $_POST["keyword"] . "/i";

            require_once "./View/product-view.php";
        }
    }
?>