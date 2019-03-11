<?php
/**
 * Created by DrSwad
 * Date: 3/23/2018
 * Time: 3:40 PM
 */

require_once 'Include/Product.php';
$Product = new Product();
if (!isset($_GET['code'])) exit;
$code = $_GET['code'];
if (!$code) exit;

if (isset($_POST['code'])) {
	echo json_encode($Product->getProduct($_POST['code']));
	exit();
}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Product page</title>
        <?php include 'partials/meta.php' ?>
        <script type="text/javascript">
            var code = <?php echo '"'.$code.'"'; ?>;
        </script>
	</head>
	<body>
		<div id="navbar">
        	<a id="logo-container" href="/"><img id="logo-img" src="img/static/logo.png" /></a>
        	<div id="nav-menu">
        		<a href="catalogue.php?view=All" class="nav-item">All<a>
                <a href="catalogue.php?view=Bedroom" class="nav-item">Bedroom<a>
                <a href="catalogue.php?view=Dining" class="nav-item">Dining<a>
                <a href="catalogue.php?view=Hardware" class="nav-item">Hardware<a>
                <a href="catalogue.php?view=Home_Decor" class="nav-item">Home Decor<a>
                <a href="catalogue.php?view=Kitchen" class="nav-item">Kitchen<a>
                <a href="catalogue.php?view=Office_Furniture" class="nav-item">Office Furniture<a>
                <a href="catalogue.php?view=Painting" class="nav-item">Painting<a>
                <a href="catalogue.php?view=Sofa_Set" class="nav-item">Sofa Set</a>
        	</div>
        	<div id="hamburger-container">
        		<span></span>
        		<span></span>
        		<span></span>
        		<span></span>
        	</div>
        </div>
        <div id="body">
        	<?php include 'css/loading.htm' ?>
        	<div class="loading" style="
        					position: fixed;
        					top: 0;
        					left: 0;
        					right: 0;
        					bottom: 0;">
        		<div class="loading-ellipsis"><div></div><div></div><div></div><div></div></div>
        	</div>
        	<div id="body-content">
        		<div id="breadcrumb"><a href="" class="category"></a>/<a href="" class="product-name"></a></div>
        		<div id="product-wrapper">
        			<div id="product-info">
        				<div class="tag">Imported</div>
        				<div class="header"></div>
        				<div class="sub-header"></div>
        			</div><!--
        			--><div id="product-picture">
        				<div class="image"></div>
        				<div id="up-arrow"><img src="img/product/up-arrow-grey.png" /></div>
        				<div id="down-arrow"><img src="img/product/down-arrow-grey.png" /></div>
        			</div><!--
        			--><div id="product-nav"></div>
        			<div id="product-details-box">
        				<div class="border"></div>
        				To order or know more details about this product call 01918181818
        			</div>
        		</div>
        	</div>
        	<div id="footer">
        		<div class="left">Copyright 2018 <span>homePro</span></div>
        		<a class="right" href="index.php?view=contact">Contact Us</a>
        	</div>
        </div>
        <?php include 'partials/menu.php' ?>

        <?php include 'css/common.htm' ?>
        <?php include 'scripts/common.htm' ?>
        <?php include 'css/product.htm' ?>
        <?php include 'scripts/product.htm' ?>
        <?php include 'css/menu.htm' ?>
        <?php include 'scripts/menu.htm' ?>
	</body>
</html>
