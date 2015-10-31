<?php
$docRoot = "/home/SOME_PATH/www/";
// ini_set('display_errors',1); 
// ini_set('html_errors', 'On');
 // error_reporting(E_ALL);
$dbname = 'SOME_PATH_forum';
$dbuser = 'SOME_PATH_bbtest';
$dbpasswd = 'DB_PASS';

$sqlDB = "DB_USER";
$sqlUser = "DB_USER";
$sqlPass = "DB_PASS";
$db = new mysqli("localhost", $dbuser, $dbpasswd, $dbname );
if (mysqli_connect_errno($db)) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$db_lgw = new mysqli("localhost", $sqlUser, $sqlPass, $sqlDB );
if (mysqli_connect_errno($db_lgw)) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$inventoryType[0] = "Non equipable";
    $inventoryType[1] = "Head";
    $inventoryType[2] = "Neck";
    $inventoryType[3] = "Shoulder";
    $inventoryType[4] = "Shirt";
    $inventoryType[5] = "Chest";
    $inventoryType[6] = "Waist";
    $inventoryType[7] = "Legs";
    $inventoryType[8] = "Feet";
    $inventoryType[9] = "Wrists";
    $inventoryType[10] = "Hands";
    $inventoryType[11] = "Finger";
    $inventoryType[12] = "Trinket";
    $inventoryType[13] = "Weapon";
    $inventoryType[14] = "Shield";
    $inventoryType[15] = "Ranged";
    $inventoryType[16] = "Back";
    $inventoryType[17] = "Two-Hand";
    $inventoryType[18] = "Bag";
    $inventoryType[19] = "Tabard";
    $inventoryType[20] = "Robe";
    $inventoryType[21] = "Main hand";
    $inventoryType[22] = "Off hand";
    $inventoryType[23] = "Holdable (Tome)";
    $inventoryType[24] = "Ammo";
    $inventoryType[25] = "Thrown";
    $inventoryType[26] = "Ranged right";
    $inventoryType[27] = "Quiver";
    $inventoryType[28] = "Quiver";

    $subClass[0][0] = "Consumable";
    $subClass[0][1] = "Potion";
    $subClass[0][2] = "Elixir";
    $subClass[0][3] = "Flask";
    $subClass[0][4] = "Scroll";
    $subClass[0][5] = "Food & Drink";
    $subClass[0][6] = "Item Enhancement	";
    $subClass[0][7] = "Bandage";
    $subClass[0][8] = "Other";
    $subClass[1][0] = "Bag";
    $subClass[1][1] = "Soul Bag";
    $subClass[1][2] = "Herb Bag";
    $subClass[1][3] = "Enchanting Bag";
    $subClass[1][4] = "Engineering Bag";
    $subClass[1][5] = "Gem Bag";
    $subClass[1][6] = "Mining Bag";
    $subClass[1][7] = "Leatherworking Bag";
    $subClass[2][0] = "Axe";
    $subClass[2][1] = "Axe";
    $subClass[2][2] = "Bow";
    $subClass[2][3] = "Gun";
    $subClass[2][4] = "Mace";
    $subClass[2][5] = "Mace";
    $subClass[2][6] = "Polearm";
    $subClass[2][7] = "Sword";
    $subClass[2][8] = "Sword";
    $subClass[2][9] = "Obsolete";
    $subClass[2][10] = "Staff";
    $subClass[2][11] = "Exotic";
    $subClass[2][12] = "Exotic";
    $subClass[2][13] = "Fist Weapon";
    $subClass[2][14] = "Miscellaneous";
    $subClass[2][15] = "Dagger";
    $subClass[2][16] = "Thrown";
    $subClass[2][17] = "Spear";
    $subClass[2][18] = "Crossbow";
    $subClass[2][19] = "Wand";
    $subClass[2][20] = "Fishing Pole";
    $subClass[3][1] = "Red";
    $subClass[3][2] = "Blue";
    $subClass[3][3] = "Yellow";
    $subClass[3][4] = "Purple";
    $subClass[3][5] = "Green";
    $subClass[3][6] = "Orange";
    $subClass[3][7] = "Meta";
    $subClass[3][8] = "Simple";
    $subClass[3][9] = "Prismatic";
    $subClass[4][0] = "Miscellaneous";
    $subClass[4][1] = "Cloth";
    $subClass[4][2] = "Leather";
    $subClass[4][3] = "Mail";
    $subClass[4][4] = "Plate";
    $subClass[4][5] = "Buckler(OBSOLETE)";
    $subClass[4][6] = "Shield";
    $subClass[4][7] = "Libram";
    $subClass[4][8] = "Idol";
    $subClass[4][9] = "Totem";
    $subClass[5][0] = "Reagent";
    $subClass[6][0] = "Wand";
    $subClass[6][1] = "Bolt";
    $subClass[6][2] = "Arrow";
    $subClass[6][3] = "Bullet";
    $subClass[6][4] = "Thrown";
    $subClass[7][0] = "Trade Goods";
    $subClass[7][1] = "Parts";
    $subClass[7][2] = "Explosives";
    $subClass[7][3] = "Devices";
    $subClass[7][4] = "Jewelcrafting";
    $subClass[7][5] = "Cloth";
    $subClass[7][6] = "Leather";
    $subClass[7][7] = "Metal & Stone";
    $subClass[7][8] = "Meat";
    $subClass[7][9] = "Herb";
    $subClass[7][10] = "Elemental";
    $subClass[7][11] = "Other";
    $subClass[7][12] = "Enchanting";
    $subClass[8][0] = "Generic";
    $subClass[9][0] = "Book";
    $subClass[9][1] = "Leatherworking";
    $subClass[9][2] = "Tailoring";
    $subClass[9][3] = "Engineering";
    $subClass[9][4] = "Blacksmithing";
    $subClass[9][5] = "Cooking";
    $subClass[9][6] = "Alchemy";
    $subClass[9][7] = "First Aid";
    $subClass[9][8] = "Enchanting";
    $subClass[9][9] = "Fishing";
    $subClass[9][10] = "Jewelcrafting";
    $subClass[10][0] = "Money";
    $subClass[11][0] = "Quiver";
    $subClass[11][1] = "Quiver";
    $subClass[11][2] = "Quiver";
    $subClass[11][3] = "Ammo Pouch";
    $subClass[12][0] = "Quest";
    $subClass[13][0] = "Key";
    $subClass[13][1] = "Lockpick";
    $subClass[14][0] = "Permanent";
    $subClass[15][0] = "Junk";
    $subClass[15][1] = "Reagent";
    $subClass[15][2] = "Pet";
    $subClass[15][3] = "Holiday";
    $subClass[15][4] = "Other";
    $subClass[15][5] = "Mount";

?>




<!DOCTYPE html> 
<html>
<head>
	<base target="_blank"/>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<title>Item Values</title> 
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
  <script>
  rangeFilterFunc = {
  '0-5'      : function(e, n, f, i) { return n>=0 && n<=5; },
  '6-10'      : function(e, n, f, i) { return n>=6 && n<=10; },
  '11-20'      : function(e, n, f, i) { return n>=11 && n<=20; },
  '20+'      : function(e, n, f, i) { return n>=21 && n<=999999; },
  };

  rangeFilterFunc2 = {
  '0-100'      : function(e, n, f, i) { return n>=0 && n<=100; },
  '101-250'      : function(e, n, f, i) { return n>=101 && n<=250; },
  '251-500'      : function(e, n, f, i) { return n>=251 && n<=500; },
  '501-1000'      : function(e, n, f, i) { return n>=501 && n<=1000; },
  '1000+'      : function(e, n, f, i) { return n>=1001 && n<=9999999; },
  };
  window.filter_functions_list = {
      0 : rangeFilterFunc,
      4 : rangeFilterFunc2,
      5 : rangeFilterFunc2,
      6 : rangeFilterFunc2,
      7 : rangeFilterFunc2,
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

</head>
</head> 
<body> 
<div id="page">
<h1> BTC Item Values </h1>
<div id="main-content">

	<table class="tablesorter" id="bankers_table">
	<thead>
	<tr>    	 
    <th style="width: 3%;">Count</th>
    <th>Name</th>	
    <th class="filter-select">Type</th>	
    <th class="filter-select">Subclass</th>    
    <th>Min</th>
    <th>Max</th>
    <th>Average</th>
    <th>Sum</th>		
	</tr>
	</thead>
  <tbody>
<?php
 

  
$query = "SELECT item_gameid, item_name, COUNT(*), MAX(item_value), SUM(item_value), MIN(item_value) FROM phpbb_bbdkp_raid_items WHERE item_value <> 0 AND item_gameid <> 0 GROUP BY item_gameid ORDER BY item_name ASC";
$result = $db->query($query);    
while(list($itemID, $itemName, $count, $max, $sum, $min) = $result->fetch_row()) {
  $query_item = "SELECT Quality, item_template.InventoryType, item_template.class, item_template.ItemLevel, item_template.subclass, item_template.RequiredLevel ".
      "FROM item_template ".
      "WHERE $itemID=item_template.entry ";
  $result_itemTemplate = $db_lgw->query($query_item);    
  list($quality, $typeVal, $classVal, $itemLevel, $subClassVal, $reqLevel) = $result_itemTemplate->fetch_row();
  $qualityColor = getQualityColor($quality);
  $qualityName = getQualityText($qualityColor);
  
	echo "<tr>";
	echo "<td>".round($count)."</td>";
	echo "<td><a href='http://db.vanillagaming.org/?item=$itemID'><font color='#$qualityColor'>$itemName</font></a></td>";
  echo "<td>$inventoryType[$typeVal]</td>";
  echo "<td>".$subClass[$classVal][$subClassVal]."</td>";
	echo "<td>".round($min)."</td>";
	echo "<td>".round($max)."</td>";
	echo "<td>".round($sum/$count)."</td>";
	echo "<td>".round($sum)."</td>";
	echo "</tr>";
    
}

?>
</tbody>
</table>
<br><br>

</div>
</div>

</body>
</html>

<?php
function getQualityColor($quality) {
  $color = "";
  switch ($quality) {
    case 2:
      $color = "1eff00";
      break;
    case 1:
      $color = "ffffff";
      break;
    case 3:
      $color = "0070dd";
      break;
    case 4:
      $color = "a335ee";
      break;
    default:
      $color = "fffff";
  }
  return $color;

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
