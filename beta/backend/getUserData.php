<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
date_default_timezone_set('America/Chicago');

include_once("common.php");
require 'simple_html_dom.php';

$common = new Common();





if ($common->isLoggedIn()) {

  $user->data['wowName'] = $common->getWowName();;
  $user->data['loggedIn'] = true;
  $user->data['SID'] = $common->getSID();
  echo json_encode($user->data);
} else {
  echo json_encode(array('loggedIn'=>false));
}

// echo "</pre>";
?>
