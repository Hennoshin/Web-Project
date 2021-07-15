<?php
    require_once "dbhandler.php";
    require_once "Cart.php";
    require_once "User.php";

    class OrderHistory {
        private $orderID;
        private $userRef;
        private $address;
        private $date;
        private $items;
        private $total;

        public function __construct($ur = "", $d = "", $i = array(), $total = 0, $oi = "", $a = "")
        {
            $this->orderID = $oi;
            $this->userRef = $ur;
            $this->address = $a;
            $this->date = $d;
            $this->items = $i;
            $this->total = $total;
        }

        public function getAddress() {
            return $this->address;
        }
        public function getItems() {
            return $this->items;
        }
        public function getTotal() {
            return $this->total;
        }
        public function getUserRef() {
            return $this->userRef;
        }
        public function getDate() {
            return $this->date;
        }

        public static function getOrderArray($uid) {
            $query = "SELECT orderID, orderDate, address FROM order_history WHERE userID = ?";
            $query2 = "SELECT itemID, quantity FROM ordered_item WHERE orderID = ?";

            $stmt = mysqli_prepare($GLOBALS["link"], $query);
            $stmt2 = mysqli_prepare($GLOBALS["link"], $query2);

            $stmt->bind_param("s", $uid);
            $stmt->execute();
            $stmt->store_result();

            $oid = "";
            $ord = "";
            $addr = "";
            $stmt->bind_result($oid, $ord, $addr);
            $stmt2->bind_param("s", $oid);
            $orders = array();
            for ($cnt = 0; $cnt < $stmt->num_rows(); $cnt++) {
                $itms = array();
                $total = 0;

                $stmt->fetch();
                $stmt2->execute();
                $stmt2->store_result();
                $stmt2->bind_result($pid, $qty);

                for ($cnt2 = 0; $cnt2 < $stmt2->num_rows(); $cnt2++) {
                    $stmt2->fetch();
                    $itms[$pid] = $qty;
                    $total += Product::getProduct($pid)->getPrice() * $qty;
                }
                $orders[$cnt] = new OrderHistory($uid, $ord, $itms, $total, $oid, $addr);
            }

            return $orders;
        }
        public static function getOrderArrayManf($manufacturer) {
            $query = "SELECT userID, orderID, orderDate, address FROM order_history";
            $query2 = "SELECT itemID, quantity FROM ordered_item WHERE orderID = ?";
            $query3 = "SELECT id FROM producttbl WHERE manufacturer = " . "'". $manufacturer . "'";

            $stmt = mysqli_query($GLOBALS["link"], $query);
            $stmt2 = mysqli_prepare($GLOBALS["link"], $query2);
            $prodres = mysqli_query($GLOBALS["link"], $query3);

            echo mysqli_error($GLOBALS["link"]);

            $uid = "";
            $oid = "";
            $ord = "";
            $addr = "";
            $stmt2->bind_param("s", $oid);
            $orders = array();
            for ($cnt = 0; $cnt < $stmt->num_rows; $cnt++) {
                $itms = array();
                $total = 0;

                $res1 = $stmt->fetch_assoc();
                $uid = $res1["userID"];
                $oid = $res1["orderID"];
                $ord = $res1["orderDate"];
                $addr = $res1["address"];
                $stmt2->execute();
                $stmt2->store_result();
                $stmt2->bind_result($pid, $qty);

                for ($cnt2 = 0; $cnt2 < $stmt2->num_rows(); $cnt2++) {
                    $stmt2->fetch();
                    if (Product::getProduct($pid)->getManufacturer() == $manufacturer) {
                        $itms[$pid] = $qty;
                        $total += Product::getProduct($pid)->getPrice() * $qty;
                    }
                }
                $orders[$cnt] = new OrderHistory($uid, $ord, $itms, $total, $oid, $addr);

            }

            return $orders;
        }
        public function insertOrder() {
            $query = "INSERT INTO ordered_item VALUES (?, ?, ?)";
            $query2 = "INSERT INTO order_history VALUES (?, ?, ?, ?)";

            if (empty($this->orderID)) {
                $res = mysqli_query($GLOBALS["link"], "SELECT orderID FROM order_history");
                if ($res->num_rows == 0) {
                    $id = "ORD000000001";
                }
                else {
                    $numr = 0;
                    for ($numr = 0; $numr < $res->num_rows - 1; $numr++) {
                        $res->fetch_assoc();
                    }
                    $id = $res->fetch_assoc()["orderID"];
                    $id = str_replace("ORD", "", $id);
                    $id += 1;
                    $c = 9 - strlen($id);
                    for ($i = 0; $i < $c; $i++) {
                        $id = "0" . $id;
                        
                    }
                    $id = "ORD" . $id;
                }
                echo $id;
                $this->orderID = $id;
            }

            $stmt = mysqli_prepare($GLOBALS["link"], $query);
            $stmt2 = mysqli_prepare($GLOBALS["link"], $query2);

            $stmt2->bind_param("ssss", $this->orderID, $this->userRef, $this->date, $this->address);
            $stmt2->execute();
            echo $this->userRef;
            echo mysqli_error($GLOBALS["link"]);

            $stmt->bind_param("ssi", $this->orderID, $iid, $qty);

            foreach ($this->items as $pid => $q) {
                $iid = $pid;
                $qty = $q;
                $stmt->execute();
            }
            echo mysqli_error($GLOBALS["link"]);
        }
    }
?>