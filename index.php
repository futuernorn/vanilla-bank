<?php
$docRoot = "/home/SOME_PATH/www/";
// ini_set('display_errors',1); 
// ini_set('html_errors', 'On');
 // error_reporting(E_ALL);
include_once($docRoot.'backend/Mobile_Detect.php');
include_once($docRoot."backend/common.php");



$common = new Common();

if (isset($_GET['clearAll']) && $_GET['clearAll'] == "true") {
    $currentBankerList = $common->bankerList;
  $currentBankerList[] = "Goonraids";
  $currentBankerList[] = "Goonjungle";
  $currentBankerList[] = "Goonpharmacy";
  foreach ($currentBankerList as $banker) {
    $query = "DELETE ".      
        "FROM `bankitems` ".
        "WHERE banker='$banker' ".
        "AND lastUpdated <> (SELECT lastUpdated from bankitems WHERE banker='$banker' ORDER BY lastupdated DESC LIMIT 1) ";
    echo $query."<br>";
    $result = $common->query($query);    
  }
  exit();
}

if (isset($_GET['checkUpdate']) && $_GET['checkUpdate'] == "true") {
  echo $common->getLastUpdated(false);
  exit();
}

$detect = new Mobile_Detect();
if ($detect->isMobile() && !isset($_GET['forceDesktop'])) {
  include 'mobile.php';
  exit();
}



if (isset($_POST['getTable'])) {
  getBankerTable($common);
  exit;
}

define('IN_PHPBB', true);
$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './forums/';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);
include($phpbb_root_path . 'includes/functions_user.' . $phpEx);

// Start session management
$user->session_begin();
$auth->acl($user->data);
$user->setup();
$sid=$user->session_id;
$isCoolDude = false;
if (group_memberships(8,$user->data['user_id'], true) || group_memberships(9,$user->data['user_id'], true) || group_memberships(11,$user->data['user_id'], true)) {
  $isCoolDude = true;
}
?>
<!DOCTYPE html> 
<html>
<head>
	<base target="_blank"/>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<title>&lt;<?php echo GUILDNAME;?>&gt;</title> 
  <link rel="favicon" type="image/x-icon" href="/favicon.ico">
	<link rel="stylesheet" href="/css/style.css?242awdw" />
	<link rel="stylesheet" href="/css/ui-darkness/jquery-ui-1.10.1.custom.min.css" />
  <style>
  label {
    display: inline-block;
    width: 5em;
  }
  div.ui-tooltip {
    max-width: 150px;
  }
  </style>
  <?php echo $common->outputCommonJS();?>
  <script>
  rangeFilterFunc = {
      <?php
      $output = "";
      foreach ($common->levelRanges as $range=>$limits) {
        $start = $limits['start'];
        $end = $limits['end'];
        $output .= "'$range'      : function(e, n, f, i) { return n>=$start && n<=$end; },";
      }
      echo substr_replace($output ,"",-1);
      ?>     
      };
  window.filter_functions_list = {
      3 : rangeFilterFunc,
      4 : rangeFilterFunc
    }
  </script>

	<script type="text/javascript" src="/js/power.js"></script>
  <?php include_once($docRoot."backend/analyticstracking.php") ?>
	<script src="/js/jquery-1.9.1.js"></script>
  <script src="/js/jquery.md5.min.js"></script>
  <script src="/js/jquery-ui-1.10.1.custom.min.js"></script>  
  <script src="/js/jquery.tablesorter.js"></script>	
	<script src="/js/jquery.tablesorter.widgets.js"></script>	
	<script src="/js/backend.js?asf32f4h4h"></script>
  <script>
    $(document).ready(function() {
    $('.tablesorter').tooltip();
      $(function() {
        <?php echo $common->getMemberNamesJS();?> 
        $( "#name" ).autocomplete({
          source: memberNames
        });
      });
      <?php echo isset($_GET['banker']) ? "filterBanker('".$_GET['banker']."');" : ""; ?>
    });
    function filterBanker(banker) {
    $('select[data-column="7"]').val(banker);
    $('select[data-column="7"]').trigger('change');
    }
  </script>
</head>
</head> 
<body> 
<div id="page">
<h1 style="text-align:center;background-color: #333;">
<?php echo $common->makeFabulous("<".GUILDNAME."> - Bank");?>
</h1>

<h3 style="text-align:center;background-color: #333;">
<?php
if (isset($_GET['forceDesktop'])) {
?>
<a target="_self" href="http://b.DOMAIN/?forceDesktop=1">Blog</a> - <a target="_self" href="http://DOMAIN/users.php?forceDesktop=1">Members</a> - <a target="_self" href="http://DOMAIN/forums/index.php?&mobile=desktop">Forums</a> - <a target="_self" href="http://DOMAIN/admin.php">Admin</a> - <a target="_self" href="http://DOMAIN/mobile.php" onClick="_gaq.push(['_trackEvent', 'Site Display Change', 'Desktop-to-Mobile', 'Bank - Force Desktop', 1, true]);">Mobile</a>
<?php
} else {
?>
<a target="_self" href="http://b.DOMAIN/">Blog</a> - <a target="_self" href="http://DOMAIN/users.php">Members</a> - <a target="_self" href="http://DOMAIN/forums">Forums</a> - <a target="_self" href="http://DOMAIN/admin.php">Admin</a> - <a target="_self" href="http://DOMAIN/mobile.php"  onClick="_gaq.push(['_trackEvent', 'Site Display Change', 'Desktop-to-Mobile', 'Bank', 1, true]);">Mobile</a>
<?php
}
?>
</h3>
<br>
<?php echo $common->getMotd();?>
<br>
<div id="main-content">

<div class="infoText" id="lastUpdatedTxt">
<?php
echo "Latest update:".$common->getLastUpdated(). "CST";
?>
</div>
</br>
<div style='text-align:center;'><a href='http://DOMAIN/forums/viewtopic.php?f=2&t=11#p25'>Instructions Post</a></div>
<br>


<div id="bankerLinks" style="margin: auto;text-align: center;">
<a href="javascript:void(0)" target="_self" onClick="filterBanker('');">All</a> | 
<a href="javascript:void(0)" target="_self" onClick="filterBanker('Goonblues');">Goonblues</a> | 
<a href="javascript:void(0)" target="_self" onClick="filterBanker('Goonherbs');">Goonherbs</a> | 
<a href="javascript:void(0)" target="_self" onClick="filterBanker('Goonleather');">Goonleather</a> | 
<a href="javascript:void(0)" target="_self" onClick="filterBanker('Goonmetal');">Goonmetal</a> | 
<a href="javascript:void(0)" target="_self" onClick="filterBanker('Goonquest');">Goonquest</a> | 
<a href="javascript:void(0)" target="_self" onClick="filterBanker('Goonshards');">Goonshards</a> | 
<a href="javascript:void(0)" target="_self" onClick="filterBanker('Goonwife');">Goonwife</a> | 
<a href="javascript:void(0)" target="_self" onClick="filterBanker('Goonrecipes');">Goonrecipes</a> | 
<a href="javascript:void(0)" target="_self" onClick="filterBanker('Goonrandom');">Goonrandom</a> | 
<a href="javascript:void(0)" target="_self" onClick="filterBanker('Gooncloth');">Gooncloth</a> | 
<a href="javascript:void(0)" target="_self" onClick="filterBanker('Goonelement');">Goonelement</a> | 
<a href="javascript:void(0)" target="_self" onClick="filterBanker('Goongreens');">Goongreens</a>
<?php
if ($isCoolDude) {
  echo ' <br>Alificers: <a href="javascript:void(0)" target="_self" onClick="filterBanker(\'Goonraids\')" style="color:#FF00FF;");">Goonraids</a>';
  echo ' | <a href="javascript:void(0)" target="_self" onClick="filterBanker(\'Goonjungle\')" style="color:#FF00FF;");">Goonjungle</a> ';
  echo ' | <a href="javascript:void(0)" target="_self" onClick="filterBanker(\'Goonpharmacy\')" style="color:#FF00FF;");">Goonpharmacy</a> ';
  $result = $common->query("SELECT totalGold FROM information WHERE id=1"); 
  list($totalGold) = $result->fetch_row();
  echo " || Total Gold: $totalGold";
}
?>
</div>
<br>
<br>

	<table class="tablesorter" id="bankers_table">
	<thead>
	<tr>    
	  <th class="filter-false" style="width: 3%;">Count</th>
		<th>Name</th>				
		<th class="filter-select" style="width: 10%;">Quality</th>
    <th style="width: 10%;">Item Level</th>
    <th style="width: 10%;">Req Level</th>
		<th class="filter-select" style="width: 10%;">Type</th>
		<th class="filter-select" style="width: 10%;">Subclass</th>
    <th class="filter-select" style="width: 10%;">Banker</th>
	</tr>
	</thead>
  <tbody>
<?php
  getBankerTable($common);
 function getBankerTable($common) {
  global $isCoolDude;
  $output = "";
  $currentBankerList = $common->bankerList;
  if ($isCoolDude) {
    // $addition = $common->privateBankerList;
    // print_r($addition);
    // $currentBankerList = array_merge($currentBankerList, $addition);
    $currentBankerList[] = "Goonraids";
    $currentBankerList[] = "Goonjungle";
    $currentBankerList[] = "Goonpharmacy";
  }
  foreach ($currentBankerList as $banker) {
  
    $query = "SELECT bankitems.*, ".
      "item_template.InventoryType, item_template.class, item_template.ItemLevel, item_template.subclass, item_template.RequiredLevel ".
      "FROM bankitems, item_template ".
      "WHERE bankitems.itemId=item_template.entry AND banker='$banker' ".
      "AND lastUpdated = (SELECT lastUpdated from bankitems WHERE banker='$banker' ORDER BY lastupdated DESC LIMIT 1) ".
      "ORDER BY banker ASC";
    $result = $common->query($query);    
    while(list($id, $banker, $itemName, $itemID, $itemCount, $color, $icon, $dbLastUpdated, $location, $typeVal, $classVal, $itemLevel, $subClassVal, $reqLevel) = $result->fetch_row()) {
      $quality = getQualityText($color);

      $output .= '<tr id="'.$id.'" itemID="'.$itemID.'"><td class="itemCount" id="'.$id.'-itemCount-'.$itemCount.'"><span style="text-align:right">'.$itemCount.'</span></td><td>'.
      '<a href="'.AOWOWURL.'?item='.$itemID.'" class="itemLink"><font class="itemName" color=#'.$color.'>'.stripslashes($itemName).'</a></font></td><td><font color=#'.$color.'>'.$quality.'</font></td>';
      $output .= '<td>'.$itemLevel.'</td>'.'<td>'.$reqLevel.'</td>'.'<td>'.$common->inventoryType[$typeVal].'</td><td>'.$common->subClass[$classVal][$subClassVal].'</td><td><a href="javascript:void(0)" title="'.$location.'">'.$banker.'</a></td></tr>';
    }
  }

	echo $output;
  }
?>
</tbody>
</table>
<br><br>
<table class="tablesorter" style='width:50%;'>
<thead>
<tr><th colspan="2">Latest Updates - By Banker:</th></tr>
</thead>
<tbody>

<?php
foreach ($common->bankerList as $banker) {
  echo "<tr><td>$banker</td><td>".getLastUpdated($banker,$common)."</td></tr>";
}
if ($isCoolDude) {
  // foreach ($common->privateBankerList as $banker) {
    echo "<tr><td>Goonraids</td><td>".getLastUpdated("Goonraids",$common)."</td></tr>";
    echo "<tr><td>Goonjungle</td><td>".getLastUpdated("Goonjungle",$common)."</td></tr>";
    echo "<tr><td>Goonpharmacy</td><td>".getLastUpdated("Goonpharmacy",$common)."</td></tr>";
  // }
}
?>
</tbody></table>
</div>
</div>
<div id="floatingLink" style='background-color:#000; left:0; position:fixed; text-align:center; bottom:0; width:100%;'><hr>
<a href="#" target="_self" title="Back to Top"><img style="border: none;" src="./images/top.gif"/>Back to Top</a> - 
<a href="javascript:void(0)" onclick="doCheckout();" target="_self" title="Checkout">Checkout</a> 
</div>
</div>
<br /><br />
<br /><br />
<div id="dialog-form" title="Checkout" style='height:600px;'>
<div id="test">
  
  <form>
  <fieldset>
    <div class="ui-widget">
    <label for="name" style='width:150px;'>In-Game Name</label>
    <input type="text" name="name" id="name" class="text ui-widget-content ui-corner-all"  />
    </div>
    <label for="password" style='width:150px;'>Password</label>
    <input type="text" name="password" id="password" value="" class="text ui-widget-content ui-corner-all" /></br>
  </fieldset>
  </form>
  <br>
  <div style='font-size:75%'>Note: this is not your forum login information. See instructions here: <a href='http://DOMAIN/forums/viewtopic.php?f=2&t=11#p25'>link</a>.</div>
  <div id="checkoutStatus" style='display:none;'>
  Submitting order...<img src='/images/ajax-loader.gif'></br><em>(May take a few moments)</em>
  </div>
  <br><br><hr>

  <h3>Cart Contents</h3>
  <div id="currentCart"></div>
  </div>
</div>

<div id="dialog-confirm" title="Refesh to update data?">
  <p><span class="ui-icon ui-icon-alert" ></span>There has been an update to the site's data, please confirm a page reload to ensure everything doesn't break horribly.</p>
</div>
</body>
</html>
