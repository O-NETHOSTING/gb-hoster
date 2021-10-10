<?php
include 'connect_db.php';

if (is_login() == false) {
	$_SESSION['error'] = "Niste ulogovani.";
    header("Location: /home");
    die();
} else {
    /*$proveri_servere = mysql_num_rows(mysql_query("SELECT * FROM `billing` WHERE `klijentid` = '$_SESSION[userid]'"));
    if (!$proveri_servere) {
        $_SESSION['info'] = "Nemate narudzba kod nas.";
        header("Location: /home");
        die();
    }*/
}

?>
<!DOCTYPE html>
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
<div id="wraper" style="/*background: rgba(0,0,0,0.7);*/ box-sizing: border-box; max-width: 1002px; color: #fff !important; /*margin: 0px 0;*/">
    <div id="ServerBox" style="background: #000000ad; border: 1px solid #ba0000;">
<?php include("style/gpmenu.php"); ?>

        <div id="server_info_infor">    
            <div id="server_info_infor">
                <div id="server_info_infor2">
                    <div class="space" style="margin-top: 20px;"></div>
                    <div class="gp-home">
                        <img src="/img/icon/gp/gp-server.png" alt="" style="position:absolute;margin-left:20px;">
                        <h2 style="margin: 1% 6%;">Billing</h2>
                        <h3 style="font-size: 12px; margin: -1% 6%;">Lista svih vasih narudzba</h3>
                        <div class="space" style="margin-top: 60px;"></div>
                        
                        <div id="serveri">
                           <center> <table class="darkTable">
                                <tbody>
                                    <tr style="background: #ba00005e;">
                                        <th>ID</th>
                                        <th>Ime servera</th>
                                        <th>Cena</th>
                                        <th>Vrsta Placanja</th>
                                        <th>Datum Narudzbe</th>
                                        <th>Status</th>
                                    </tr>
                                    <?php  
                                        $gp_obv = mysql_query("SELECT * FROM `billing` WHERE `klijentid` = '$_SESSION[userid]' ORDER by id DESC");

                                        while($row = mysql_fetch_array($gp_obv)) { 
                                            $b_id       = htmlspecialchars(mysql_real_escape_string(addslashes($row['id'])));
                                            $srw_name   = htmlspecialchars(mysql_real_escape_string(addslashes($row['srw_name'])));
                                            $iznos      = htmlspecialchars(mysql_real_escape_string(addslashes($row['iznos'])));
                                            $datum      = htmlspecialchars(mysql_real_escape_string(addslashes($row['datum'])));
                                            $vreme      = htmlspecialchars(mysql_real_escape_string(addslashes($row['vreme'])));
                                            $paytype    = htmlspecialchars(mysql_real_escape_string(addslashes($row['paytype'])));
                                            $status     = htmlspecialchars(mysql_real_escape_string(addslashes($row['status'])));

                                            if ($status == "0") {
                                                $status = "<span style='color: red;'>Na čekanju!</span>";
                                            } elseif ($status == "1") {
                                                $status = "<span style='color: #54ff00;'>Uplaćeno!</span>";
                                            } elseif ($status == "2") {
                                                $status = "<span style='color: #54ff00;'>Uplaćeno!</span>";
                                            }

                                            if ($srw_name == "") {
                                                $srw_name = "Narudzba!";
                                            }
                                        ?>       
                                        <tr>
                                            <td>
                                                <a href="gp-billing-w.php?id=<?php echo $b_id; ?>">#<?php echo $b_id; ?></a>
                                            </td>
                                            <td class="ip">
                                                <a href="gp-billing-w.php?id=<?php echo $b_id; ?>"><?php echo $srw_name; ?></a>
                                            </td>
                                            <td><?php echo $iznos; ?> &euro;</td>
                                            <td><?php echo $paytype; ?></td>
                                            <td><?php echo $vreme.', '.$datum; ?></td>
                                            <td><div class="aktivan"><?php echo $status; ?></div></td>
                                        </tr>
                                    <?php } ?>                               
                                </tbody>
                            </table>
                        </center>
                        </div>
                    </div>
                    <div class="space" style="margin-bottom: 20px;"></div>
                </div>
            </div>
        </div>
    </div>

    <?php if (is_login() == true) { ?>
        <!-- PIN (POPUP)-->
        <div class="modal fade" id="pin-auth" role="dialog">
            <div class="modal-dialog">
                <div id="popUP"> 
                    <div class="popUP">
                        <?php
                            $get_pin_toket = $_SERVER['REMOTE_ADDR'].'_p_'.randomSifra(100);
                            $_SESSION['pin_token'] = $get_pin_toket;
                        ?>
                        <form action="process.php?task=un_lock_pin" method="post" class="ui-modal-form" id="modal-pin-auth">
                            <input type="hidden" name="pin_token" value="<?php echo $get_pin_toket; ?>">
                            <fieldset>
                                <h2>PIN Code zastita</h2>
                                <ul>
                                    <li>
                                        <p>Vas account je zasticen sa PIN kodom !</p>
                                        <p>Da biste pristupili ovoj opciji, potrebno je da ga unesete u box ispod.</p>
                                    </li>
                                    <li>
                                        <label>PIN KOD:</label>
                                        <input type="password" name="pin" value="" maxlength="5" class="short">
                                    </li>
                                    <li style="text-align:center;">
                                        <button> <span class="fa fa-check-square-o"></span> Otkljucaj</button>
                                        <button type="button" data-dismiss="modal" loginClose="close"> <span class="fa fa-close"></span> Odustani </button>
                                    </li>
                                </ul>
                            </fieldset>
                        </form>
                    </div>        
                </div>  
            </div>
        </div>
        <!-- KRAJ - PIN (POPUP) -->

    <?php } ?>

    <!-- FOOTER -->
   

	   <!-- Php script :) -->

    <?php include('style/footer.php'); ?>

    <?php include('style/pin_provera.php'); ?>

    <?php include('style/java.php'); ?>


</body>
</html>