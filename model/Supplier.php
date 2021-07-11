<?php
    require_once "dbhandler.php";

    class Supplier {
        private $email;
        private $manufacturer;
        private $manfAddr;

        public function __construct($e, $m)
        {
            $this->email = $e;
            $this->manufacturer = $m;
        }

        public function getEmail() {
            return $this->email;
        }
        public function getManufacturer() {
            return $this->manufacturer;
        }
        public function getManufacturerAddress() {
            return $this->manfAddr;
        }

        public static function getSupplier($email, $pass) {
            $query = "SELECT * FROM suppliertbl WHERE email = ?";
            $query2 = "SELECT address FROM manufacturertbl WHERE name = ";

            $stmt = mysqli_prepare($GLOBALS["link"], $query);
            $stmt->bind_param("s", $email);
            if ($stmt->execute()) {
                $stmt->store_result();
                if ($stmt->num_rows() == 1) {
                    $stmt->bind_result($remail, $rpass, $rmnf);
                    if ($stmt->fetch()) {
                        if (password_verify($pass, $rpass)) {
                            $query2 = $query2 . "'" . $rmnf . "'";
                            $res = mysqli_query($GLOBALS["link"], $query2);
                            $row = $res->fetch_assoc();
                            $raddress = $row["address"];

                            return new Supplier($remail, $rmnf, $raddress);
                        }
                    }
                }
            }

            return false;
        }
    }
?>