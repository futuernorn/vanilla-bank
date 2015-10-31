<?php
header("Content-type: text/plain");
// header("Content-Disposition: attachment; filename=savethis.txt");
// echo "this is the file\n";
// echo " you could generate content here, instead.";

define('IN_PHPBB', true);
define('PHPBB_ROOT_PATH', './forums/');
$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './forums/';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);
// include($phpbb_root_path . 'dkp.' . $phpEx);
// include($phpbb_root_path . 'includes/bbdkp/module/standings.' . $phpEx);

$query_by_pool = '';
$query_by_armor = '';
$query_by_class = '';
$filter = '';

$classarray = armor();
// $classarray = armor();
$startd = request_var ( 'startdkp', 0 );
$arg='';



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

$show_all = ((isset ( $_GET ['show'] )) && (request_var ( 'show', '' ) == 'all')) ? true : false;

$memberarray = get_standings($dkpsys_id, $installed_games, $startd, $show_all);
// echo "<pre>";
// print_r($classarray);
// echo "</pre>";

echo <<<END
--GuildRaidSnapShot Data - Xoober Pilfer
function GRSS_Initialize_Data()
GRSS_Systems = {};
GRSS_Full_DKP = {};
GRSS_Divide = {};
GRSS_ZeroSum = {};
GRSS_MainOnly = {};
GRSSNewestVersion="2.029";
GRSSCurrentSystem = "BTC";
GRSS_Systems["BTC"]="BTC";
GRSS_Full_DKP["BTC"] = {};
END;
$count = 1;
$arrayString = "GRSS_Full_DKP[\"BTC\"][";
foreach ($memberarray as $member) {
  // $rank_id = $getRankID($data['rank_name']);
  $class = getClassName($member['class_id']);
  echo $arrayString.$count."] = {};\n";
  echo $arrayString.$count."].name = \"".$member['member_name']."\";\n";
  echo $arrayString.$count."].class = \"".$class."\";\n";
  echo $arrayString.$count."].earned = ".$member['member_earned'].";\n";
  echo $arrayString.$count."].spent = ".$member['member_spent'].";\n";
  echo $arrayString.$count."].adj = ".$member['member_adjustment'].";\n";
  echo $arrayString.$count."].rankid = 3;\n";
  echo $arrayString.$count."].rank = \"".$member['rank_name']."\";\n";
  $count++;
}
echo <<<END
GRSS_ItemHistory = {};
GRSS_ItemPrices = {};
GRSS_ItemPrices["BTC"]={};
GRSS_RaidSignups = {};
GRSS_Dests = {};
GRSS_Alts = {};
end
END;

function getClassName($classID) {
  global $classarray;
  foreach ($classarray as $class) {
    if ($classID == $class['class_id']) {
      return $class['class_name'];
    }
  }
  return "Unknown";
}

// function getRandID($rank_name) {
  // switch($rank_name) {
    // case 'Obama'
      // return 0;
    // case 'Alficer'
      // return 1;
    // case '
  
  
  // }

// }

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
	if ($config ['bbdkp_hide_inactive'] == '1' && !$show_all )
	{
		// don't show inactive members
		$sql_array[ 'WHERE'] .= ' AND m.member_status = 1 ';
	}
	
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
