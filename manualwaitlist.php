<?php


error_reporting(E_ALL);
$dbname = 'SOME_PATH_forum';
$dbuser = 'SOME_PATH_bbtest';
$dbpasswd = 'DB_PASS';
// $db2name = "DB_USER";
// $db2user = "DB_USER";
// $db2pass = "DB_PASS";
$waitlistees = array("Walgrave","Buttface","SkillShop","Cleon","Joeybonzo","Fayrn","Liverspots","Hoochie","Impax","Bankmule","Adrienne","Smokan","Catlady","Kdoc","Redcoatt","Coscilius","Exacerbation","Kelden","Gaggins","Brunhildae","Noalligators","Ruffels","Hurfdurf","Shardless","Theseanmower","Jisook","Abracadabrah","Onceler","Horsehands","Avelolaa","Nightmann","Willa","Askingman");
// $waitlisteesID = array();
$raidList = array(934,935,936,937,938,939);//867,868,869,870,871,872,873,874,875,876,877,878,879);

$db = new mysqli("localhost",$dbuser,$dbpasswd  ,$dbname);
// $db2 = new mysqli("localhost",$db2user,$db2pass  ,$db2name);
if (mysqli_connect_errno($db)) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

// foreach ($waitlistees as $name) {
  // $query = "SELECT member_id FROM phpbb_bbdkp_memberlist where member_name='$name'";
  // $result = $db->query($query, MYSQLI_STORE_RESULT);
  // list($id) = $result->fetch_row();  
  // $waitlisteesID[] = $id;
// }

// $result = $db2->query($query, MYSQLI_STORE_RESULT);
foreach ($raidList as $raidID) {
  $query = "DELETE FROM phpbb_bbdkp_raid_detail WHERE raid_id = $raidID";
         echo $query."<br>"."<br>"."<br>";
    //$result = $db->query($query, MYSQLI_STORE_RESULT);
  foreach ($waitlistees as $name) {
    $query = "SELECT member_id FROM phpbb_bbdkp_memberlist where member_name='$name'";
    echo $query."<br>";
    $result = $db->query($query, MYSQLI_STORE_RESULT);
    list($memberID) = $result->fetch_row();  
    $query = "INSERT INTO phpbb_bbdkp_raid_detail (`raid_id`, `member_id`, `raid_value`, `time_bonus`, `zerosum_bonus`, `raid_decay`, `decay_time`) VALUES ".
				 "($raidID, $memberID, 15, 0, 0, 0, 0)";
         echo $query."<br>"."<br>"."<br>";
    $result = $db->query($query, MYSQLI_STORE_RESULT);
  }
}

?>
