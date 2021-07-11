<?php
    if ($_SESSION["assupplier"] != true) {
        $usr = $_SESSION["user"];
        $user = $usr->getName();
    }
    $orders = $GLOBALS["order"];

    foreach ($orders as $order) {
        if ($_SESSION["assupplier"] === true) {
            $user = User::getNameByEmail($order->getUserRef());
        }
?>
    <tr style="border-bottom:1px solid #ccc;">
        <td>
            <p>Name: <?php echo htmlspecialchars($user); ?></p>
            <p>Address: <?php echo htmlspecialchars($order->getAddress()); ?></p>
            <!-- <p>Phone Number: `+ paymentFood[i].phone_customer + `</p> -->
            <p>Payment: COD</p>
       
         </td>
      
        <td><?php foreach ($order->getItems() as $pid => $qty) { ?>
            <div class="cart_img_box float-left mb-2" style="width: 80px;">
                <img src="<?php echo htmlspecialchars(Product::getProduct($pid)->getImage()); ?>" width="100%" height="100%">
            </div>
            <div class="cart_info_box float-left pl-3">
                <p class="mb-1 font-weight-bold" style="font-size: 115%;"><?php echo htmlspecialchars(Product::getProduct($pid)->getProductName()); ?></p>
                <p style="font-size: 85%"><?php echo htmlspecialchars(Product::getProduct($pid)->getDescription()); ?></p>
            </div>
            <div class="quanlity" style="float: right;width: 30px;height: 30px;">
                <p><?php echo htmlspecialchars($qty); ?></p>
            </div><div style="clear:both;"></div>
        <?php } ?>
            <div id="comment_box` + i + `"></div>
        </td>
        <td class="text-center">RM <?php echo htmlspecialchars($order->getTotal()); ?></td>
        <td class="text-center"><button id="status_prinf`+ paymentFood[i].id_payment + `" onclick="suscess_payment(` + paymentFood[i].id_payment + `)" class="btn btn-warning text-white">` + paymentFood[i].status + `</button></td>
    </tr>
    <tr style="width:100%"></tr>
<?php } ?>

