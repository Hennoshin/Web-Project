<?php
require_once "dbhandler.php";

    class Product {
        private $id;
        private $name;
        private $desc;
        private $price;
        private $img;
        private $manufacturer;

        public function __construct($id, $n, $d, $p, $im, $m = "")
        {
            $this->id = $id;
            $this->name = $n;
            $this->desc = $d;
            $this->price = $p;
            $im = "image/" . $im;
            $this->img = $im;
            $this->manufacturer = $m;
        }

        public static function getProduct($fid) {
            $query = "SELECT * FROM producttbl WHERE id = ?";

            $stmt = mysqli_prepare($GLOBALS["link"], $query);
            $stmt->bind_param("s", $fid);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows() == 0) {
                return false;
            }

            $stmt->bind_result($id, $name, $desc, $price, $m, $img);
            $stmt->fetch();
            return new Product($id, $name, $desc, $price, $img, $m);
        }

        public function getID() {
            return $this->id;
        }
        public function getProductName() {
            return $this->name;
        }
        public function getDescription() {
            return $this->desc;
        }
        public function getImage() {
            return $this->img;
        }
        public function getPrice() {
            return $this->price;
        }
        public function getManufacturer() {
            return $this->manufacturer;
        }
    }

    function getProductArray() {
        $query = "SELECT * FROM producttbl";
        $result = mysqli_query($GLOBALS["link"], $query);

        $products = array();
        foreach ($result as $row) {
            $products[$row["id"]] = new Product($row["id"], $row["prodname"], $row["description"], $row["price"], $row["imageURL"], $row["manufacturer"]);
        }
        return $products;
    }
?>