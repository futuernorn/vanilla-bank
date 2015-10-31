<?php


error_reporting(E_ALL);
$dbname = 'SOME_PATH_forum';
$dbuser = 'SOME_PATH_bbtest';
$dbpasswd = 'DB_PASS';

$db = new mysqli("localhost",$dbuser,$dbpasswd  ,$dbname);
// $db2 = new mysqli("localhost",$db2user,$db2pass  ,$db2name);
if (mysqli_connect_errno($db)) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

echo "Fixing guild IDs...\r\n<br>";
$query = "SELECT member_id, member_name FROM phpbb_bbdkp_memberlist where member_guild_id <> 1";
$result = $db->query($query, MYSQLI_STORE_RESULT);
while(list($id, $name) = $result->fetch_row()) {
    $updateQuery = "UPDATE `phpbb_bbdkp_memberlist` SET `member_rank_id`=6, `member_guild_id`=1 WHERE member_id=$id";
    echo $name.": ".$updateQuery."<br>";
    $db->query($updateQuery, MYSQLI_STORE_RESULT);
}
// $result = $db2->query($query, MYSQLI_STORE_RESULT);


?>
