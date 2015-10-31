<?php
ini_set('display_errors',1); 
ini_set('html_errors', 'On');
error_reporting(E_ALL);
  
$con = mysql_connect("localhost","DB_USER","DB_PASS");
	  
if (!$con) {
  error_log("Could not connect: " . mysql_error());
}

mysql_select_db("SOME_PATH_forum", $con);
		

		

      $query = "SELECT * FROM phpbb_bbdkp_memberlist";
     $result = mysql_query($query);
      while($row = mysql_fetch_assoc($result)) {
        
        
        $queryRankUpdate = "UPDATE phpbb_bbdkp_memberlist SET member_armory_url='http://realmplayers.com/CharacterViewer.aspx?realm=ED&player=".$row['member_name']."' WHERE member_id=".$row['member_id'];
        echo $row['member_name']." - ".$queryRankUpdate."<br><br>";
        $resultRankUpdateBBDKP =  mysql_query($queryRankUpdate);
      }
