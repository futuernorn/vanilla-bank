<?php
$docRoot = "/home/SOME_PATH/www/beta/";

//include_once($docRoot.'backend/Mobile_Detect.php');
// include_once($docRoot."backend/common.php");
// $common = new Common();
//$detect = new Mobile_Detect();



?>
<!DOCTYPE html> 
<html>
<head>
	<base target="_blank"/>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<title>&lt;<?php //echo $common::guildName;?>&gt;</title> 
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
  <?php //echo $common->outputCommonJS();?>

	<script type="text/javascript" src="/js/power.js"></script>
  <?php //include_once($docRoot."backend/analyticstracking.php") ?>
	<script src="/js/jquery-1.9.1.js"></script>
  <script src="/js/jquery.md5.min.js"></script>
  <script src="/js/jquery-ui-1.10.1.custom.min.js"></script>  
  <script src="/js/jquery.tablesorter.js"></script>	
	<script src="/js/jquery.tablesorter.widgets.js"></script>	
  <script>
    $(document).ready(function() {

      $("#bis_table").tablesorter({
        cssInfoBlock : "tablesorter-no-sort", 		
        sortList: [[0,1],[1,0]],
        widgets: ['zebra', 'stickyHeaders', 'filter']   
      });
    });
  </script>
</head> 
<body> 
<div id="page">
<h1 style="text-align:center;background-color: #333;">
<?php //echo $common->makeFabulous("<".$common::guildName."> - BIS");?>
</h1>

<h3 style="text-align:center;background-color: #333;">
<?php
//$common->outputMenu();
?>
</h3>
<br>
<?php //echo $common->getMotd();?>
<br>
<div id="main-content">

	<table class="tablesorter" id="bis_table">
	<thead>
	<tr>    
    <th class="filter-select">Slot</th>		
    <th>Item</th>		
    <th class="filter-select">Location</th>
	</tr>
	</thead>
  <tbody>
 <tr>
<td>Head</td>
<td><a href='http://aowow.org/?item=13102' ><span style='color: #0070dd'>Cassandra's Grase</span></a></td>
<td>AH</td>
</tr>
<tr>
<td>Neck</td>
<td><a href='http://aowow.org/?item=18723' ><span style='color: #0070dd'>Animated Chain Necklace</span></a></td>
<td>Strat Undead</td>
</tr>
<tr>
<td>Neck</td>
<td><a href='http://aowow.org/?item=22327' ><span style='color: #0070dd'>Amulet of the Redeemed</span></a></td>
<td>Strat Live</td>
</tr>
<tr>
<td>Shoulders</td>
<td><a href='http://aowow.org/?item=22234' ><span style='color: #0070dd'>Mantle of lost Hope</span></a></td>
<td>BRD</td>
</tr>
<tr>
<td>Shoulders</td>
<td><a href='http://aowow.org/?item=22405' ><span style='color: #0070dd'>Mantle of the Scarlet Crusade</span></a></td>
<td>Strat Live</td>
</tr>
<tr>
<td>Back</td>
<td><a href='http://aowow.org/?item=18510' ><span style='color: #a335ee'>Hide of the Wild</span></a></td>
<td>Leatherworking</td>
</tr>
<tr>
<td>Back</td>
<td><a href='http://aowow.org/?item=18389' ><span style='color: #0070dd'>Cloak of the Cosmos</span></a></td>
<td>DM West</td>
</tr>
<tr>
<td>Chest</td>
<td><a href='http://aowow.org/?item=13346' ><span style='color: #0070dd'>Robes of the Exalted</span></a></td>
<td>Strat Undead</td>
</tr>
<tr>
<td>Wrists</td>
<td><a href='http://aowow.org/?item=18497' ><span style='color: #0070dd'>Sublime Wristguards</span></a></td>
<td>DM North</td>
</tr>
<tr>
<td>Wrists</td>
<td><a href='http://aowow.org/?item=22079' ><span style='color: #0070dd'>Virtous Bracers</span></a></td>
<td>AH</td>
</tr>
<tr>
<td>Weapon</td>
<td><a href='http://aowow.org/?item=22406' ><span style='color: #0070dd'>Redemption</span></a></td>
<td>Strat Live</td>
</tr>
<tr>
<td>Weapon</td>
<td><a href='http://aowow.org/?item=11932' ><span style='color: #0070dd'>Guiding Staff of Wisdom</span></a></td>
<td>BRD</td>
</tr>
<tr>
<td>Main+Offhand</td>
<td><a href='http://aowow.org/?item=11923' ><span style='color: #0070dd'>The Hammer of Grace</span></a></td>
<td>BRD</td>
</tr>
<tr>
<td>Main+Offhand</td>
<td><a href='http://aowow.org/?item=11928' ><span style='color: #0070dd'>Thaurissan´s Royal Scepter</span></a></td>
<td>BRD</td>
</tr>
<tr>
<td>Main+Offhand</td>
<td><a href='http://aowow.org/?item=18523' ><span style='color: #0070dd'>Brightly Glowing Stone</span></a></td>
<td>DM North</td>
</tr>
<tr>
<td>Main+Offhand</td>
<td><a href='http://aowow.org/?item=19312' ><span style='color: #a335ee'>Lei of Livegiver</span></a></td>
<td>Alterac Valley Exalted</td>
</tr>
<tr>
<td>Wand</td>
<td><a href='http://aowow.org/?item=21801' ><span style='color: #0070dd'>Antenna of Invigoration</span></a></td>
<td>AQ 20</td>
</tr>
<tr>
<td>Wand</td>
<td><a href='http://aowow.org/?item=13938' ><span style='color: #0070dd'>Bonecreeper Stylus</span></a></td>
<td>Scholo</td>
</tr>
<tr>
<td>Wand</td>
<td><a href='http://aowow.org/?item=18483' ><span style='color: #0070dd'>Mana Channeling Wand</span></a></td>
<td>DM North</td>
</tr>
<tr>
<td>Hands</td>
<td><a href='http://aowow.org/?item=12554' ><span style='color: #0070dd'>Hands of the Exalted Herald</span></a></td>
<td>BRD</td>
</tr>
<tr>
<td>Waist</td>
<td><a href='http://aowow.org/?item=18327' ><span style='color: #0070dd'>Whipvine Cord</span></a></td>
<td>DM East</td>
</tr>
<tr>
<td>Legs</td>
<td><a href='http://aowow.org/?item=18386' ><span style='color: #0070dd'>Padre`s Trousers</span></a></td>
<td>DM West</td>
</tr>
<tr>
<td>Boots</td>
<td><a href='http://aowow.org/?item=22247' ><span style='color: #0070dd'>Faith Healers Boots</span></a></td>
<td>UBRS</td>
</tr>
<tr>
<td>Boots</td>
<td><a href='http://aowow.org/?item=18507' ><span style='color: #0070dd'>Boots of the Full Moon</span></a></td>
<td>DM North</td>
</tr>
<tr>
<td>Finger</td>
<td><a href='http://aowow.org/?item=22334' ><span style='color: #0070dd'>Band of Mending</span></a></td>
<td>Strat Live</td>
</tr>
<tr>
<td>Finger</td>
<td><a href='http://aowow.org/?item=13178' ><span style='color: #0070dd'>Rosewine Circle</span></a></td>
<td>LBRS/UBRS</td>
</tr>
<tr>
<td>Trinket</td>
<td><a href='http://aowow.org/?item=18469' ><span style='color: #0070dd'>Royal seal of Eldre`Thalas</span></a></td>
<td>AH</td>
</tr>
<tr>
<td>Trinket</td>
<td><a href='http://aowow.org/?item=18371' ><span style='color: #0070dd'>Mindtap Talisman</span></a></td>
<td>DM West</td>
</tr>
<tr>
<td>Trinket</td>
<td><a href='http://aowow.org/?item=12930' ><span style='color: #0070dd'>Briarwood Reed</span></a></td>
<td>UBRS</td>
</tr>
  </tbody></table>




</body>
</html>

<?php
// function getLastUpdated($banker, $common) {
 // $query = "SELECT lastUpdated from bankitems WHERE banker='$banker' ORDER BY lastupdated DESC LIMIT 1";
	// $result = $common->query($query);
  // list($lastUpdated) = $result->fetch_row();
  // return date(" F j, Y @ g:i a ", strtotime($lastUpdated));
// }

// function getQualityText($color) {
  // $quality = "";
  // switch ($color) {
    // case "1eff00":
      // $quality = "Uncommon";
      // break;
    // case "ffffff":
      // $quality = "Common";
      // break;
    // case "0070dd":
      // $quality = "Rare";
      // break;
    // case "a335ee":
      // $quality = "Epic";
      // break;
    // default:
      // $quality = "It'sAMystery";
  // }
  // return $quality;
// }
?>
