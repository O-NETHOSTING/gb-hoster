<?php

include($_SERVER['DOCUMENT_ROOT'].'/connect_db.php');

if(isset($_POST['lokacija'])) {
	$lokacija 			= htmlspecialchars(mysql_real_escape_string(addslashes($_POST['lokacija'])));
	if($lokacija == "1") {
		$lokacija_baza = "Lite - Njemacka";
	} else if($lokacija == "2") {
		$lokacija_baza = "Lite - Poljska";
	} else if($lokacija == "3") {
		$lokacija_baza = "Lite - Francuska";
	} else if($lokacija == "4") {
		$lokacija_baza = "Premium - Bugarska";
	} else if($lokacija == "5") {
		$lokacija_baza = "Premium - BiH";
	} else {
		$lokacija_baza = "Lite - Njemacka";
	}
} else {
	$lokacija_baza = "Lite - Njemacka";
}

if(isset($_POST['game_id'])) {
	$game_id 				= htmlspecialchars(mysql_real_escape_string(addslashes($_POST['game_id'])));
	if($game_id == "1") {
		$game_base = "Counter-Strike 1.6";
	} else if($game_id == "2") {
		$game_base = "GTA San Andreas";
	} else if($game_id == "3") {
		$game_base = "Minecraft";
	} else if($game_id == "6") {
		$game_base = "Team-Speak 3";
	} else if($game_id == "10") {
		$game_base = "SinusBot";
	} else if($game_id == "11") {
		$game_base = "FastDL";
	}
}

if (isset($_GET['task']) && $_GET['task'] == "buy") {

	if ($_SESSION['userid'] == "") {
		$_SESSION['error'] = "Morate biti ulogovani!";
		header("Location: $_SERVER[HTTP_REFERER]");
        die();
	}
	
	$user_ip = $_SERVER['REMOTE_ADDR']; 
	
	$ime 				= htmlspecialchars(mysql_real_escape_string(addslashes($_POST['ime'])));
	$igra 				= htmlspecialchars(mysql_real_escape_string(addslashes($_POST['game_id'])));
	$email 				= htmlspecialchars(mysql_real_escape_string(addslashes($_POST['email'])));
	$slotovi 			= htmlspecialchars(mysql_real_escape_string(addslashes($_POST['slotovi'])));
	$serverName 		= htmlspecialchars(mysql_real_escape_string(addslashes($_POST['naziv'])));
	$lokacija 			= htmlspecialchars(mysql_real_escape_string(addslashes($_POST['lokacija'])));
	$serverMod 			= htmlspecialchars(mysql_real_escape_string(addslashes($_POST['mod'])));
	$nacin_p 			= htmlspecialchars(mysql_real_escape_string(addslashes($_POST['nacinplacanja'])));
	$mjeseci 			= htmlspecialchars(mysql_real_escape_string(addslashes($_POST['mjeseci'])));
	$cena 				= htmlspecialchars(mysql_real_escape_string(addslashes($_POST['cena'])));
	$d 					= date("d-m-Y");
	$v 					= date("h.m.s");
	
	if ($ime == ""||$email == ""||$nacin_p == ""||$mjeseci == ""||$cena == "") {
		$_SESSION['error'] = "Morate popuniti sva polja.";
		header("Location: $_SERVER[HTTP_REFERER]");
        die();
	}
	
	if ($serverName == "" && $_POST['game_id'] == "10") {
		$_SESSION['error'] = "Morate popuniti sva polja.";
		header("Location: $_SERVER[HTTP_REFERER]");
        die();
	}
	
	$billing_desc = "Game: $game_base | ServerName: $serverName | Lokacija: $lokacija_baza | Cena: $cena";
	$spremi = mysql_query("INSERT INTO `billing` (`id`, `klijentid`, 
														`iznos`, 
														`datum`, 
														`status`, 
														`vreme`, 
														`slotovi`, 
														`lokacija`, 
														`placaza`, 
														`description`, 
														`paytype`,
														`game`,
														`srw_name`,
														`srw_mod`) VALUES(NULL, '$_SESSION[userid]', 
																				'$cena', 
																				'$d', 
																				'0', 
																				'$v', 
																				'$slotovi',
																				'$lokacija', 
																				'$mjeseci', 
																				'$billing_desc', 
																				'$nacin_p',
																				'$game_base',
																				'$serverName',
																				'$serverMod')");																				
	if (!$spremi) {
		$_SESSION['error'] = "Doslo je do greske prilikom narucivanja vaseg servera... Javite se na info@E-Game.Me .";
		header("Location: $_SERVER[HTTP_REFERER]");
		die();
	} else {
		$_SESSION['info'] = "Uspesno ste narucili svoj server, idite u billing i uplatite ga.";
		header("Location: $_SERVER[HTTP_REFERER]");
		die();
	}
}

?>