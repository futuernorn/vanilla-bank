<?php
header("Content-type: text/plain");
ini_set('display_errors',1); 
ini_set('html_errors', 'On');
error_reporting(E_ALL);

// Gmail email address and password for google spreadsheet
$user = 
$pass = 
// Google Spreadsheet ID (You can get it from the URL when you view the spreadsheet)
$GSheetID = 
// od6 is the first worksheet in the spreadsheet
$worksheetID=
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


$dbname = 'SOME_PATH_forum';
$dbuser = 'SOME_PATH_bbtest';
$dbpasswd = 'DB_PASS';
$dbCon = new mysqli("localhost",$dbuser,$dbpasswd  ,$dbname);

define('IN_PHPBB', true);
define('IN_BBDKP', true);
define('PHPBB_ROOT_PATH', '/home/SOME_PATH/public_html/forums/');
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
      $subj = truncate_string(utf8_strlen($rpraid->subject), $config['rp_display_truncated_name']) . '�';
    }
  }


  
 
  echo "GRSS_RaidSignups[$count] = {};\n";
  echo "GRSS_RaidSignups[$count].approved = {};\n";
  echo "GRSS_RaidSignups[$count].waiting = {};\n";
  echo "GRSS_RaidSignups[$count].pending = {};\n";
  echo "GRSS_RaidSignups[$count].name = \"".date ("m/d",$rpraid->start_time-(6*60*60))." ".htmlspecialchars_decode($rpraid->eventlist->events[$rpraid->event_type]['event_name'])."\";\n";
  foreach($rpraid->raidroles as $key => $role)		{				
  // 0 unavailable 1 maybe 2 available 3 confirmed

    foreach($role['role_confirmations'] as $signup) {
       echo getSignupString($signup['signup_val'],$count).$signup['dkpmembername']."\");\n";
		}
    foreach($role['role_signups'] as $signup) {
       echo getSignupString($signup['signup_val'],$count).$signup['dkpmembername']."\");\n";
		}				
  }
  $count++;
}			
echo "GRSS_Dests = {};";



//********************************************** ALTS **************************************************************************************/
echo "GRSS_Alts = {};\n";
foreach ($alts as $main => $alt) {
  echo "GRSS_Alts[\"$alt\"] = \"$main\";\n";
}

//********************************************** ITEM LIMITS **************************************************************************************/
//The function will create a table of the data from your spreadsheet  
echo "GRSS_ItemLimits = {};\n";
$query = new Zend_Gdata_Spreadsheets_ListQuery();
$query->setSpreadsheetKey($GSheetID);
$query->setWorksheetId($worksheetID);
$listFeed = $spreadsheetService->getListFeed($query);
foreach ( $listFeed->entries as $row) {
  $rowData = $row->getCustom(); 
  $i=0;
  $data = array();
  foreach ($rowData as $customEntry) {
    // echo "colname:".$customEntry->getColumnName()." title text:".$row->title->text." getText:".$customEntry->getText()."\n";
    switch ($i) {
      case "1":
        $data[$i] = $customEntry->getText();
        break;
      case "5":
        $data[$i] = $customEntry->getText();
        break;
      case "6":
        $data[$i] = $customEntry->getText();
        break;
      case "7":
        $data[$i] = $customEntry->getText();
        break;
      case "8":
        $data[$i] = $customEntry->getText();
        break;
      case "9":
        $data[$i] = $customEntry->getText();
        break;  
      case "10":
        $data[$i] = $customEntry->getText();
        break;  
      case "11":
        $data[$i] = $customEntry->getText();
        break;  
      case "12":
        $data[$i] = $customEntry->getText();
        break;  
      case "13":
        $data[$i] = $customEntry->getText();
        break;  
      case "17":
        $data[$i] = $customEntry->getText();
        break;        
    }
    $i++;
  }
  if ($data[17] == "Item ID")
    continue;
  $arrayString = "GRSS_ItemLimits[$data[17]]";
  echo $arrayString." = {};\n";
  echo $arrayString.".name = \"".$data[1]."\";\n";
  echo $arrayString.".all = ".$data[5].";\n";
  echo $arrayString.".mage = ".$data[6].";\n";
  echo $arrayString.".warlock = ".$data[7].";\n";
  echo $arrayString.".priest = ".$data[8].";\n";
  echo $arrayString.".rogue = ".$data[9].";\n";
  echo $arrayString.".druid = ".$data[10].";\n";
  echo $arrayString.".hunter = ".$data[11].";\n";
  echo $arrayString.".paladin = ".$data[12].";\n";
  echo $arrayString.".warrior = ".$data[13].";\n";
}
echo "end";
// echo "GRSS_ItemLimits = {};\n";
// $row = 0;
// if (($handle = fopen("itemByClass_v1 - Sheet 1.csv", "r")) !== FALSE) {
    // while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {

      // if ($data[17] == "Item ID")
        // continue;
      // $arrayString = "GRSS_ItemLimits[$data[17]]";
      // echo $arrayString." = {};\n";
      // echo $arrayString.".name = \"".$data[1]."\";\n";
      // echo $arrayString.".all = ".$data[5].";\n";
      // echo $arrayString.".mage = ".$data[6].";\n";
      // echo $arrayString.".warlock = ".$data[7].";\n";
      // echo $arrayString.".priest = ".$data[8].";\n";
      // echo $arrayString.".rogue = ".$data[9].";\n";
      // echo $arrayString.".druid = ".$data[10].";\n";
      // echo $arrayString.".hunter = ".$data[11].";\n";
      // echo $arrayString.".paladin = ".$data[12].";\n";
      // echo $arrayString.".warrior = ".$data[13].";\n";
    // }
    // fclose($handle);
// }
// echo "end";















//********************************************** Functions **************************************************************************************/
function getSignupString($signupVal,$count) {
  switch($signupVal) {
    case 3:
      return "table.insert(GRSS_RaidSignups[$count].approved,\"";
    case 2:
      return "table.insert(GRSS_RaidSignups[$count].waiting,\"";
    case 1:
      return "table.insert(GRSS_RaidSignups[$count].pending,\"";
    case 0:
      return "table.insert(GRSS_RaidSignups[$count].pending,\"";
    default:
      return "table.insert(GRSS_RaidSignups[$count].pending,\"";
  
  }
}
function getClassName($classID) {
  global $classarray;
  foreach ($classarray as $class) {
    if ($classID == $class['class_id']) {
      return $class['class_name'];
    }
  }
  return "Unknown";
}

function getRankID($rank_name) {
  switch($rank_name) {
    case 'Obama':
      return 0;
    case 'Alficer':
      return 1;
    case 'BFF <3 <3':
      return 2;
    case 'Goon':
      return 3;
    case 'Member':
      return 3;
    case 'Recruit':
      return 4;
    default:
      return 3;
  
  }

}

/**
 * gets array with members to display
 *
 * @param int $dkpsys_id
 * @param array $installed_games
 * @param int $startd
 * @return array $memberarray
 */
function get_standings($dkpsys_id, $installed_games, $startd, $show_all)
{
	
	global $config, $user, $db, $template, $query_by_pool, $phpbb_root_path;
	global $query_by_armor, $query_by_class, $filter;
	
	$sql_array = array(
	    'SELECT'    => 	'l.game_id, m.member_dkpid, d.dkpsys_name, m.member_id, m.member_status, m.member_lastraid, 
	    				sum(m.member_raid_value) as member_raid_value, 
	    				sum(m.member_earned) as member_earned, 
	    				sum(m.member_adjustment - m.adj_decay) as member_adjustment,
	    				sum(m.member_spent) as member_spent, 
						sum(m.member_earned + m.member_adjustment - m.member_spent - m.adj_decay ) AS member_current,
	   					l.member_name, l.member_level, l.member_race_id ,l.member_class_id, l.member_rank_id ,
	       				r.rank_name, r.rank_hide, r.rank_prefix, r.rank_suffix, 
	       				l1.name AS member_class, c.class_id, 
	       				c.colorcode, c.class_armor_type AS armor_type, c.imagename, 
	       				l.member_gender_id, a.image_female, a.image_male, 
						c.class_min_level AS min_level,
						c.class_max_level AS max_level', 
	 
	    'FROM'      => array(
	        MEMBER_DKP_TABLE 	=> 'm',
	        DKPSYS_TABLE 		=> 'd',
	        MEMBER_LIST_TABLE 	=> 'l',
	        MEMBER_RANKS_TABLE  => 'r',
	        RACE_TABLE  		=> 'a',
	        CLASS_TABLE    		=> 'c',
	        BB_LANGUAGE			=> 'l1', 
	    	),
	 
	    'WHERE'     =>  "(m.member_id = l.member_id)  
	    		AND l1.attribute_id =  c.class_id AND l1.language= '" . $config['bbdkp_lang'] . "' AND l1.attribute = 'class' and c.game_id = l1.game_id 
				AND (c.class_id = l.member_class_id and c.game_id=l.game_id) 
				AND (l.member_race_id =  a.race_id and a.game_id=l.game_id)
				AND (r.rank_id = l.member_rank_id) 
				AND (m.member_dkpid = d.dkpsys_id) 
				AND (l.member_guild_id = r.guild_id)
				AND r.rank_hide = 0 " ,
	    'GROUP_BY' => 'l.game_id, m.member_dkpid, d.dkpsys_name, m.member_id, m.member_status, m.member_lastraid, 
	   				l.member_name, l.member_level, l.member_race_id ,l.member_class_id, l.member_rank_id ,
	       			r.rank_name, r.rank_hide, r.rank_prefix, r.rank_suffix, 
	       			l1.name, c.class_id, 
	       			c.colorcode, c.class_armor_type , c.imagename, 
	       			l.member_gender_id, a.image_female, a.image_male, 
					c.class_min_level ,
					c.class_max_level ', 
	);
	
	
	if($config['bbdkp_timebased'] == 1)
	{
		$sql_array[ 'SELECT'] .= ', sum(m.member_time_bonus) as member_time_bonus ';
	}
	
	if($config['bbdkp_zerosum'] == 1)
	{
		$sql_array[ 'SELECT'] .= ', sum(m.member_zerosum_bonus) as member_zerosum_bonus';
	}
	
	if($config['bbdkp_decay'] == 1)
	{
		$sql_array[ 'SELECT'] .= ', 
			sum(m.member_raid_decay) as member_raid_decay, 
			sum(m.member_item_decay) as member_item_decay ';
	}
	
	if($config['bbdkp_epgp'] == 1)
	{
		$sql_array[ 'SELECT'] .= ", 
			sum(m.member_earned + m.member_adjustment - m.adj_decay) AS ep,  
			sum(m.member_spent - m.member_item_decay  + ". floatval($config['bbdkp_basegp']) . " ) AS gp, 
		CASE  WHEN SUM(m.member_spent - m.member_item_decay  + " . max(0, $config['bbdkp_basegp']) . " ) = 0 
		THEN  1 
		ELSE  ROUND(SUM(m.member_earned + m.member_adjustment - m.adj_decay) / 
			  SUM(" . max(0, $config['bbdkp_basegp']) . " + m.member_spent - m.member_item_decay),2) END AS pr " ;
	}
	
	//check if inactive members will be shown
	// if ($config ['bbdkp_hide_inactive'] == '1' && !$show_all )
	// {
		// don't show inactive members
		// $sql_array[ 'WHERE'] .= ' AND m.member_status = 1 ';
	// }
	
	if  (isset($_POST['compare']) && isset($_POST['compare_ids']))
	{
		 $compare =  request_var('compare_ids', array('' => 0)) ;
		 $sql_array['WHERE'] .= ' AND ' . $db->sql_in_set('m.member_id', $compare, false, true);
	}
	
	if ($query_by_pool)
	{
		$sql_array['WHERE'] .= ' AND m.member_dkpid = ' . $dkpsys_id . ' ';
	}
	
	
	if (isset ( $_GET ['rank'] ))
	{
		$sql_array['WHERE'] .= " AND r.rank_name='" . request_var ( 'rank', '' ) . "'";
	}
	
	if ($query_by_class == 1)
	{
		//wow_class_8 = Mage
		//lotro_class_5=Hunter
		foreach($installed_games as $k=>$gamename)
		{
			//x is for avoiding output zero which may be outcome of false
			if (strpos('x'.$filter,$k) > 0)
			{
			  $class_id = substr($filter, strlen($k)+7);
			  $sql_array['WHERE'] .= " AND c.class_id =  '" . $db->sql_escape ( $class_id ) . "' ";
			  $sql_array['WHERE'] .= " AND c.game_id =  '" . $db->sql_escape ( $k ) . "' ";
			  break 1;  	
			}
		}
		 
	}
	
	if ($query_by_armor == 1)
	{
		$sql_array['WHERE'] .= " AND c.class_armor_type =  '" . $db->sql_escape ( $filter ) . "'";
	}
		
	// default sorting
	if($config['bbdkp_epgp'] == 1)
	{
		$sql_array[ 'ORDER_BY'] = "CASE WHEN SUM(m.member_spent - m.member_item_decay  + ". floatval($config['bbdkp_basegp']) . "  ) = 0 
		THEN 1
		ELSE ROUND(SUM(m.member_earned + m.member_adjustment - m.adj_decay) / 
		SUM(" . max(0, $config['bbdkp_basegp']) .' + m.member_spent - m.member_item_decay),2) END DESC ' ;
	}
	else 
	{
		$sql_array[ 'ORDER_BY'] = 'sum(m.member_earned + m.member_adjustment - m.member_spent - m.adj_decay) desc, l.member_name asc ' ;
	}
	
	
	$sql = $db->sql_build_query('SELECT_DISTINCT', $sql_array);
	if (! ($members_result = $db->sql_query ( $sql )))
	{
		trigger_error ($user->lang['MNOTFOUND']);
	}
	
	global $allmember_count;
	$allmember_count = 0;
	while ( $row = $db->sql_fetchrow ( $members_result ) )
	{
		++$allmember_count;
	}
	
	$members_result = $db->sql_query_limit ( $sql, $config ['bbdkp_user_llimit'], $startd ); 
	$memberarray = array ();
	$member_count =0;
	while ( $row = $db->sql_fetchrow ( $members_result ) )
	{
		$race_image = (string) (($row['member_gender_id']==0) ? $row['image_male'] : $row['image_female']);
		
		++$member_count;
		$memberarray [$member_count] ['game_id'] = $row ['game_id'];
		$memberarray [$member_count] ['class_id'] = $row ['class_id'];
		$memberarray [$member_count] ['dkpsys_name'] = $row ['dkpsys_name']; 
		$memberarray [$member_count] ['member_id'] = $row ['member_id'];
		$memberarray [$member_count] ['count'] = $member_count;
		$memberarray [$member_count] ['member_name'] = $row ['member_name'];
		$memberarray [$member_count] ['member_status'] = $row ['member_status'];
		$memberarray [$member_count] ['rank_prefix'] = $row ['rank_prefix'];
		$memberarray [$member_count] ['rank_suffix'] = $row ['rank_suffix'];
		$memberarray [$member_count] ['rank_name'] = $row ['rank_name'];
		$memberarray [$member_count] ['rank_hide'] = $row ['rank_hide'];
		$memberarray [$member_count] ['member_level'] = $row ['member_level'];
		$memberarray [$member_count] ['member_class'] = $row ['member_class'];
		$memberarray [$member_count] ['colorcode'] = $row ['colorcode'];
		$memberarray [$member_count] ['class_image'] = (strlen($row['imagename']) > 1) ? $phpbb_root_path . "images/class_images/" . $row['imagename'] . ".png" : '';
		$memberarray [$member_count] ['class_image_exists'] = (strlen($row['imagename']) > 1) ? true : false; 
		$memberarray [$member_count] ['race_image'] = (strlen($race_image) > 1) ? $phpbb_root_path . "images/race_images/" . $race_image . ".png" : '';
		$memberarray [$member_count] ['race_image_exists'] = (strlen($race_image) > 1) ? true : false; 		
		
		$memberarray [$member_count] ['armor_type'] = $row ['armor_type'];
		$memberarray [$member_count] ['member_raid_value'] = $row ['member_raid_value'];
		if($config['bbdkp_timebased'] == 1)
		{
			$memberarray [$member_count] ['member_time_bonus'] = $row ['member_time_bonus'];
			
		}
		if($config['bbdkp_zerosum'] == 1)
		{
			$memberarray [$member_count] ['member_zerosum_bonus'] = $row ['member_zerosum_bonus'];
		}
		$memberarray [$member_count] ['member_earned'] = $row ['member_earned'];
		
		$memberarray [$member_count] ['member_adjustment'] = $row ['member_adjustment'];
		
		if($config['bbdkp_decay'] == 1)
		{
			$memberarray [$member_count] ['member_raid_decay'] = $row ['member_raid_decay'];
			$memberarray [$member_count] ['member_item_decay'] = $row ['member_item_decay'];
		}
		
		$memberarray [$member_count] ['member_spent'] = $row ['member_spent'];
		$memberarray [$member_count] ['member_current'] = $row ['member_current'];
		
		if($config['bbdkp_epgp'] == 1)
		{
			$memberarray [$member_count] ['ep'] = $row ['ep'];
			$memberarray [$member_count] ['gp'] = $row ['gp'];
			$memberarray [$member_count] ['pr'] = $row ['pr'];
		}
		
		$memberarray [$member_count] ['member_lastraid'] = $row ['member_lastraid'];
		$memberarray [$member_count] ['attendanceP1'] = raidcount ( true, $row ['member_dkpid'], $config ['bbdkp_list_p1'], $row ['member_id'],2,false );
		$memberarray [$member_count] ['member_dkpid'] = $row ['member_dkpid'];
	
	}
	$db->sql_freeresult ( $members_result );

	return $memberarray;
}

/**
 * prepares armor dropdown
 *
 */
function armor()
{
	global $config, $user, $db, $template, $query_by_pool;
	
	global $query_by_armor, $query_by_class, $filter;
	
	/***** begin armor-class pulldown ****/
	$classarray = array();
	$filtervalues = array();
	$armor_type = array();
	$classname = array();
	
	$filtervalues ['all'] = $user->lang['ALL']; 
	$filtervalues ['separator1'] = '--------';
	
	// generic armor list
	$sql = 'SELECT class_armor_type FROM ' . CLASS_TABLE . ' GROUP BY class_armor_type';
	$result = $db->sql_query ( $sql, 604000 );
	while ( $row = $db->sql_fetchrow ( $result ) )
	{
		$filtervalues [strtoupper($row ['class_armor_type'])] = $user->lang[strtoupper($row ['class_armor_type'])];
		$armor_type [strtoupper($row ['class_armor_type'])] = $user->lang[strtoupper($row ['class_armor_type'])];
	}
	$db->sql_freeresult ( $result );
	$filtervalues ['separator2'] = '--------';
	
	// get classlist
	$sql_array = array(
	  'SELECT'    => 	'  c.game_id, c.class_id, l.name as class_name, c.class_min_level, 
	  c.class_max_level, c.imagename, c.colorcode ', 
	  'FROM'      => array(
	       CLASS_TABLE 	=> 'c',
	       BB_LANGUAGE		=> 'l', 
	       MEMBER_LIST_TABLE	=> 'i', 
	       MEMBER_DKP_TABLE	=> 'd', 
	   	),
	  'WHERE'		=> " c.class_id > 0 and l.attribute_id = c.class_id and c.game_id = l.game_id
	   AND l.language= '" . $config['bbdkp_lang'] . "' AND l.attribute = 'class' 
	   AND i.member_class_id = c.class_id and i.game_id = c.game_id 
	   AND d.member_id = i.member_id ",   				    	
	  'GROUP_BY'	=> 'c.game_id, c.class_id, l.name, c.class_min_level, c.class_max_level, c.imagename, c.colorcode',
	  'ORDER_BY'	=> 'c.game_id, c.class_id ',
	   );
	   
	$sql = $db->sql_build_query('SELECT', $sql_array);   
	$result = $db->sql_query ( $sql, 604000);
	$classarray = array();
	while ( $row = $db->sql_fetchrow ( $result ) )
	{
		$classarray[] = $row;
		$filtervalues [$row['game_id'] . '_class_' . $row ['class_id']] = $row ['class_name'];
		$classname [$row['game_id'] . '_class_' . $row ['class_id']] = $row ['class_name'];
	}
	$db->sql_freeresult ( $result );
	
	$query_by_armor = 0;
	$query_by_class = 0;
	$submitfilter = (isset ( $_GET ['filter'] ) or isset ( $_POST ['filter'] )) ? true : false;
	if ($submitfilter)
	{
		$filter = request_var ( 'filter', '' );
		
		if ($filter == "all")
		{
			// select all
			$query_by_armor = 0;
			$query_by_class = 0;
		} 
		elseif (array_key_exists ( $filter, $armor_type ))
		{
			// looking for an armor type
			$filter = preg_replace ( '/ Armor/', '', $filter );
			$query_by_armor = 1;
			$query_by_class = 0;
		} 
		elseif (array_key_exists ( $filter, $classname ))
		{
			// looking for a class
			$query_by_class = 1;
			$query_by_armor = 0;
		}
	}
	 else
	{
		// select all
		$query_by_armor = 0;
		$query_by_class = 0;
		$filter = 'all';
	}
	
	// dump filtervalues to dropdown template
	foreach ( $filtervalues as $fid => $fname )
	{
		$template->assign_block_vars ( 'filter_row', array (
			'VALUE' => $fid, 
			'SELECTED' => ($fid == $filter && $fname !=  '--------' ) ? ' selected="selected"' : '',
			'DISABLED' => ($fname == '--------' ) ? ' disabled="disabled"' : '', 
			'OPTION' => (! empty ( $fname )) ? $fname : $user->lang['ALL'] ) );
	}
	
	/***** end armor - class pulldown ****/
	return $classarray;
}
?>
