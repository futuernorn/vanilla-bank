<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
date_default_timezone_set('America/Chicago');

include_once("common.php");
require 'simple_html_dom.php';

$common = new Common();

$id = 18832;
if (isset($_GET['id'])) {
	$id = $_GET['id'];
} 

$func = "item";
if (isset($_GET['func'])) {
	$func = $_GET['func'];
} 

$curl = curl_init(); 
$url = "http://www.wowhead.com/$func=$id";
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);  
curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 10);  
$str = curl_exec($curl);  
$http_status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
if ($http_status != 200) {
  echo "<h1>Error: http code - $http_status</h1>";
  echo "Sorry cant access: <a href='$url'>$url</a>. Unable to load item data!</br>";
} else {
  curl_close($curl);  
  $html= str_get_html($str); 
  $comments = $html->find('div[id=user-comments]',0);
  echo $comments;
}
?>
