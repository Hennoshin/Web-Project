<?php
	$products = $GLOBALS["products"];
	if (isset($_SESSION["assupplier"]) && ($_SESSION["assupplier"] === true)) {
		$count = 0;
		foreach ($products as $id => $prod) {
			if ($prod->getManufacturer() == $_SESSION["user"]->getManufacturer()) { ?>
				<tr>
      				<td><div>
        				<div class="cart_img_box float-left bg-warning" style="width: 30%;height: 80px;">
          					<img src="<?php echo htmlspecialchars($prod->getImage()); ?>" width="100%" height="100%">
        				</div>
        				<div class="cart_info_box float-left pl-3" style="width: 70%;height: 80px;">
          					<p class="mb-1 font-weight-bold" style="font-size: 115%;"><?php echo htmlspecialchars($prod->getProductName()); ?></p>
          					<p style="font-size: 85%"><?php echo htmlspecialchars($prod->getDescription()); ?></p>
        				</div>
      				</div> </td>
      
      			<td class="text-center"><p class="mt-2" style="padding:5px;">RM <?php echo htmlspecialchars($prod->getPrice()); ?></p> </td>
    
    			</tr>
			<?php $count++; }
		}
		echo ".sep."; 
		foreach ($products as $id => $prod) {
			if ($prod->getManufacturer() == $_SESSION["user"]->getManufacturer()) { ?>
				<tr>
      				<td><div>
        				<div class="cart_img_box float-left bg-warning" style="width: 30%;height: 80px;">
          					<img src="<?php echo htmlspecialchars($prod->getImage()); ?>" width="100%" height="100%">
        				</div>
        				<div class="cart_info_box float-left pl-3" style="width: 70%;height: 80px;">
          					<p class="mb-1 font-weight-bold" style="font-size: 115%;"><?php echo htmlspecialchars($prod->getProductName()); ?></p>
          					<p style="font-size: 85%"><?php echo htmlspecialchars($prod->getDescription()); ?></p>
        				</div>
      				</div> </td>
      
      				<td class="text-center"><p class="mt-2" style="padding:5px;">RM <?php echo htmlspecialchars($prod->getPrice()); ?></p> </td>
      				<td class="text-center">'<div class="btn btn-danger text-white ml-2" onclick="DeleteFood(`+ food[i].id + `)" style="width: 16%;border-radius: 10px;"><i class="fa fa-trash" aria-hidden="true"></i></div>
  					<div class="btn btn-warning  text-white mr-2" onclick="UpdateFood(`+ food[i].id + `)" style="width: 16%;border-radius: 10px;"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></div> </td>
				</tr>
			<?php }
		}
		echo ".sep." . $count;
	}
	else {
		foreach ($products as $id => $prod) {
			if (!preg_match($regex, $prod->getProductName())) {
				continue;
			} ?>
			<div class="col-12 col-sm-6 col-md-4 col-lg-3 p-4 ">
				<div class="produre_box bg-white shadow-sm sini" id="myTable">
					<div class="image_box ok">
						<img src=<?php echo htmlspecialchars($prod->getImage()); ?> width="100%" height="100%" style="">
						<div class="info_box p-3 bg-white">
						<p class="float-left font-weight-bold mb-0" style="font-size: 115%"><?php echo htmlspecialchars($prod->getProductName()); ?></p><p class="float-right font-weight-bold mb-2" style="font-size: 115%">RM <?php echo htmlspecialchars($prod->getPrice()); ?> </p>
						<div style="clear: both;"></div>
						
						<p style="font-size: 85%;height:35px;"><?php echo htmlspecialchars($prod->getDescription()); ?></p>
						<!--
						<div class="star_box float-left pt-2">
							<img src="icon_star.svg" width="80%">
						</div>
						-->
						<div class="order_box float-right">
							<div onclick="addToCart('<?php echo htmlspecialchars($prod->getID()); ?>')" class="order_button float-right pt-2">
								<i class="fa fa-plus" aria-hidden="true"></i>
							</div>
						</div>
						</div>
						<div style="clear: both;"></div>
					</div>
				</div>
			</div>
		<?php }
	}
?>