<?php
 /**
 * Created by DrSwad
 * Date: 3/23/2018
 * Time: 3:40 PM
 */
?>

<!DOCTYPE html>
<html>
<head>
	<title>Welcome to Homepro</title>
	<?php include './partials/meta.php' ?>
</head>
<body>
	<?php include './css/loading.htm'; ?>
    <a id="logo-container" href="index.php"><img id="logo-img" src="img/static/logo.png" /></a>
    <div id="pages-container">
        <section class="page-container">
            <div class="body">
                <div class="loading" style="
					position: fixed;
					top: 0;
					left: 0;
					right: 0;
					bottom: 0;">
                    <div class="loading-ellipsis"><div></div><div></div><div></div><div></div></div>
                </div>
                <?php
                    $page = 1;
	                include './partials/left.php';
	                include './partials/home.php';
                ?>
            </div>
        </section>
        <section class="page-container">
            <div class="body">
                <?php
                    $page = 2;
	                include './partials/left.php';
	                include './partials/room.php';
                ?>
            </div>
        </section>
        <section class="page-container">
            <div class="body">
                <?php
					$page = 3;
	                include './partials/left.php';
	                include './partials/reviews.php';
                ?>
            </div>
        </section>
        <section class="page-container">
            <div class="body">
                <?php
                    $page = 4;
	                include './partials/left.php';
	                include './partials/clients.php';
	            ?>
            </div>
        </section>
        <section class="page-container">
            <div class="body">
			    <?php
			        $page = 5;
				    include './partials/left.php';
	                include './partials/sister.php';
                ?>
            </div>
        </section>
        <section class="page-container">
            <div class="body">
                <?php
                    $page = 6;
                    include './partials/left.php';
                    include './partials/store.php';
                ?>
            </div>
        </section>
    </div>
    <?php
	    include './partials/right.php';
	    include './partials/menu.php';

	    include './css/common.htm';
	    include './scripts/common.htm';
	    include './css/main.htm';
	    include './css/home.htm';
	    include './css/room.htm';
	    include './scripts/room.htm';
	    include './css/reviews.htm';
	    include './scripts/reviews.htm';
	    include './css/clients.htm';
	    include './scripts/clients.htm';
	    include './css/sister.htm';
	    include './scripts/sister.htm';
	    include './css/store.htm';
	    include './scripts/onepage-scroll.htm';
	    include './css/menu.htm';
	    include './scripts/menu.htm';
    ?>
    <script type="text/javascript">
	    <?php
	        if (isset($_GET['view']) && ($_GET['view'] === "contact")) {
	    ?>
	        $(function() {$("#pages-container").moveTo(6);});
	    <?php
	        }
	    ?>

	    $(function() {
		    var loadingCheckInterval = setInterval(function() {
			    var elem = $('#home').find('> img');
			    if (elem.height() === $(window).height()) {
				    setTimeout(function() {$('.loading').remove();}, 100);
				    clearInterval(loadingCheckInterval);
			    }
		    }, 100);
	    });
    </script>
</body>
</html>
