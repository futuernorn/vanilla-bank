<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
date_default_timezone_set('America/Chicago');

include_once("common.php");
require 'simple_html_dom.php';

$common = new Common();

$itemID = 18832;
if (isset($_GET['itemID'])) {
	$itemID = $_GET['itemID'];
} 

$query = "SELECT * FROM `db-valk_data` WHERE itemID=$itemID";
$result = $common->query($query);
if ($result) {
  /* determine number of rows result set */
  $rowNum = $result->num_rows;
	if ($rowNum == 0) {
		// Create DOM from URL or file
		$curl = curl_init(); 
    $urlRoot = $common::aowowURL;
    $url = $urlRoot."?item=".$itemID;
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);  
		curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 10);  
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);  
		$str = curl_exec($curl);  
    $http_status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    if ($http_status != 200) {
      echo "<h1>Error: http code - $http_status</h1>";
      echo "Sorry cant access: <a href='$url'>$url</a>. Unable to load item data!</br>";
    } else {       
      curl_close($curl);
      $html= str_get_html($str); 
      $tooltip = $html->find('div.tooltip',0);
      $str = $tooltip;
      $str = str_replace('href="?','target="_blank" href="'.$urlRoot."?",$str);      
      echo $str;
      $str = $common->real_escape_string($str);
      $query = "INSERT INTO `db-valk_data` (id, itemID, data) VALUES (NULL,$itemID,'$str')";
      $res = $common->query($query);      
      $html->clear();
    }
	} else {
		$row = $result->fetch_assoc();
		print ($row['data']);
	}
  // close result set */
  $result->close();
}
?>
