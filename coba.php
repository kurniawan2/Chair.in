<?php
session_start();
require_once 'config-cart.php';
$db_handle = new DBController();
if(!empty($_GET["action"])) {
	switch($_GET["action"]) {
		case "add":
			if(!empty($_POST["quantity"])) {
                $productByCode = $db_handle->runQuery("SELECT * FROM tblproduct WHERE code='" . $_GET["code"] . "'");
                $itemArray = array($productByCode[0]["code"]=>array('name'=>$productByCode[0]["name"], 'code'=>$productByCode[0]["code"], 'quantity'=>$_POST["quantity"], 'price'=>$productByCode[0]["price"], 'image'=>$productByCode[0]["image"]));
                if(!empty($_SESSION["cart_item"])) {
					if(in_array($productByCode[0]["code"],array_keys($_SESSION["cart_item"]))) {
						foreach($_SESSION["cart_item"] as $k => $v) {
								if($productByCode[0]["code"] == $k) {
									if(empty($_SESSION["cart_item"][$k]["quantity"])) {
										$_SESSION["cart_item"][$k]["quantity"] = 0;
									}
									$_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
								}
						}
					} else {
						$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
					}
				} else {
					$_SESSION["cart_item"] = $itemArray;
				}
			}
		break;
		case "remove":
			if(!empty($_SESSION["cart_item"])) {
				foreach($_SESSION["cart_item"] as $k => $v) {
						if($_GET["code"] == $k)
							unset($_SESSION["cart_item"][$k]);				
						if(empty($_SESSION["cart_item"]))
							unset($_SESSION["cart_item"]);
				}
			}
		break;
		case "empty":
			unset($_SESSION["cart_item"]);
		break;	
	}
}

?>


<div class="attr-nav">
				                <ul>
				                	<li class="search">
				                		<a href="#"><span class="lnr lnr-magnifier"></span></a>
				                	</li><!--/.search-->
				                	<li class="nav-setting">
				                		<a href="#"><span class="lnr lnr-user">Anjing</span></a>
				                	</li><!--/.search-->


									<!-- Drop Down Toggle -->
                                    <?php
                                    if(isset($_SESSION["cart_item"])){
                                    $total_quantity = 0;
                                    $total_price = 0;
                                    ?>	
                                    <li class="dropdown">
				                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" >
				                            <span class="lnr lnr-cart"></span>
											<span class="badge badge-bg-1">1</span>
				                        </a>
				                        <ul class="dropdown-menu cart-list s-cate">
                                    <?php		
                                    foreach ($_SESSION["cart_item"] as $item){
                                    $item_price = $item["quantity"]*$item["price"];
                                    ?>
                                        <li class="single-cart-list">
				                                <a href="#" class="photo"><img src="<?php echo $item["image"]; ?>" class="cart-thumb" alt="image" /></a>
				                                <div class="cart-list-txt">
				                                	<h6><a href="#"><?php echo $item["name"]; ?></a></h6>
				                                	<p><?php echo $item["quantity"]; ?> x - <span class="price"><?php echo $item["price"]; ?></span></p>
				                                </div>
                                        </li>

                                    <?php
                                    $total_quantity += $item["quantity"];
                                    $total_price += ($item["price"]*$item["quantity"]);
                                    }
                                    ?>
                                    <li class="total">
				                         <span><?php echo "Total : Rp. " . number_format($total_price, 3); ?></span>
				                         <button class="btn-cart pull-right" onclick="window.location.href='Pembayaran.html'">Bayar</button>
				                    </li> 		
                                    <?php
                                    //$_SESSION
                                    } else {
                                    ?>
                                    <div class="no-records">Your Cart is Empty</div>
                                    <?php 
                                    }
                                    ?>

				                    


				                            

                                    
				                            
				                        </ul>
				                    </li>
									
									
									<!--/.dropdown-->





				                </ul>
				            </div><!--/.attr-nav-->

<?php

	$product_array = $db_handle->runQuery("SELECT * FROM tblproduct ORDER BY id ASC");
	if (!empty($product_array)) { 
		foreach($product_array as $key=>$value){
	?>
		<div class="product-item">
			    <form method="post" action="coba.php?action=add&code=<?php echo $product_array[$key]["code"]; ?>">
						<div class="col-md-3 col-sm-4">
							<div class="single-new-arrival">
								<div class="single-new-arrival-bg">
									<img src="<?php echo $product_array[$key]["image"]; ?>" alt="new-arrivals images">
									<div class="single-new-arrival-bg-overlay"></div>
									<!-- <div class="sale bg-1">
										<p>Murah</p>
									</div> -->
									<!-- Hover  -->
									<div class="new-arrival-cart">
										<p>
											<span class="lnr lnr-cart"></span>
											<input type="text" class="product-quantity" name="quantity" value="1" size="2" hidden/>
											<input type="submit" value="Add to Cart">
										</p>
										<p class="arrival-review pull-right">
											<span class="lnr lnr-heart"></span>
											<span class="lnr lnr-frame-expand"></span>
										</p>
									</div>
									</div>
									<br>
								<h4><?php echo $product_array[$key]["name"]; ?></h4>
								<p class="arrival-product-price"><?php echo "Rp" . $product_array[$key]["price"]; ?></p>
							</div>
						</div>
			    </form>
		</div>
	<?php
		}
	}
	?>

