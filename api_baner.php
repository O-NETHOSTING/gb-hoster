<?php
$ip = $_GET["ip"];
$port = $_GET["port"];
header('Content-Type: image/jpeg');
$image = 'https://www.gametracker.xyz/banner_normal/'.$ip.':'.$port.'/blue';
$imagee = imagecreatefromstring(file_get_contents($image));
imagejpeg($imagee);
?>