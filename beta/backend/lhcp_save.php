<?php
$docRoot = "/home/SOME_PATH/www/beta/";
include_once($docRoot."backend/common.php");
$common = new Common();

$id = explode('-', $_POST['id']);
$newValue = $_POST['value'];
// echo $common->isForumAdmin();
if ($common->isForumAdmin()) {
  $newValue = mysql_real_escape_string($newValue);
  $query = "UPDATE lhcp SET ".$id[1]." = '$newValue' WHERE id = ".$id[0];
  $result = $common->query($query);
  if ($common->mysqli_affected_rows() > 0) {
    echo $newValue;
  } else {
    
  }

} else {
  echo "ERROR ERRROER EROEEROEGFKMDSFDMGbndolgfn... Please try never again.";

}

?>
