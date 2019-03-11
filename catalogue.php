<?php
/**
 * Created by DrSwad
 * Date: 3/23/2018
 * Time: 3:40 PM
 */

require_once 'Include/Catalogue.php';
$Catalogue = new Catalogue();
if (!isset($_GET['view'])) $type = "All";
else $type = $_GET['view'];
if (!$type) exit;

if (isset($_POST['type'])) {
	echo json_encode($Catalogue->getProducts($type));
	exit();
}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Product page</title>
        <?php include 'partials/meta.php' ?>
        <script type="text/javascript">
            var type = <?php echo '"'.$type.'"'; ?>;
        </script>
	</head>
	<body>
		<div id="navbar">
        	<a id="logo-container" href="index.php"><img id="logo-img" src="img/static/logo.png" /></a>
        	<div id="nav-menu">
        		<a href="catalogue.php?view=All" class="nav-item">All</a>
                <a href="catalogue.php?view=Bedroom" class="nav-item">Bedroom</a>
                <a href="catalogue.php?view=Dining" class="nav-item">Dining</a>
                <a href="catalogue.php?view=Hardware" class="nav-item">Hardware</a>
                <a href="catalogue.php?view=Home_Decor" class="nav-item">Home Decor</a>
                <a href="catalogue.php?view=Kitchen" class="nav-item">Kitchen</a>
                <a href="catalogue.php?view=Office_Furniture" class="nav-item">Office Furniture</a>
                <a href="catalogue.php?view=Painting" class="nav-item">Painting</a>
                <a href="catalogue.php?view=Sofa_Set" class="nav-item">Sofa Set</a>
        	</div>
        	<div id="hamburger-container">
        		<span></span>
        		<span></span>
        		<span></span>
        		<span></span>
        	</div>
        </div>
        <div id="background-header"><img src="img/imgmin/catalogue/header.png" /></div>
        <div id="body">
            <div id="header-text">
                <div>All Furnitures</div>
                <div>One page</div>
            </div>
            <div id="header-search">
                <img src="img/catalogue/search-icon.png" />
                <input id="search-text" placeholder="search furniture" />
            </div>
            <div class="loading" style="
                position: absolute;
                top: 300pt;
                left: 0;
                right: 0;
                bottom: 0;
                z-index: 99">
                <div class="loading-ellipsis"><div></div><div></div><div></div><div></div></div>
            </div>
            <div id="body-content"></div>
            <div id="footer">
                <div class="left">Copyright 2018 <span>homePro</span></div>
                <a class="right" href="index.php?view=contact">Contact Us</a>
            </div>
        </div>
        <div class="loading" style="
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;">
            <div class="loading-ellipsis"><div></div><div></div><div></div><div></div></div>
        </div>
        <?php include 'partials/menu.php' ?>

        <?php include 'css/common.htm' ?>
        <?php include 'scripts/common.htm' ?>
        <?php include 'css/catalogue.htm' ?>
        <?php include 'scripts/catalogue.htm' ?>
        <?php include 'css/menu.htm' ?>
        <?php include 'scripts/menu.htm' ?>
        <script type="text/javascript">
            $(function() {
                var loadingCheckInterval = setInterval(function() {
                    var elem = $('#background-header');
                    if (elem.find('> img').height() === elem.height()) {
                        setTimeout(function() {$('body > .loading').remove();}, 100);
                        clearInterval(loadingCheckInterval);
                    }
                }, 100);
            });
        </script>
	</body>
</html>
