<?php
include_once("connect_db.php");
header('Content-Type: charset=UTF-8');
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<?php include ("assets/php/head.php"); ?>
<?php include('style/err_script.php'); ?>
<body>
		    <div id="content">
        <div id="TOP">
            <div id="header">
                <a id="logo" href="/"></a>
<?php include ("style/login_provera.php"); ?>
	            </div>
<?php include ("style/navigacija.php"); ?>
        </div>
        <div id="rotacalc">
                    </div>
                    <div id="wraper" style="background: rgba(0,0,0,0.7); box-sizing: border-box; max-width: 1002px; color: #fff !important; margin: 15px 0;">
					<th align>Za UPLATU PREKO UPLATNICE JAVITE SE NA NASU FACEBOOK STRANICU <a href="https://www.facebook.com/gbhosterme/">GB Hoster</a></li>
        <?php include ("style/footer.php"); ?>

        </div>
</div>
<script>
$('.stepcarousel').carousel({
  interval: 5000
})
</script>
</body></html>
