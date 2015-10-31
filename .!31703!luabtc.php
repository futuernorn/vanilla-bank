<?php
header("Content-type: text/plain");
ini_set('display_errors',1); 
ini_set('html_errors', 'On');
error_reporting(E_ALL);

// Gmail email address and password for google spreadsheet
$user = "GMAIL_USER";
$pass = " PASS";
// Google Spreadsheet ID (You can get it from the URL when you view the spreadsheet)
$GSheetID = "GSHEET_ID";
// od6 is the first worksheet in the spreadsheet
$worksheetID="od6";
// Include the loader and Google API classes for spreadsheets
require_once('Zend/Loader.php');
Zend_Loader::loadClass('Zend_Gdata');
Zend_Loader::loadClass('Zend_Gdata_ClientLogin');
Zend_Loader::loadClass('Zend_Gdata_Spreadsheets');
Zend_Loader::loadClass('Zend_Http_Client');

// Authenticate on Google Docs and create a Zend_Gdata_Spreadsheets object.            
$service = Zend_Gdata_Spreadsheets::AUTH_SERVICE_NAME;
$client = Zend_Gdata_ClientLogin::getHttpClient($user, $pass, $service);
$spreadsheetService = new Zend_Gdata_Spreadsheets($client);


$dbname = 'DB_NAME';
$dbuser = 'DB_USER';
$dbpasswd = 'DB_PASS';
$dbCon = new mysqli("localhost",$dbuser,$dbpasswd  ,$dbname);

define('IN_PHPBB', true);
define('IN_BBDKP', true);
define('PHPBB_ROOT_PATH', '/home/SOME_DIR/public_html/forums/');
$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './forums/';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);
// Include the base class
if (!class_exists('bbDKP_Admin'))
{
	require("{$phpbb_root_path}includes/bbdkp/bbdkp.$phpEx");
}
$bbdkp = new bbDKP_Admin();
              
$installed_games = array();
foreach($bbdkp->games as $gameid => $gamename)
{
	if ($config['bbdkp_games_' . $gameid] == 1)
	{
		$installed_games[$gameid] = $gamename; 
	} 
}
if (!class_exists('rpraid')) {
  include($phpbb_root_path . 'includes/bbdkp/raidplanner/rpraid.' . $phpEx);
}
if (!class_exists('rpsignup')) {
  require("{$phpbb_root_path}includes/bbdkp/raidplanner/rpsignups.$phpEx");
}
$user->add_lang(array('mods/raidplanner', 'mods/dkp_common'));
		
if ( !function_exists('group_memberships') ) {
    include_once($phpbb_root_path . 'includes/functions_user.'.$phpEx);
}
	    

$user->session_begin();
$originalUserID = $user->data['user_id'];
$realuserdata= $user-> data;

$sql= 'SELECT u.* FROM '. USERS_TABLE. ' u WHERE u.user_id= 54';  // Your account of choice
$result= $db-> sql_query( $sql );
if( $row= $db-> sql_fetchrow( $result ) ) {
    // Only overwrite Keys which actually exist, no other ones
    foreach( $row as $k1=> $v1 ) if( isset( $user-> data[$k1] ) ) $user-> data[$k1]= $v1;
};
$db-> sql_freeresult( $result );
$auth-> acl( $user->data );  // Also take permissions of the new account


// Start session management

// $auth->acl($user->data);
$user->setup('common');

$query_by_pool = '';
$query_by_armor = '';
$query_by_class = '';
$filter = '';

$classarray = armor();
// $classarray = armor();
$startd = request_var ( 'startdkp', 0 );
$arg='';

$alts = array();
$reverseAltLookup=array();
$query = "SELECT alias_member_id, alias_name FROM phpbb_bbdkp_rt_aliases";
$result = $dbCon->query($query, MYSQLI_STORE_RESULT);
while (list($member_id,$alt_name) = $result->fetch_row()) {
  
  $query = "SELECT member_name FROM phpbb_bbdkp_memberlist WHERE member_id =$member_id";
  $result2 = $dbCon->query($query, MYSQLI_STORE_RESULT);
  list($member_name) = $result2->fetch_row();
  $query = "SELECT member_class_id FROM phpbb_bbdkp_memberlist WHERE member_name ='$alt_name'";
  $result2 = $dbCon->query($query, MYSQLI_STORE_RESULT);
  list($alt_class) = $result2->fetch_row();
  if ($alt_class == 0)
    $alt_class=1;
  $alts[$member_name] = $alt_name;
  if (!is_array($reverseAltLookup[$member_name])) {
    $reverseAltLookup[$member_name] = array();
  }
  $reverseAltLookup[$member_name][] = $alt_class."|".$alt_name;
}

$show_all = ((isset ( $_GET ['show'] )) && (request_var ( 'show', '' ) == 'all')) ? true : false;

$memberarray = get_standings($dkpsys_id, $installed_games, $startd, $show_all);
// echo "<pre>";
// print_r($alts);
// echo "</pre>";
echo <<<END
--GuildRaidSnapShot Data - Xoober Pilfer
function GRSS_Initialize_Data()
GRSS_Systems = {};
GRSS_Full_DKP = {};
GRSS_Divide = {};
GRSS_ZeroSum = {};
GRSS_MainOnly = {};
GRSS_MainOnly["BTC"] = true;
GRSSNewestVersion="2.029";
GRSSCurrentSystem = "BTC";
GRSS_Systems["BTC"]="BTC";
GRSS_Full_DKP["BTC"] = {};\n
END;

//********************************************** BTC LIST **************************************************************************************/
$count = 1;
$arrayString = "GRSS_Full_DKP[\"BTC\"][";
foreach ($memberarray as $member) {
  $rank_id = getRankID($member['rank_name']);
  $class = getClassName($member['class_id']);
  // if (isset($alts[$member['member_name']]))
    // continue;
  echo $arrayString.$count."] = {};\n";
  echo $arrayString.$count."].name = \"".$member['member_name']."\";\n";
  echo $arrayString.$count."].class = \"".$class."\";\n";
  echo $arrayString.$count."].earned = ".$member['member_earned'].";\n";
  echo $arrayString.$count."].spent = ".$member['member_spent'].";\n";
  echo $arrayString.$count."].adj = ".$member['member_adjustment'].";\n";
  echo $arrayString.$count."].rankid = $rank_id;\n";
  echo $arrayString.$count."].rank = \"".htmlspecialchars_decode($member['rank_name'])."\";\n";
  if (isset($reverseAltLookup[$member['member_name']])) {
    foreach ($reverseAltLookup[$member['member_name']] as $alt) {
      $count++;
      list ($altClass, $altName) = split("\|", $alt);
      $altClass = getClassName($altClass);
      echo $arrayString.$count."] = {};\n";
      echo $arrayString.$count."].name = \"".$altName."\";\n";
      echo $arrayString.$count."].class = \"".$altClass."\";\n";
      echo $arrayString.$count."].earned = ".$member['member_earned'].";\n";
      echo $arrayString.$count."].spent = ".$member['member_spent'].";\n";
      echo $arrayString.$count."].adj = ".$member['member_adjustment'].";\n";
      echo $arrayString.$count."].rankid = Alt;\n";
      echo $arrayString.$count."].rank = \"".htmlspecialchars_decode($member['rank_name'])."\";\n";
    }
  }
  $count++;
}



//********************************************** ITEM HISTORY **************************************************************************************/
echo "GRSS_ItemHistory = {};";
$sql_array = array();
$sql_array['SELECT'] = ' COUNT(*) as itemcount ' ;
// $s_history = true;
$sql_array = array (
  'SELECT' => '
     e.event_dkpid, e.event_name, e.event_color,   
     i.raid_id, i.item_value, i.item_gameid, i.item_id, i.item_name, i.item_date, i.member_id, 
     l.member_name, c.colorcode, c.imagename, c.class_id, l.member_gender_id, a.image_female, a.image_male, 
     SUM(i.item_decay) as item_decay, 
     SUM(i.item_value - i.item_decay) as item_total, 
     SUM(item_zs) as item_zs ', 
    'FROM' => array (
    EVENTS_TABLE => 'e', 
    RAIDS_TABLE => 'r', 
    RAID_ITEMS_TABLE => 'i', 
      CLASS_TABLE	=> 'c', 
        RACE_TABLE  		=> 'a',
    MEMBER_LIST_TABLE => 'l'), 

  'WHERE' => ' e.event_id = r.event_id  
      AND r.raid_id = i.raid_id
        AND i.member_id = l.member_id
            AND l.member_class_id = c.class_id
            AND l.member_race_id =  a.race_id 
            AND l.game_id = a.game_id
            AND l.game_id = c.game_id', 
  'GROUP_BY' => 'e.event_dkpid, e.event_name, e.event_color,   
     i.raid_id, i.item_value, i.item_gameid, i.item_id, i.item_name, i.item_date, i.member_id, 
     l.member_name, c.colorcode, c.imagename, c.class_id, l.member_gender_id, a.image_female, a.image_male ', 
        'ORDER_BY' => 'member_name asc, i.item_date desc');
$sql = $db->sql_build_query ( 'SELECT', $sql_array );
$items_result = $db->sql_query_limit ( $sql, 100000, 0 );
$itemHistory = array();
while ( $item = $db->sql_fetchrow ( $items_result ) ) {
  if (!isset($itemHistory[$item['member_name']])) {
    $itemHistory[$item['member_name']] = array();
  }
  array_push($itemHistory[$item['member_name']],date ("n/j/Y",$item['item_date']-(6*60*60)).": ".$item['member_name']." <-- ".$item ['item_name']." (".$item['item_total'].")");  // 5/27/2009: Adherel <-- 
}


foreach ($itemHistory as $name => $items) {
  $count = 0;
  //echo "GRSS_ItemHistory[\"$name\"] = {};\n";
  foreach ($items as $item) {
    //echo "GRSS_ItemHistory[\"$name\"][$count] = \"$item\";\n";
    $count++;
  }
}

$db->sql_freeresult ( $items_result );



//********************************************** ITEM PRICES **************************************************************************************/
echo "GRSS_ItemPrices = {};\n";
echo "GRSS_ItemPrices[\"BTC\"]={};\n";

$sql_array = array();
$sql_array['SELECT'] = ' COUNT(DISTINCT item_name) as itemcount ' ;
$s_history = false;
$sql_array = array (
  'SELECT' => '
    e.event_dkpid, e.event_name,  e.event_color, i.item_id, i.item_name, 
    i.member_id, i.item_gameid, i.item_date, i.raid_id, 
    MIN(i.item_value) AS item_value, 
    SUM(i.item_decay) as item_decay, 
    SUM(i.item_value - i.item_decay) as item_total, 
    SUM(item_zs) as item_zs  ', 
  'FROM' => array (
    EVENTS_TABLE => 'e', 
    RAIDS_TABLE => 'r', 
    RAID_ITEMS_TABLE => 'i', 
    ), 
  'WHERE' => ' r.event_id = e.event_id AND i.raid_id = r.raid_id', 
  'GROUP_BY' => 'e.event_dkpid, e.event_name,  e.event_color, i.item_id, i.item_name, 
    i.member_id, i.item_gameid, i.item_date, i.raid_id ', 
  'ORDER_BY' => 'item_name asc' );
$sql = $db->sql_build_query ( 'SELECT', $sql_array );
$items_result = $db->sql_query_limit ( $sql, 100000, 0 );

// $itemPrices = array();
$count = 0;
while ( $item = $db->sql_fetchrow ( $items_result ) ) {
  // $itemPrices[$item['item_name']] = $item['item_total'];	
  $itemPricesStr = "GRSS_ItemPrices[\"BTC\"]";
  //echo $itemPricesStr."[$count] = {};\n";
  //echo $itemPricesStr."[$count].name = \"".$item['item_name']."\";\n";
  //echo $itemPricesStr."[$count].points = \"".$item['item_total']."\";\n";
  //echo $itemPricesStr."[$count].points = \"\";\n";
  $count++;
}
$db->sql_freeresult ( $items_result );










//********************************************** RAID SIGNUPS **************************************************************************************/
echo "GRSS_RaidSignups = {};\n";
$start_temp_date = time();// - 86400 ;
$sort_timestamp_cutoff = $start_temp_date + 86400*365;
$query = "SELECT raidplan_id FROM phpbb_rp_raids WHERE (raidplan_start_time >= $start_temp_date AND raidplan_end_time < $sort_timestamp_cutoff) ORDER BY raidplan_start_time ASC LIMIT 10";
// echo $query;
$result = $dbCon->query($query, MYSQLI_STORE_RESULT);
$count = 1;
while (list($raidplan_id) = $result->fetch_row()) {
  // echo $raidplan_id;
  unset($rpraid);
  $rpraid = new rpraid($raidplan_id);
  $rolesinfo = array();
  $userchars = array();


  
  $subj = $rpraid->subject;
  if( $config['rp_display_truncated_name'] > 0 )
  {
    if(utf8_strlen($rpraid->subject) > $config['rp_display_truncated_name'])
    {
