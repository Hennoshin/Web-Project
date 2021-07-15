<?php
    require_once "dbhandler.php";

    class User {
        private $email;
        private $name;
        private $address;

        public function __construct($e, $n, $a)
        {
            $this->email = $e;
            $this->name = $n;
            $this->address = $a;
        }

        public function getName() {
            return $this->name;
        }
        public function getEmail() {
            return $this->email;
        }
        public function getAddress() {
            return $this->address;
        }

        public static function getUser($email, $pass) {
            $query = "SELECT email, password, name, address FROM usertbl WHERE email = ?";

            $stmt = mysqli_prepare($GLOBALS["link"], $query);
            $stmt->bind_param("s", $email);
            if ($stmt->execute()) {
                $stmt->store_result();
                if ($stmt->num_rows() == 1) {
                    $stmt->bind_result($remail, $rpass, $rname, $raddress);
                    if ($stmt->fetch()) {
                        if (password_verify($pass, $rpass)) {
                            return new User($remail, $rname, $raddress);
                        }
                    }
                }
            }

            return false;
        }

        public static function getAddressByEmail($email) {
            $res = mysqli_query($GLOBALS["link"], "SELECT address FROM usertbl WHERE email = " . "'" . $email . "'");
            if ($res->num_rows == 0) {
                return false;
            }
            $addr = $res->fetch_assoc();
            return $addr["address"];
        }

        public static function getNameByEmail($email) {
            $res = mysqli_query($GLOBALS["link"], "SELECT name FROM usertbl WHERE email = " . "'" . $email . "'");
            if ($res->num_rows == 0) {
                return false;
            }
            $name = $res->fetch_assoc();
            return $name["name"];
        }

        public function insertUser($pass) {
            $query = "INSERT INTO usertbl (email, password, name, address) VALUES (?, ?, ?, ?)";
            $query2 = "SELECT email FROM usertbl WHERE email = ?";

            $stmt2 = mysqli_prepare($GLOBALS["link"], $query2);
            $stmt2->bind_param("s", $this->email);
            $stmt2->execute();
            $stmt2->store_result();
            if ($stmt2->num_rows() > 0) {
                return false;
            }

            $pass = password_hash($pass, PASSWORD_DEFAULT);

            $stmt = mysqli_prepare($GLOBALS["link"], $query);
            $stmt->bind_param("ssss", $this->email, $pass, $this->name, $this->address);
            $stmt->execute();

            return true;
        }

        public function setNewPass($pass) {
            $hash = password_hash($pass, PASSWORD_DEFAULT);

            $query = "UPDATE usertbl SET password = " . "'" . $hash . "'" . " WHERE email = " . "'" . $this->email . "'";
            mysqli_query($GLOBALS["link"], $query);

            echo mysqli_error($GLOBALS["link"]);
        }
    }
?>