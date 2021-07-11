<?php
    require_once "Product.php";

    class Cart {
        private $items;

        public function __construct()
        {
            $this->items = array();
        }
        // Assoc. array, key product id, val quantity
        public function addProduct($id) {
            if (isset($this->items[$id])) {
                $this->items[$id] += 1;
            }
            else {
                $this->items[$id] = 1;
            }
        }
        public function deleteProduct($id) {
            unset($this->items[$id]);
        }
        public function editProduct($id, $qty) {
            $this->items[$id] = $qty;
        }

        public function getItems() {
            return $this->items;
        }
    }
?>