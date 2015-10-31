<?php
$docRoot = "/home/SOME_PATH/www/beta/";

include_once($docRoot.'backend/Mobile_Detect.php');
include_once($docRoot."backend/common.php");
$common = new Common();
$detect = new Mobile_Detect();
if ($detect->isMobile() && !isset($_GET['forceDesktop'])) {
  include 'mobile.php';
  exit();
}


?>
<!DOCTYPE html> 
<html>
<head>
	<base target="_blank"/>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<title>&lt;<?php echo $common::guildName;?>&gt;</title> 
  <link rel="favicon" type="image/x-icon" href="/favicon.ico">
	<link rel="stylesheet" href="/css/style.css" />
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
	<script src="./js/backend.js"></script>
  <script src="./js/loginFunctions.js"></script>
  <script>
    $(document).ready(function() {
    $('.tablesorter').tooltip();
      $(function() {
        <?php echo $common->getMemberNamesJS();?> 
        $( "#name" ).autocomplete({
          source: memberNames
        });
      });
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
<?php echo $common->makeFabulous("<".$common::guildName."> - Bank");?>
</h1>

<h3 style="text-align:center;background-color: #333;">
<?php
$common->outputMenu();
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

<?php 
$common->outputGreeting();
?>
</h1>
<br>

<div id="bankerLinks" style="margin: auto;text-align: center;">
<a href="javascript:void(0)" target="_self" onClick="filterBanker('');">All</a> | 
<?php 
$output = "";
foreach ($common->bankerList as $banker) {
  $output = '<a href="javascript:void(0)" target="_self" onClick="filterBanker(\''.$banker.'\');">'.$banker.'</a> | ';
}
echo substr($output, 0, -3);
?>
</div>
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
  
  $output = "";
  foreach ($common->bankerList as $banker) {
    $query = "SELECT bankitems.*, ".
      "item_template.InventoryType, item_template.class, item_template.ItemLevel, item_template.subclass, item_template.RequiredLevel ".
      "FROM bankitems, item_template ".
      "WHERE bankitems.itemId=item_template.entry AND banker='$banker' ".
      "AND lastUpdated = (SELECT lastUpdated from bankitems WHERE banker='$banker' ORDER BY lastupdated DESC LIMIT 1) ".
      "ORDER BY banker ASC";
    $result = $common->query($query);    
    while(list($id, $banker, $itemName, $itemID, $itemCount, $color, $icon, $dbLastUpdated, $location, $typeVal, $classVal, $itemLevel, $subClassVal, $reqLevel) = $result->fetch_row()) {
      $quality = getQualityText($color);

      $output .= '<tr id="'.$id.'" itemID="'.$itemID.'" icon="'.$icon.'">';
      $output .= '<td class="itemCount" id="'.$id.'-itemCount-'.$itemCount.'"><span style="text-align:right">'.$itemCount.'</span></td>';
      $output .= '<td><a href="'.$common::aowowURL.'?item='.$itemID.'" class="itemLink" style="color:#'.$color.';">'.$itemName.'</a></td>';
      $output .= '<td><font class="itemColor" color=#'.$color.'>'.$quality.'</font></td>';
      $output .= '<td>'.$itemLevel.'</td>';
      $output .= '<td>'.$reqLevel.'</td>';
      $output .= '<td>'.$common->inventoryType[$typeVal].'</td>';
      $output .= '<td>'.$common->subClass[$classVal][$subClassVal].'</td>';
      $output .= '<td><a href="javascript:void(0)" title="'.$location.'" class="itemBanker">'.$banker.'</a></td>';
      $output .= '</tr>';
    }
  }

	echo $output;
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
?>
</tbody></table>
</div>
</div>
<div id="floatingLink" style='background-color:#000; left:0; position:fixed; text-align:center; bottom:0; width:100%;'>

<a href="javascript:void(0)" onClick="resetSelections();" target="_self" title="Empty cart">Empty cart</a> - 
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
    <label for="name">Name:</label>
    <input type="text" name="name" id="name" class="text ui-widget-content ui-corner-all" />
    </div>
  </fieldset>
  </form>
  </br>
  <div id="checkoutStatus" style='display:none;'>
  Submitting order...<img src='/images/ajax-loader.gif'></br><em>(May take a few moments)</em>
  </div>
  <br>
  <h3>Cart Contents</h3>
  <div id="currentCart"></div>
  </div>
</div>
<?php $common->outputDialogs(); ?>
</body>
</html>

<?php
function getLastUpdated($banker, $common) {
 $query = "SELECT lastUpdated from bankitems WHERE banker='$banker' ORDER BY lastupdated DESC LIMIT 1";
	$result = $common->query($query);
  list($lastUpdated) = $result->fetch_row();
  return date(" F j, Y @ g:i a ", strtotime($lastUpdated));
}

function getQualityText($color) {
  $quality = "";
  switch ($color) {
    case "1eff00":
      $quality = "Uncommon";
      break;
    case "ffffff":
      $quality = "Common";
      break;
    case "0070dd":
      $quality = "Rare";
      break;
    case "a335ee":
      $quality = "Epic";
      break;
    default:
      $quality = "It'sAMystery";
  }
  return $quality;
}
?>
