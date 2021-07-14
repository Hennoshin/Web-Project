<?php
require_once "dbhandler.php";

    class Product {
        private $id;
        private $name;
        private $desc;
        private $price;
        private $img;
        private $manufacturer;

        public function __construct($id, $n, $d, $p, $im, $m = "", $mode = 1)
        {
            $this->id = $id;
            $this->name = $n;
            $this->desc = $d;
            $this->price = $p;
            if ($mode) {
                $im = "image/" . $im;
            }
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
        public function insertProduct() {
            $query2 = "INSERT INTO producttbl VALUES (?, ?, ?, ?, ?, ?)";

            if (empty($this->id)) {
                $res = mysqli_query($GLOBALS["link"], "SELECT id FROM producttbl");
                if ($res->num_rows == 0) {
                    $id = "AA00000001";
                }
                else {
                    $numr = 0;
                    for ($numr = 0; $numr < $res->num_rows - 1; $numr++) {
                        $res->fetch_assoc();
                    }
                    $id = $res->fetch_assoc()["id"];
                    $id = str_replace("AA", "", $id);
                    $id += 1;
                    $c = 8 - strlen($id);
                    for ($i = 0; $i < $c; $i++) {
                        $id = "0" . $id;
                        
                    }
                    $id = "AA" . $id;
                }
                $this->id = $id;
            }

            $stmt2 = mysqli_prepare($GLOBALS["link"], $query2);

            $stmt2->bind_param("sssiss", $this->id, $this->name, $this->desc, $this->price, $this->manufacturer, $this->img);
            $stmt2->execute();

            echo mysqli_error($GLOBALS["link"]);
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
        public function setProductName($prn) {
            $query = "UPDATE producttbl SET prodname = " . "'" . $prn . "'" . " WHERE id = " . "'" . $this->id . "'";
            mysqli_query($GLOBALS["link"], $query);
            $this->name = $prn;
        }
        public function setDescription($desc) {
            $query = "UPDATE producttbl SET description = " . "'" . $desc . "'" . " WHERE id = " . "'" . $this->id . "'";
            mysqli_query($GLOBALS["link"], $query);
            $this->desc = $desc;
        }
        public function setPrice($prc) {
            $query = "UPDATE producttbl SET price = " . $prc . " WHERE id = " . "'" . $this->id . "'";
            mysqli_query($GLOBALS["link"], $query);
            $this->price = $prc;
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