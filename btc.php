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
$btcData = array();
$ignoreNames = array("Geodude");
$count = 0;
if (($handle = fopen("LGW Loot Sheet - BTC.csv", "r")) !== FALSE) {
  while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
      if (in_array($data[0], $ignoreNames)) {
        continue;
      }
      if ($count > 0) {
        array_push($btcData, $data);
      } else {
        $count++;
      }

  }
  fclose($handle);
}

  $adj_reason = "Loot System Conversion";
   
  $query = "DELETE FROM  `phpbb_bbdkp_adjustments` WHERE  `adjustment_reason` =  '$adj_reason'";
  $result = $db->query($query, MYSQLI_STORE_RESULT);

foreach ($btcData as $data) {
  $member_id = 0;
  $query = "SELECT member_id, member_name FROM phpbb_bbdkp_memberlist WHERE member_name = '".$data[0]."'";
  $result = $db->query($query, MYSQLI_STORE_RESULT);
  $time = time();
  list($member_id,$member_name) = $result->fetch_row();
  if ($member_id == 0) {
    echo "$data[0] - ID: $member_id ($member_name)<br>";
    
    $date = date('l jS \of F Y h:i:s A');
    $query = "INSERT INTO `phpbb_bbdkp_memberlist`(`game_id`, `member_id`, `member_name`, `member_status`, `member_level`, `member_race_id`, `member_class_id`, `member_rank_id`, `member_comment`, `member_joindate`, `member_outdate`, `member_guild_id`, `member_gender_id`, `member_achiev`, `member_armory_url`, `member_portrait_url`, `phpbb_user_id`) VALUES ('wow', DEFAULT, '".$data[0]."', 0, 60, 1, 1, 99, 'Member inserted $date by Xooberscript', $time, 0, 0, 0, 0, '', 'images/roster_portraits/wow/0-1-1.gif', 0)";
    echo $query."<br><br>";
    $result = $db->query($query);
    $query = "SELECT * FROM phpbb_bbdkp_memberlist WHERE member_name = '".$data[0]."'";
    $result = $db->query($query, MYSQLI_STORE_RESULT);
    list($game_id, $member_id,$member_name) = $result->fetch_row();
  }
  $groupKey = gen_group_key ( time(), $adj_reason, $data[1] );
  $query = "INSERT INTO `phpbb_bbdkp_adjustments` (`adjustment_id`, `member_id`, `adjustment_dkpid`, `adjustment_value`, `adjustment_date`, `adjustment_reason`, `adjustment_added_by`, `adjustment_updated_by`, `adjustment_group_key`, `adj_decay`, `can_decay`, `decay_time`) VALUES ".
    "(DEFAULT, $member_id, 1, ".$data[1].", $time, '$adj_reason', 'Xooberscript', '', '$groupKey', 0.00, 0, 0.00)";
  echo $query."<br><br>";
    $result = $db->query($query);

}

$query = "SELECT name, rank_index FROM members";
$result = $db2->query($query, MYSQLI_STORE_RESULT);

while(list($name, $rank_index) = $result->fetch_row()) {
  $query = "SELECT * FROM phpbb_bbdkp_memberlist WHERE member_name = '$name'";
   // echo $name." - ".$query."<br><br>";
  $result2 = $db->query($query, MYSQLI_STORE_RESULT);
    if (mysqli_num_rows($result2) > 0) {
      list($game_id, $member_id,$member_name) = $result2->fetch_row();
      $query = "UPDATE phpbb_bbdkp_memberlist SET member_rank_id=$rank_index WHERE member_id=$member_id";
      echo $member_name." - ".$query."<br><br>";
      $result3 = $db->query($query, MYSQLI_STORE_RESULT);
    }
}
echo "<pre>";
print_r($btcData);
echo "</pre>";
  
  
  function gen_group_key($part1, $part2, $part3)
    {
        // Get the first 10-11 digits of each md5 hash
        $part1 = substr(md5($part1), 0, 10);
        $part2 = substr(md5($part2), 0, 11);
        $part3 = substr(md5($part3), 0, 11);
        
        // Group the hashes together and create a new hash based on uniqid()
        $group_key = $part1 . $part2 . $part3;
        $group_key = md5(uniqid($group_key));
        
        return $group_key;
    }
 ?>
