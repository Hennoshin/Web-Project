<?php
    $prods = array();
    $items = $cart->getItems();
    $total = 0;
    if (!empty($items)) {
        foreach ($items as $id => $qty) {
            $prods[$id] = Product::getProduct($id);
            $total += $prods[$id]->getPrice() * $qty; ?>
        <tr>
            <td>
                <div>
                    <div class="cart_img_box float-left">
                        <img src="<?php echo htmlspecialchars($prods[$id]->getImage()); ?>" width="100%" height="100%">
                    </div>
                    <div class="cart_info_box float-left pl-3">
                        <p class="mb-1 font-weight-bold" style="font-size: 115%;"><?php echo htmlspecialchars($prods[$id]->getProductName()); ?></p>
                        <p style="font-size: 85%"><?php echo htmlspecialchars($prods[$id]->getDescription()); ?></p>
                    </div>
                </div>
            </td>
            <td class="text-center"><input id="quality_input_change" onchange ="editCart('<?php echo htmlspecialchars($id); ?>', this.value)" class="cart_input_quanlity mt-2" type="number" value="<?php echo $qty; ?>" name="" min="1" max="20" style=""> </td>
            <td class="text-center"><p class="mt-2" style="padding:5px;">RM <?php echo ($prods[$id]->getPrice() * $qty); ?></p></td>
            <td class="text-center"><div onclick="deleteFromCart('<?php echo htmlspecialchars($id); ?>')" class="cart_button_delete"><i class="fa fa-trash" aria-hidden="true" style="color: #fb9200;font-size: 180%"></i></div> </td>
        </tr>
    <?php }
    }
    echo ".sep." . $total;
?>