<?php
    require_once "./model/Supplier.php";
    require_once "./model/Product.php";

    session_start();

    /* $target_dir = "image/";
    $file = $target_dir . basename($_FILES[""]["name"]);
    */

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["op"])) {
            $op = $_POST["op"];
        } else {
            $op = "addImg";
        }
        switch ($op) {
            case "show":
                $prod = Product::getProduct($_POST["id"]);
                echo htmlspecialchars($prod->getProductName());
                echo ".sep.";
                echo htmlspecialchars($prod->getDescription());
                echo ".sep.";
                echo htmlspecialchars($prod->getPrice());
                break;
            case "update":
                $prod = Product::getProduct($_POST["id"]);
                $prod->setProductName($_POST["name"]);
                $prod->setDescription($_POST["desc"]);
                $prod->setPrice($_POST["price"]);
                break;
            case "add":
                echo $_POST["imgurl"];
                $product = new Product("", $_POST["name"], $_POST["desc"], $_POST["price"], $_POST["imgurl"], $_SESSION["user"]->getManufacturer(), 0);
                $product->insertProduct();
                break;
            default:
                
                $dir = "image/";
                $fileTypes = array("jpg", "png", "jpeg");
                $filename = $_FILES["file"]["name"];
                $temp = $_FILES["file"]["tmp_name"];

                $basename = basename($filename);
                $path = $dir . $basename;
                $fileType = pathinfo($path, PATHINFO_EXTENSION);
                if (!empty($filename)) {
                    if (in_array($fileType, $fileTypes)) {
                        if (move_uploaded_file($temp, $path)) {
                            echo $basename;
                        }
                        else {
                            echo 0;
                        }
                    }
                    else {
                        echo 0;
                    }
                }
                else {
                    echo 0;
                }
                
                break;
        }
    }
?>