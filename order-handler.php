<?php
    require_once "./model/OrderHistory.php";
    require_once "./model/User.php";
    require_once "./model/Cart.php";
    require_once "./model/Supplier.php";

    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_SESSION["assupplier"])) {
            $GLOBALS["order"] = OrderHistory::getOrderArrayManf($_SESSION["user"]->getManufacturer());
            require_once "./View/order-view.php";
        }
        else {
            if ($_POST["op"] == "add") {
                $uid = $_SESSION["user"]->getEmail();
                $items = $_SESSION["cart"]->getItems();
                $total = 0;
                foreach ($items as $id => $qty) {
                    $total += Product::getProduct($id)->getPrice() * $qty;
                }
            
                $order = new OrderHistory($uid, date("Y-m-d"), $items, $total);
                $order->insertOrder();
                echo mysqli_error($GLOBALS["link"]);
            }
            else if ($_POST["op"] == "show") {
                $ords = OrderHistory::getOrderArray($_SESSION["user"]->getEmail());
                $GLOBALS["order"] = $ords;

                require_once "./View/order-view.php";
            }
        }
    }
?>