<?php
$docRoot = "/home/SOME_PATH/www/";

include_once($docRoot."backend/common.php");
$common = new Common();
$my_img = imagecreate( 1024, 80 );
$background = imagecolorallocatealpha($my_img,255,255,255,127);
$text_colour = imagecolorallocate( $my_img, 0, 0, 0 );
$line_colour = imagecolorallocate( $my_img, 100, 100, 100 );
$motd = $common->queryMotd();
$patterns = array('/:\w+:/');
$replacements = array('');
$motd = preg_replace($patterns, $replacements, $motd);
$lastUpdated = "Last update: ".$common->getLastUpdated();
imagealphablending($my_img,true);
imagestring( $my_img, 2, 0, 0, "<lets get weird> GMOTD:", $text_colour );
imagestring( $my_img, 4, 5, 25, $motd, $text_colour );
imagestring( $my_img, 2, 700, 65, $lastUpdated, $text_colour );
imagesetthickness ( $my_img, 5 );
imageline( $my_img, 30, 45, 900, 45, $line_colour );
imagestring( $my_img, 4, 5, 25, $string, $text_colour );
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); // HTTP/1.0
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header( "Content-type: image/png" );
imagepng( $my_img );
imagecolordeallocate( $line_color );
imagecolordeallocate( $text_color );
imagecolordeallocate( $background );
imagedestroy( $my_img );


?>