<?php 

session_start();  
require_once 'config-cart.php';
$db_handle = new DBController();

// if (!isset($_SESSION['username'])) {
//     header("Location: login.php");
// }

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

<!doctype html>
<html class="no-js" lang="en">

<head>
    <!-- meta data -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!--font-family-->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i"
        rel="stylesheet">

    <!-- title of site -->
    <title>Chair.in</title>

    <!-- For favicon png -->
    <link rel="shortcut icon" type="image/icon" href="assets/logo/favicon.svg" />

    <!--font-awesome.min.css-->
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">

    <!--linear icon css-->
    <link rel="stylesheet" href="assets/css/linearicons.css">

    <!--animate.css-->
    <link rel="stylesheet" href="assets/css/animate.css">

    <!--owl.carousel.css-->
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/owl.theme.default.min.css">

    <!--bootstrap.min.css-->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <!-- bootsnav -->
    <link rel="stylesheet" href="assets/css/bootsnav.css">

    <!--style.css-->
    <link rel="stylesheet" href="assets/css/style.css">

    <!--responsive.css-->
    <link rel="stylesheet" href="assets/css/responsive.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

    <!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

</head>

<body>
    <!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->



    <!--welcome-hero start -->
    <header id="home" class="welcome-hero">

        <div id="header-carousel" class="carousel slide carousel-fade" data-ride="carousel">
            <!--/.carousel-indicator -->
            <ol class="carousel-indicators">
                <li data-target="#header-carousel" data-slide-to="0" class="active"><span class="small-circle"></span>
                </li>
                <li data-target="#header-carousel" data-slide-to="1"><span class="small-circle"></span></li>
                <li data-target="#header-carousel" data-slide-to="2"><span class="small-circle"></span></li>
            </ol><!-- /ol-->
            <!--/.carousel-indicator -->

            <!--/.carousel-inner -->
            <div class="carousel-inner" role="listbox">
                <!-- .item -->
                <div class="item active">
                    <div class="single-slide-item slide1">
                        <div class="container">
                            <div class="welcome-hero-content">
                                <div class="row">
                                    <div class="col-sm-7">
                                        <div class="single-welcome-hero">
                                            <div class="welcome-hero-txt">
                                                <h4>Nyamankan tempat singgahmu</h4>
                                                <h2>Kursi Kerja Peningkat Produktivitas</h2>
                                                <p>
                                                    Selalu ada tempat untuk menetap, singgahlah dengan nyaman sejenak.
                                                    Rasakan sensasi duduk seakan kerasnya dunia sedang tunduk, merelakan
                                                    kamu menikmati singgahmu.
                                                </p>
                                                <div class="packages-price">
                                                    <p>
                                                        Rp 399.000
                                                        <del>Rp 499.000</del>
                                                    </p>
                                                </div>
                                                <button class="btn-cart welcome-add-cart"
                                                    onclick="window.location.href='#'">
                                                    <span class="lnr lnr-plus-circle"></span>
                                                    Nikmati <span>Kursi</span>
                                                </button>
                                                <button class="btn-cart welcome-add-cart welcome-more-info"
                                                    onclick="window.location.href='#'">
                                                    Lihat Kursi Lain
                                                </button>
                                            </div>
                                            <!--/.welcome-hero-txt-->
                                        </div>
                                        <!--/.single-welcome-hero-->
                                    </div>
                                    <!--/.col-->
                                    <div class="col-sm-5">
                                        <div class="single-welcome-hero">
                                            <div class="welcome-hero-img">
                                                <img src="assets/images/slider/slider1.png" alt="slider image">
                                            </div>
                                            <!--/.welcome-hero-txt-->
                                        </div>
                                        <!--/.single-welcome-hero-->
                                    </div>
                                    <!--/.col-->
                                </div>
                                <!--/.row-->
                            </div>
                            <!--/.welcome-hero-content-->
                        </div><!-- /.container-->
                    </div><!-- /.single-slide-item-->

                </div><!-- /.item .active-->

                <div class="item">
                    <div class="single-slide-item slide2">
                        <div class="container">
                            <div class="welcome-hero-content">
                                <div class="row">
                                    <div class="col-sm-7">
                                        <div class="single-welcome-hero">
                                            <div class="welcome-hero-txt">
                                                <h4>Nyamankan tempat singgahmu</h4>
                                                <h2>Kursi Beristirahat Nikmat</h2>
                                                <p>
                                                    Selalu ada tempat untuk menetap, singgahlah dengan nyaman sejenak.
                                                    Rasakan sensasi duduk seakan kerasnya dunia sedang tunduk, merelakan
                                                    kamu menikmati singgahmu.
                                                </p>
                                                <div class="packages-price">
                                                    <p>
                                                        Rp 199.000
                                                        <del>Rp 299.000</del>
                                                    </p>
                                                </div>
                                                <button class="btn-cart welcome-add-cart"
                                                    onclick="window.location.href='#'">
                                                    <span class="lnr lnr-plus-circle"></span>
                                                    Nikmati <span>Kursi</span>
                                                </button>
                                                <button class="btn-cart welcome-add-cart welcome-more-info"
                                                    onclick="window.location.href='#'">
                                                    Lihat Kursi Lain
                                                </button>
                                            </div>
                                            <!--/.welcome-hero-txt-->
                                        </div>
                                        <!--/.single-welcome-hero-->
                                    </div>
                                    <!--/.col-->
                                    <div class="col-sm-5">
                                        <div class="single-welcome-hero">
                                            <div class="welcome-hero-img">
                                                <img src="assets/images/slider/slider2.png" alt="slider image">
                                            </div>
                                            <!--/.welcome-hero-txt-->
                                        </div>
                                        <!--/.single-welcome-hero-->
                                    </div>
                                    <!--/.col-->
                                </div>
                                <!--/.row-->
                            </div>
                            <!--/.welcome-hero-content-->
                        </div><!-- /.container-->
                    </div><!-- /.single-slide-item-->

                </div><!-- /.item .active-->

                <div class="item">
                    <div class="single-slide-item slide3">
                        <div class="container">
                            <div class="welcome-hero-content">
                                <div class="row">
                                    <div class="col-sm-7">
                                        <div class="single-welcome-hero">
                                            <div class="welcome-hero-txt">
                                                <h4>Nyamankan tempat singgahmu</h4>
                                                <h2>Kursi Sultan</h2>
                                                <p>
                                                    Selalu ada tempat untuk menetap, singgahlah dengan nyaman sejenak.
                                                    Rasakan sensasi duduk seakan kerasnya dunia sedang tunduk, merelakan
                                                    kamu menikmati singgahmu.
                                                </p>
                                                <div class="packages-price">
                                                    <p>
                                                        Rp 899.000
                                                        <del>Rp 999.000</del>
                                                    </p>
                                                </div>
                                                <button class="btn-cart welcome-add-cart"
                                                    onclick="window.location.href='#'">
                                                    <span class="lnr lnr-plus-circle"></span>
                                                    Nikmati <span>Kursi</span>
                                                </button>
                                                <button class="btn-cart welcome-add-cart welcome-more-info"
                                                    onclick="window.location.href='#'">
                                                    Lihat Kursi Lain
                                                </button>
                                            </div>
                                            <!--/.welcome-hero-txt-->
                                        </div>
                                        <!--/.single-welcome-hero-->
                                    </div>
                                    <!--/.col-->
                                    <div class="col-sm-5">
                                        <div class="single-welcome-hero">
                                            <div class="welcome-hero-img">
                                                <img src="assets/images/slider/slider3.png" alt="slider image">
                                            </div>
                                            <!--/.welcome-hero-txt-->
                                        </div>
                                        <!--/.single-welcome-hero-->
                                    </div>
                                    <!--/.col-->
                                </div>
                                <!--/.row-->
                            </div>
                            <!--/.welcome-hero-content-->
                        </div><!-- /.container-->
                    </div><!-- /.single-slide-item-->

                </div><!-- /.item .active-->
            </div><!-- /.carousel-inner-->

        </div>
        <!--/#header-carousel-->

        <!-- top-area Start -->
        <?php 
                 
        if(!isset($_SESSION['username'])) {?>
        <div class="top-area">
            <div class="header-area">
                <!-- Start Navigation -->
                <nav class="navbar navbar-default bootsnav  navbar-sticky navbar-scrollspy"
                    data-minus-value-desktop="70" data-minus-value-mobile="55" data-speed="1000">

                    <!-- Start Top Search -->
                    <div class="top-search">
                        <div class="container">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-search"></i></span>
                                <input type="text" class="form-control" placeholder="Search">
                                <span class="input-group-addon close-search"><i class="fa fa-times"></i></span>
                            </div>
                        </div>
                    </div>
                    <!-- End Top Search -->

                    <div class="container">
                        <!-- Start Atribute Navigation -->

                        <div class="attr-nav">
                            <ul>
                                <li class="nav-setting"  style="margin-buttom: 10px;">
                                    <a href="login.php" ><span class="btn btn-warning">Login</span></a>
                                </li>
								<li class="nav-setting" style="">
                                    <a href="register.php"><span class="btn btn-warning">Register</span></a>
                                </li>
                                <!--/.search-->
                                <!-- <li class="nav-setting">
				                		<a href="#"><span class="lnr lnr-user">saya</span></a>
				                	</li>

									<li>
											<a style="font-size: 16px;" href="logout.php">Logout</a>
									</li> -->
                                <!-- Drop Down Toggle -->


                                <!-- Drop Down Toggle -->

                            </ul>
                        </div>
                        <!--/.attr-nav-->
                        <!-- End Atribute Navigation -->

                        <!-- Start Header Navigation -->
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse"
                                data-target="#navbar-menu">
                                <i class="fa fa-bars"></i>
                            </button>
                            <a class="navbar-brand" href="index.html">Chair<span>.</span>in</a>
                        </div>
                        <!--/.navbar-header-->
                        <!-- End Header Navigation -->

                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse menu-ui-design" id="navbar-menu">
                            <ul class="nav navbar-nav navbar-center" data-in="fadeInDown" data-out="fadeOutUp">
                                <li class=" scroll active"><a href="#home">Beranda</a></li>
                                <li class="scroll"><a href="#new-arrivals">Terlaris</a></li>
                                <li class="scroll"><a href="#feature">Produk</a></li>
                                <li class="scroll"><a href="#newsletter">Hubungi Kami</a></li>
                            </ul>
                            <!--/.nav -->
                        </div><!-- /.navbar-collapse -->
                    </div>
                    <!--/.container-->
                </nav>
                <!--/nav-->
                <!-- End Navigation -->
            </div>
            <!--/.header-area-->
            <div class="clearfix"></div>

        </div>
        <?php }else{?>

        <div class="top-area">
            <div class="header-area">
                <!-- Start Navigation -->
                <nav class="navbar navbar-default bootsnav  navbar-sticky navbar-scrollspy"
                    data-minus-value-desktop="70" data-minus-value-mobile="55" data-speed="1000">

                    <!-- Start Top Search -->
                    <div class="top-search">
                        <div class="container">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-search"></i></span>
                                <input type="text" class="form-control" placeholder="Search">
                                <span class="input-group-addon close-search"><i class="fa fa-times"></i></span>
                            </div>
                        </div>
                    </div>
                    <!-- End Top Search -->

                    <div class="container">
                        <!-- Start Atribute Navigation -->

                        <div class="attr-nav">
                            <ul>
                                <li class="search">
                                    <a href="#"><span class="lnr lnr-magnifier"></span></a>
                                </li>
                                <!--/.search-->
                                <li class="nav-setting">
                                    <a href="#"><span class="lnr lnr-user">
                                            <?php echo $_SESSION['username']?></span></a>
                                </li>
                                <!--/.search-->

                                <li>
                                    <a style="font-size: 16px;" href="logout.php">Logout</a>
                                </li>
                                <!-- Drop Down Toggle -->


                                <!-- Drop Down Toggle -->
                                <?php
                                    if(isset($_SESSION["cart_item"])){
                                    $total_quantity = 0;
                                    $total_price = 0;
                                    ?>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <span class="lnr lnr-cart"></span>
                                        <span class="badge badge-bg-1">1</span>
                                    </a>
                                    <ul class="dropdown-menu cart-list s-cate">
                                        <a id="btnEmpty" href="index.php?action=empty">Kosongkan</a>
                                        <?php		
                                    foreach ($_SESSION["cart_item"] as $item){
                                    $item_price = $item["quantity"]*$item["price"];
                                    ?>
                                        <li class="single-cart-list">
                                            <a href="#" class="photo"><img src="<?php echo $item["image"]; ?>"
                                                    class="cart-thumb" alt="image" /></a>
                                            <div class="cart-list-txt">
                                                <h6><a href="#"><?php echo $item["name"]; ?></a></h6>
                                                <p><?php echo $item["quantity"]; ?> x - <span
                                                        class="price"><?php echo $item["price"]; ?></span></p>
                                            </div>
                                        </li>

                                        <?php
                                    $total_quantity += $item["quantity"];
                                    $total_price += ($item["price"]*$item["quantity"]);
                                    }
                                    ?>
                                        <li class="total">
                                            <span><?php echo "Total : Rp. " . number_format($total_price, 3); ?></span>
                                            <button class="btn-cart pull-right"
                                                onclick="window.location.href='Pembayaran.php'">Bayar</button>
                                        </li>
                                        <?php
                                    //$_SESSION
                                    } else {
                                    ?>
                                        <div class="no-records" hidden>Your Cart is Empty</div>
                                        <?php 
                                    }
                                    ?>

                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <!--/.attr-nav-->
                        <!-- End Atribute Navigation -->

                        <!-- Start Header Navigation -->
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse"
                                data-target="#navbar-menu">
                                <i class="fa fa-bars"></i>
                            </button>
                            <a class="navbar-brand" href="index.html">Chair<span>.</span>in</a>
                        </div>
                        <!--/.navbar-header-->
                        <!-- End Header Navigation -->

                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse menu-ui-design" id="navbar-menu">
                            <ul class="nav navbar-nav navbar-center" data-in="fadeInDown" data-out="fadeOutUp">
                                <li class=" scroll active"><a href="#home">Beranda</a></li>
                                <li class="scroll"><a href="#new-arrivals">Terlaris</a></li>
                                <li class="scroll"><a href="#feature">Produk</a></li>
                                <li class="scroll"><a href="#newsletter">Hubungi Kami</a></li>
                            </ul>
                            <!--/.nav -->
                        </div><!-- /.navbar-collapse -->
                    </div>
                    <!--/.container-->
                </nav>
                <!--/nav-->
                <!-- End Navigation -->
            </div>
            <!--/.header-area-->
            <div class="clearfix"></div>

        </div>
        <?php }?>

       

        <!-- /.top-area-->
        <!-- top-area End -->

    </header>
    <!--/.welcome-hero-->
    <!--welcome-hero end -->

    <!--populer-products start -->
    <section id="populer-products" class="populer-products">
        <div class="container">
            <div class="populer-products-content">
                <div class="row">
                    <div class="col-md-3">
                        <div class="single-populer-products">
                            <div class="single-populer-product-img mt40">
                                <img src="assets/images/populer-products/p1.png" alt="populer-products images">
                            </div>
                            <h2><a href="#">kursi sultan</a></h2>
                            <div class="single-populer-products-para">
                                <p>Jadilah Sultan di Tempat Singgahmu.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="single-populer-products">
                            <div class="single-inner-populer-products">
                                <div class="row">
                                    <div class="col-md-4 col-sm-12">
                                        <div class="single-inner-populer-product-img">
                                            <img src="assets/images/populer-products/p2.png"
                                                alt="populer-products images">
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-sm-12">
                                        <div class="single-inner-populer-product-txt">
                                            <h2>
                                                <a href="#">
                                                    Kursi Kerja <span>dan</span> Santai
                                                </a>
                                            </h2>
                                            <p>
                                                Buat kerja pasti produktif. Buat santai pasti kaya di pantai. Apa pun
                                                yang kamu butuhkan semua ada pada kursi nan indah ini.
                                            </p>
                                            <div class="populer-products-price">
                                                <h4>Beli sekarang! <span>stok terbatas </span></h4>
                                            </div>
                                            <button class="btn-cart welcome-add-cart populer-products-btn"
                                                onclick="window.location.href='#'">
                                                Lihat Detail
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="single-populer-products">
                            <div class="single-populer-products">
                                <div class="single-populer-product-img">
                                    <img src="assets/images/populer-products/p4.png" alt="populer-products images">
                                </div>
                                <h2><a href="#">Kursi Kondangan</a></h2>
                                <div class="single-populer-products-para">
                                    <p>Bawa sensasi kondangan ke sudut terindah rumahmu.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/.container-->

    </section>
    <!--/.populer-products-->
    <!--populer-products end-->

    <!--new-arrivals start -->
    <section id="new-arrivals" class="new-arrivals">
        <div class="container">
            <div class="section-header">
                <h2>Kursi Terlaris</h2>
            </div>
            <!--/.section-header-->
            <div class="new-arrivals-content">
                <div class="row">

                    <!-- LOOPING Data Product -->
                    <?php

	$product_array = $db_handle->runQuery("SELECT * FROM tblproduct ORDER BY id ASC");
	if (!empty($product_array)) { 
		foreach($product_array as $key=>$value){
	?>
                    <div class="product-item">
                        <form method="post"
                            action="index.php?action=add&code=<?php echo $product_array[$key]["code"]; ?>">
                            <div class="col-md-3 col-sm-4">
                                <div class="single-new-arrival">
                                    <div class="single-new-arrival-bg">
                                        <img src="<?php echo $product_array[$key]["image"]; ?>"
                                            alt="new-arrivals images">
                                        <div class="single-new-arrival-bg-overlay"></div>
                                        <!-- <div class="sale bg-1">
										<p>Murah</p>
									</div> -->
                                        <!-- Hover  -->
                                        <div class="new-arrival-cart">
                                            <p>
                                                <span class="lnr lnr-cart"></span>
                                                <input type="text" class="product-quantity" name="quantity" value="1"
                                                    size="2" hidden />
                                                <input type="submit" value="Add to Cart" style="background : #33383c;">
                                            </p>
                                            <p class="arrival-review pull-right">
                                                <span class="lnr lnr-heart"></span>
                                                <span class="lnr lnr-frame-expand"></span>
                                            </p>
                                        </div>
                                    </div>
                                    <br>
                                    <h4><?php echo $product_array[$key]["name"]; ?></h4>
                                    <p class="arrival-product-price"><?php echo "Rp" . $product_array[$key]["price"]; ?>
                                    </p>
                                </div>
                            </div>
                        </form>
                    </div>
                    <?php
		}
	}
	?>

                </div>
            </div>
        </div>
        <!--/.container-->

    </section>
    <!--/.new-arrivals-->
    <!--new-arrivals end -->

    <!--sofa-collection start -->
    <section id="sofa-collection">
        <div class="owl-carousel owl-theme" id="collection-carousel">
            <div class="sofa-collection collectionbg1">
                <div class="container">
                    <div class="sofa-collection-txt">
                        <h2>Paket Serba Putih</h2>
                        <p>
                            Dapatkan kursi lengkap sekaligus dan berwarna putih. Kembali suci mulai dari kursi mu. Tetap
                            Putih dan selalu bersih.
                        </p>
                        <div class="sofa-collection-price">
                            <h4>Harga Mulai Dari <span> 1.999K</span></h4>
                        </div>
                        <button class="btn-cart welcome-add-cart sofa-collection-btn"
                            onclick="window.location.href='#'">
                            Pesan Sekarang
                        </button>
                    </div>
                </div>
            </div>
            <!--/.sofa-collection-->
            <div class="sofa-collection collectionbg2">
                <div class="container">
                    <div class="sofa-collection-txt">
                        <h2>Paket Kursi Makan</h2>
                        <p>
                            Makan secara duduk, nyamankan kursimu. Cukup 1 kali pembelian bisa untuk duduk 1 keluarga
                            besar.
                        </p>
                        <div class="sofa-collection-price">
                            <h4>Harga Mulai Dari <span> 1.899K</span></h4>
                        </div>
                        <button class="btn-cart welcome-add-cart sofa-collection-btn"
                            onclick="window.location.href='#'">
                            Pesan Sekarang
                        </button>
                    </div>
                </div>
            </div>
            <!--/.sofa-collection-->
        </div>
        <!--/.collection-carousel-->

    </section>
    <!--/.sofa-collection-->
    <!--sofa-collection end -->

    <!--feature start -->
    <section id="feature" class="feature">
        <div class="container">
            <div class="section-header">
                <h2>Produk Kursi</h2>
            </div>
            <!--/.section-header-->
            <div class="feature-content">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="single-feature">
                            <img src="assets/images/features/f1.jpg" alt="feature image">
                            <div class="single-feature-txt text-center">
                                <p>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <span class="spacial-feature-icon"><i class="fa fa-star"></i></span>
                                    <span class="feature-review">(45 ulasan)</span>
                                </p>
                                <h3><a href="#">Sofa Keluarga Harmonis</a></h3>
                                <h5>Rp 899.000</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="single-feature">
                            <img src="assets/images/features/f2.jpg" alt="feature image">
                            <div class="single-feature-txt text-center">
                                <p>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <span class="spacial-feature-icon"><i class="fa fa-star"></i></span>
                                    <span class="feature-review">(45 ulasan)</span>
                                </p>
                                <h3><a href="#">Kursi Dapur </a></h3>
                                <h5>Rp 799.000</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="single-feature">
                            <img src="assets/images/features/f3.jpg" alt="feature image">
                            <div class="single-feature-txt text-center">
                                <p>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <span class="spacial-feature-icon"><i class="fa fa-star"></i></span>
                                    <span class="feature-review">(45 ulasan)</span>
                                </p>
                                <h3><a href="#">Kursi Produktif</a></h3>
                                <h5>Rp 399.000</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="single-feature">
                            <img src="assets/images/features/f4.jpg" alt="feature image">
                            <div class="single-feature-txt text-center">
                                <p>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <span class="spacial-feature-icon"><i class="fa fa-star"></i></span>
                                    <span class="feature-review">(45 ulasan)</span>
                                </p>
                                <h3><a href="#">Kursi Ngambang</a></h3>
                                <h5>Rp 599.000</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/.container-->

    </section>
    <!--/.feature-->
    <!--feature end -->

    <!--newsletter strat -->
    <section id="newsletter" class="newsletter">
        <div class="container">
            <div class="hm-footer-details">
                <div class="row">
                    <div class=" col-md-3 col-sm-6 col-xs-12">
                        <div class="hm-footer-widget">
                            <div class="hm-foot-title">
                                <h4>Chair.in</h4>
                            </div>
                            <!--/.hm-foot-title-->
                            <div class="hm-foot-menu">
                                <ul>
                                    <li><a href="#">Tentang Kami</a></li>
                                    <!--/li-->
                                    <li><a href="#">Hubungi Kami</a></li>
                                    <!--/li-->
                                    <li><a href="#">Beli Kursi</a></li>
                                    <!--/li-->
                                </ul>
                                <!--/ul-->
                            </div>
                            <!--/.hm-foot-menu-->
                        </div>
                        <!--/.hm-footer-widget-->
                    </div>
                    <!--/.col-->
                    <div class=" col-md-3 col-sm-6 col-xs-12">
                        <div class="hm-footer-widget">
                            <div class="hm-foot-title">
                                <h4>Produk</h4>
                            </div>
                            <!--/.hm-foot-title-->
                            <div class="hm-foot-menu">
                                <ul>
                                    <li><a href="#">Kursi Sultan</a></li>
                                    <!--/li-->
                                    <li><a href="#">Kursi Ufo</a></li>
                                    <!--/li-->
                                    <li><a href="#">Paket Kursi</a></li>
                                    <!--/li-->
                                    <li><a href="#">Kursi Produktif</a></li>
                                    <!--/li-->
                                </ul>
                                <!--/ul-->
                            </div>
                            <!--/.hm-foot-menu-->
                        </div>
                        <!--/.hm-footer-widget-->
                    </div>
                    <!--/.col-->
                    <div class=" col-md-3 col-sm-6 col-xs-12">
                        <div class="hm-footer-widget">
                            <div class="hm-foot-title">
                                <h4>Akun</h4>
                            </div>
                            <!--/.hm-foot-title-->
                            <div class="hm-foot-menu">
                                <ul>
                                    <li><a href="#">Akun Saya</a></li>
                                    <!--/li-->
                                    <li><a href="#">Ingin Dibeli</a></li>
                                    <!--/li-->
                                    <li><a href="#">Riwayat Transaksi</a></li>
                                    <!--/li-->
                                    <li><a href="#">Keranjang Belanja</a></li>
                                    <!--/li-->
                                </ul>
                                <!--/ul-->
                            </div>
                            <!--/.hm-foot-menu-->
                        </div>
                        <!--/.hm-footer-widget-->
                    </div>
                    <!--/.col-->
                    <div class=" col-md-3 col-sm-6  col-xs-12">
                        <div class="hm-footer-widget">
                            <div class="hm-foot-title">
                                <h4>P.T. Cuan Berkah Kursi</h4>
                            </div>
                            <!--/.hm-foot-title-->
                            <div class="hm-foot-para">
                                <ul>
                                    <li>Jl. Pengrajin kursi nyaman mania No. 6 RT 17/24, Banyumas City.</li>
                                </ul>
                            </div>
                            <!--/.hm-footer-widget-->
                        </div>
                        <!--/.col-->
                    </div>
                    <!--/.row-->
                </div>
                <!--/.hm-footer-details-->

            </div>
            <!--/.container-->

    </section>
    <!--/newsletter-->
    <!--newsletter end -->

    <!--footer start-->
    <footer id="footer" class="footer">
        <div class="container">
            <div class="hm-footer-copyright text-center">
                <div class="footer-social">
                    <a href="#"><i class="fa fa-facebook"></i></a>
                    <a href="#"><i class="fa fa-instagram"></i></a>
                    <a href="#"><i class="fa fa-linkedin"></i></a>
                </div>
                <p>
                    &copy;copyright 2021. Penjual Kursi Bahagia by Kelompok 1 PW 1
                </p>
                <!--/p-->
            </div>
            <!--/.text-center-->
        </div>
        <!--/.container-->

        <div id="scroll-Top">
            <div class="return-to-top">
                <i class="fa fa-angle-up " id="scroll-top" data-toggle="tooltip" data-placement="top" title=""
                    data-original-title="Back to Top" aria-hidden="true"></i>
            </div>

        </div>
        <!--/.scroll-Top-->

    </footer>
    <!--/.footer-->
    <!--footer end-->

    <!-- Include all js compiled plugins (below), or include individual files as needed -->

    <script src="assets/js/jquery.js"></script>

    <!--modernizr.min.js-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>

    <!--bootstrap.min.js-->
    <script src="assets/js/bootstrap.min.js"></script>

    <!-- bootsnav js -->
    <script src="assets/js/bootsnav.js"></script>

    <!--owl.carousel.js-->
    <script src="assets/js/owl.carousel.min.js"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>


    <!--Custom JS-->
    <script src="assets/js/custom.js"></script>


</body>

</html>