<?php


error_reporting(E_ALL);
$dbname = 'SOME_PATH_forum';
$dbuser = 'SOME_PATH_bbtest';
$dbpasswd = 'DB_PASS';
$db2name = "DB_USER";
$db2user = "DB_USER";
$db2pass = "DB_PASS";
$db = new mysqli("localhost",$dbuser,$dbpasswd  ,$dbname);
$db2 = new mysqli("localhost",$db2user,$db2pass  ,$db2name);
if (mysqli_connect_errno($db)) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$query = "SELECT name, rank_index FROM members";
$result = $db2->query($query, MYSQLI_STORE_RESULT);

while(list($name, $rank_index) = $result->fetch_row()) {
  $query = "SELECT * FROM phpbb_bbdkp_memberlist WHERE member_name = '$name'";
   // echo $name." - ".$query."<br><br>";
  $result2 = $db->query($query, MYSQLI_STORE_RESULT);
    if (mysqli_num_rows($result2) > 0) {
      list($game_id, $member_id,$member_name) = $result2->fetch_row();
      $query = "UPDATE phpbb_bbdkp_memberlist SET member_rank_id=$rank_index, guild_id=8 WHERE member_id=$member_id";
      echo $member_name." - ".$query."<br><br>";
      $result3 = $db->query($query, MYSQLI_STORE_RESULT);
    }
}

?>
