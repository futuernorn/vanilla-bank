<?php
// $docRoot = "/home/SOME_PATH/www/beta/";

// include_once($docRoot.'backend/Mobile_Detect.php');
// include_once($docRoot."backend/common.php");
// $common = new Common();
// $detect = new Mobile_Detect();

$csvData = "Head,1st,Crown of Destruction,MC,18817,11502,npc,
Neck,1st,Onyxia Tooth Pendant,Ony,18404,7496,npc,1
Shoulders,1st,Field Marshall,PvP,16468,12785,npc,1
Back,1st,Cape of the Black Baron,Strath,13340,10440,npc,
Chest,1st,Knight-Captain,PvP,23292,12785,npc,
Bracers,1st,Dragonstalker,BWL,16935,12435,npc,
Gloves,1st,Marshall's,PvP,16463,12785,npc,
Belt,1st,Dragonstalker,BWL,16936,13020,npc,
Boots,1st,Dragonstalker,BWL,16941,12017,npc,
Rings,1st,Band of Accuria,MC,17063,11502,npc,1
Trinkets,1st,Drake Fang Talisman,BWL,19406,14601,npc,1
2H,1st,Barbarous Blade,DM:N,18520,11501,npc,
MH,1st,Brutality Blade,MC,18832,12057,npc,
OH,1st,Core Hound Tooth,MC,18805,179703,object,
Ranged,1st,GM Xbow,PvP GM,18836,12784,npc,
Head,2nd,Field Marshall,PvP,16465,12785,npc,
Neck,2nd,Mark of Fordring,Quest,15411,5944,quest,
Shoulders,2nd,Dragonstalker,BWL,16937,14020,npc,1
Back,2nd,Cloak of Firemaw,BWL,19398,11983,npc,
Chest,2nd,Savage Gladiator Chain,BRD,11726,9027,npc,
Bracers,2nd,Giantstalker,MC,16850,,,
Gloves,2nd,Dragonstalker,BWL,16940,,,
Belt,2nd,Giantstalker,MC,16851,,,
Boots,2nd,Giantstalker,MC,16849,12259,npc,
Rings,2nd,Ring of the Unliving,World Raid,20624,14889,npc,
Trinkets,2nd,Blackhand's Breadth,Quest,13965,5102,quest,
2H,2nd,Peacemaker,Strath,18725,10435,npc,
MH,2nd,Doom's Edge,BWL,19362,,,
Ranged,2nd,Dragonbreath Hand Cannon,BWL,19368,14601,npc,
Head,3rd,Dragonstalker,Ony,16939,10184,npc,
Neck,3rd,Amulet of the Darkmoon,Quest,19491,7981,quest,
Shoulders,3rd,Giantstalker,MC,16848,12098,npc,1
Back,3rd,Puissant Cape,World Raid,18541,6109,npc,1
Chest,3rd,Dragonstalker,BWL,16942,11583,npc,
Bracers,3rd,True Flight,MC,18812,179703,object,1
Gloves,3rd,Gauntlet's of Deftness,Strath,22410,10440,npc,
Belt,3rd,Warpwood Binding,DM:W,18393,11489,npc,
Boots,3rd,Marshall's,PvP,16462,12785,npc,1
Rings,3rd,Quick Strike Ring,MC,18821,,,
Trinkets,3rd,DM Trinket,DM Book,18473,7503,quest,
2H,3rd,Lok'Delar,Quest,18715,7632,quest,
MH,3rd,Dal'Rend's,UBRS,12940,10429,npc,
OH,3rd,Dal'Rend's,UBRS,12939,10429,npc,
Ranged,3rd,Rhok'Delar,Quest,18713,7632,quest,
Head,4th,Giantstalker,MC,16846,12057,npc,
Shoulders,4th,Stratholme Militia,Strath,18742,,,
Back,4th,Cloak of Shrouded Mists,MC,17102,11502,npc,
Chest,4th,Field Marshall,PvP,16466,12785,npc,
Bracers,4th,Swift Flight,Crafting,18508,22923,spell,
Gloves,4th,Giantstalker,MC,16852,12264,npc,
Boots,4th,Windreaver,Scholo,13967,10506,npc,1
Rings,4th,Don Julio's Band,AV Exalted,19325,13216,npc,1
2H,4th,Ash'Kandi,BWL,19364,11583,npc,
MH,4th,Bone Slicing Hatchet,Strath,18737,10438,npc,
OH,4th,Bone Slicing Hatchet,Strath,18737,10438,npc,
Ranged,4th,Dwarven Hand Cannon,World Random Drop,2099,,,
Head,5th,Backwood Helm,Quest,18421,7462,quest,
Shoulders,5th,Truestrike,UBRS,12927,9816,npc,1
Back,5th,Shadow Prowler's Cloak,UBRS,22269,10363,npc,
Chest,5th,Giantstalker,MC,16845,11988,npc,
Bracers,5th,Beaststalker's,Dungeon,16681,,,
Rings,5th,Painweaver,UBRS,13098,10363,npc,
2H,5th,The Untamed Blade,BWL,19334,12435,npc,
Ranged,5th,Carapace Spine,UD Strat,18738,10437,npc,
Rings,6th,Tarnished Elven Ring,DM:N,18500,179564,object,1";
// $bisArray = str_getcsv($csvData);
$bisArray = str_getcsv($csvData, "\n"); //parse the rows 
foreach($bisArray as &$Row) $Row = str_getcsv($Row, ","); //parse the items in rows 
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
        sortList: [[1,0],[1,0]],
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
<br>
<div id="main-content">
<div class="infoText" id="lastUpdatedTxt">
* - Gear has Hit you may need to shift things around to reach the cap (5-6% from gear if you have talents)
<br>
Chest note: The Blue PvP chest and Savage Gladiator have 2% Crit, and T2, T1, & PvP have 1% crit but more AGI, so could be switched around depending as well
</div>
<br><br>
<?php
// echo "<pre>";
// print_r($bisArray);
// echo "</pre>";
?>
	<table class="tablesorter" id="bis_table">
	<thead>
	<tr>    
    <th class="filter-select">Slot</th>
    <th class="filter-select">Rank</th>		
    <th>Item</th>		
    <th class="filter-select">Location</th>
	</tr>
	</thead>
  <tbody>
<tr>
<td>Head</td>
<td>1st</td>
<td><a alt='http://aowow.org/?item=18817' ><span style='color: #a335ee'>Crown of Destruction</span></a></td>
<td><a href='http://aowow.org/?npc=11502' >Crown of Destruction</a></td>
</tr>
<tr>
<td>Neck</td>
<td>1st</td>
<td><a alt='http://aowow.org/?item=18404' ><span style='color: #a335ee'>Onyxia Tooth Pendant</span></a>*</td>
<td><a href='http://aowow.org/?npc=7496' >Onyxia Tooth Pendant</a></td>
</tr>
<tr>
<td>Shoulders</td>
<td>1st</td>
<td><a alt='http://aowow.org/?item=16468' ><span style='color: #a335ee'>Field Marshall</span></a>*</td>
<td><a href='http://aowow.org/?npc=12785' >Field Marshall</a></td>
</tr>
<tr>
<td>Back</td>
<td>1st</td>
<td><a alt='http://aowow.org/?item=13340' ><span style='color: #0070ff'>Cape of the Black Baron</span></a></td>
<td><a href='http://aowow.org/?npc=10440' >Cape of the Black Baron</a></td>
</tr>
<tr>
<td>Chest</td>
<td>1st</td>
<td><a alt='http://aowow.org/?item=23292' ><span style='color: #0070ff'>Knight-Captain</span></a></td>
<td><a href='http://aowow.org/?npc=12785' >Knight-Captain</a></td>
</tr>
<tr>
<td>Bracers</td>
<td>1st</td>
<td><a alt='http://aowow.org/?item=16935' ><span style='color: #a335ee'>Dragonstalker</span></a></td>
<td><a href='http://aowow.org/?npc=12435' >Dragonstalker</a></td>
</tr>
<tr>
<td>Gloves</td>
<td>1st</td>
<td><a alt='http://aowow.org/?item=16463' ><span style='color: #a335ee'>Marshall's</span></a></td>
<td><a href='http://aowow.org/?npc=12785' >Marshall's</a></td>
</tr>
<tr>
<td>Belt</td>
<td>1st</td>
<td><a alt='http://aowow.org/?item=16936' ><span style='color: #a335ee'>Dragonstalker</span></a></td>
<td><a href='http://aowow.org/?npc=13020' >Dragonstalker</a></td>
</tr>
<tr>
<td>Boots</td>
<td>1st</td>
<td><a alt='http://aowow.org/?item=16941' ><span style='color: #a335ee'>Dragonstalker</span></a></td>
<td><a href='http://aowow.org/?npc=12017' >Dragonstalker</a></td>
</tr>
<tr>
<td>Rings</td>
<td>1st</td>
<td><a alt='http://aowow.org/?item=17063' ><span style='color: #a335ee'>Band of Accuria</span></a>*</td>
<td><a href='http://aowow.org/?npc=11502' >Band of Accuria</a></td>
</tr>
<tr>
<td>Trinkets</td>
<td>1st</td>
<td><a alt='http://aowow.org/?item=19406' ><span style='color: #a335ee'>Drake Fang Talisman</span></a>*</td>
<td><a href='http://aowow.org/?npc=14601' >Drake Fang Talisman</a></td>
</tr>
<tr>
<td>2H</td>
<td>1st</td>
<td><a alt='http://aowow.org/?item=18520' ><span style='color: #0070ff'>Barbarous Blade</span></a></td>
<td><a href='http://aowow.org/?npc=11501' >Barbarous Blade</a></td>
</tr>
<tr>
<td>MH</td>
<td>1st</td>
<td><a alt='http://aowow.org/?item=18832' ><span style='color: #a335ee'>Brutality Blade</span></a></td>
<td><a href='http://aowow.org/?npc=12057' >Brutality Blade</a></td>
</tr>
<tr>
<td>OH</td>
<td>1st</td>
<td><a alt='http://aowow.org/?item=18805' ><span style='color: #a335ee'>Core Hound Tooth</span></a></td>
<td><a href='http://aowow.org/?object=179703' >Core Hound Tooth</a></td>
</tr>
<tr>
<td>Ranged</td>
<td>1st</td>
<td><a alt='http://aowow.org/?item=18836' ><span style='color: #a335ee'>GM Xbow</span></a></td>
<td><a href='http://aowow.org/?npc=12784' >GM Xbow</a></td>
</tr>
<tr>
<td>Head</td>
<td>2nd</td>
<td><a alt='http://aowow.org/?item=16465' ><span style='color: #a335ee'>Field Marshall</span></a></td>
<td><a href='http://aowow.org/?npc=12785' >Field Marshall</a></td>
</tr>
<tr>
<td>Neck</td>
<td>2nd</td>
<td><a alt='http://aowow.org/?item=15411' ><span style='color: #0070ff'>Mark of Fordring</span></a></td>
<td><a href='http://aowow.org/?quest=5944' >Mark of Fordring</a></td>
</tr>
<tr>
<td>Shoulders</td>
<td>2nd</td>
<td><a alt='http://aowow.org/?item=16937' ><span style='color: #a335ee'>Dragonstalker</span></a>*</td>
<td><a href='http://aowow.org/?npc=14020' >Dragonstalker</a></td>
</tr>
<tr>
<td>Back</td>
<td>2nd</td>
<td><a alt='http://aowow.org/?item=19398' ><span style='color: #a335ee'>Cloak of Firemaw</span></a></td>
<td><a href='http://aowow.org/?npc=11983' >Cloak of Firemaw</a></td>
</tr>
<tr>
<td>Chest</td>
<td>2nd</td>
<td><a alt='http://aowow.org/?item=11726' ><span style='color: #a335ee'>Savage Gladiator Chain</span></a></td>
<td><a href='http://aowow.org/?npc=9027' >Savage Gladiator Chain</a></td>
</tr>
<tr>
<td>Bracers</td>
<td>2nd</td>
<td><a alt='http://aowow.org/?item=16850' ><span style='color: #a335ee'>Giantstalker</span></a></td>
<td>Giantstalker</td>
</tr>
<tr>
<td>Gloves</td>
<td>2nd</td>
<td><a alt='http://aowow.org/?item=16940' ><span style='color: #a335ee'>Dragonstalker</span></a></td>
<td>Dragonstalker</td>
</tr>
<tr>
<td>Belt</td>
<td>2nd</td>
<td><a alt='http://aowow.org/?item=16851' ><span style='color: #a335ee'>Giantstalker</span></a></td>
<td>Giantstalker</td>
</tr>
<tr>
<td>Boots</td>
<td>2nd</td>
<td><a alt='http://aowow.org/?item=16849' ><span style='color: #a335ee'>Giantstalker</span></a></td>
<td><a href='http://aowow.org/?npc=12259' >Giantstalker</a></td>
</tr>
<tr>
<td>Rings</td>
<td>2nd</td>
<td><a alt='http://aowow.org/?item=20624' ><span style='color: #a335ee'>Ring of the Unliving</span></a></td>
<td><a href='http://aowow.org/?npc=14889' >Ring of the Unliving</a></td>
</tr>
<tr>
<td>Trinkets</td>
<td>2nd</td>
<td><a alt='http://aowow.org/?item=13965' ><span style='color: #0070ff'>Blackhand's Breadth</span></a></td>
<td><a href='http://aowow.org/?quest=5102' >Blackhand's Breadth</a></td>
</tr>
<tr>
<td>2H</td>
<td>2nd</td>
<td><a alt='http://aowow.org/?item=18725' ><span style='color: #0070ff'>Peacemaker</span></a></td>
<td><a href='http://aowow.org/?npc=10435' >Peacemaker</a></td>
</tr>
<tr>
<td>MH</td>
<td>2nd</td>
<td><a alt='http://aowow.org/?item=19362' ><span style='color: #a335ee'>Doom's Edge</span></a></td>
<td>Doom's Edge</td>
</tr>
<tr>
<td>Ranged</td>
<td>2nd</td>
<td><a alt='http://aowow.org/?item=19368' ><span style='color: #a335ee'>Dragonbreath Hand Cannon</span></a></td>
<td><a href='http://aowow.org/?npc=14601' >Dragonbreath Hand Cannon</a></td>
</tr>
<tr>
<td>Head</td>
<td>3rd</td>
<td><a alt='http://aowow.org/?item=16939' ><span style='color: #a335ee'>Dragonstalker</span></a></td>
<td><a href='http://aowow.org/?npc=10184' >Dragonstalker</a></td>
</tr>
<tr>
<td>Neck</td>
<td>3rd</td>
<td><a alt='http://aowow.org/?item=19491' ><span style='color: #a335ee'>Amulet of the Darkmoon</span></a></td>
<td><a href='http://aowow.org/?quest=7981' >Amulet of the Darkmoon</a></td>
</tr>
<tr>
<td>Shoulders</td>
<td>3rd</td>
<td><a alt='http://aowow.org/?item=16848' ><span style='color: #a335ee'>Giantstalker</span></a>*</td>
<td><a href='http://aowow.org/?npc=12098' >Giantstalker</a></td>
</tr>
<tr>
<td>Back</td>
<td>3rd</td>
<td><a alt='http://aowow.org/?item=18541' ><span style='color: #a335ee'>Puissant Cape</span></a>*</td>
<td><a href='http://aowow.org/?npc=6109' >Puissant Cape</a></td>
</tr>
<tr>
<td>Chest</td>
<td>3rd</td>
<td><a alt='http://aowow.org/?item=16942' ><span style='color: #a335ee'>Dragonstalker</span></a></td>
<td><a href='http://aowow.org/?npc=11583' >Dragonstalker</a></td>
</tr>
<tr>
<td>Bracers</td>
<td>3rd</td>
<td><a alt='http://aowow.org/?item=18812' ><span style='color: #a335ee'>True Flight</span></a>*</td>
<td><a href='http://aowow.org/?object=179703' >True Flight</a></td>
</tr>
<tr>
<td>Gloves</td>
<td>3rd</td>
<td><a alt='http://aowow.org/?item=22410' ><span style='color: #0070ff'>Gauntlet's of Deftness</span></a></td>
<td><a href='http://aowow.org/?npc=10440' >Gauntlet's of Deftness</a></td>
</tr>
<tr>
<td>Belt</td>
<td>3rd</td>
<td><a alt='http://aowow.org/?item=18393' ><span style='color: #0070ff'>Warpwood Binding</span></a></td>
<td><a href='http://aowow.org/?npc=11489' >Warpwood Binding</a></td>
</tr>
<tr>
<td>Boots</td>
<td>3rd</td>
<td><a alt='http://aowow.org/?item=16462' ><span style='color: #a335ee'>Marshall's</span></a>*</td>
<td><a href='http://aowow.org/?npc=12785' >Marshall's</a></td>
</tr>
<tr>
<td>Rings</td>
<td>3rd</td>
<td><a alt='http://aowow.org/?item=18821' ><span style='color: #a335ee'>Quick Strike Ring</span></a></td>
<td>Quick Strike Ring</td>
</tr>
<tr>
<td>Trinkets</td>
<td>3rd</td>
<td><a alt='http://aowow.org/?item=18473' ><span style='color: #0070ff'>DM Trinket</span></a></td>
<td><a href='http://aowow.org/?quest=7503' >DM Trinket</a></td>
</tr>
<tr>
<td>2H</td>
<td>3rd</td>
<td><a alt='http://aowow.org/?item=18715' ><span style='color: #a335ee'>Lok'Delar</span></a></td>
<td><a href='http://aowow.org/?quest=7632' >Lok'Delar</a></td>
</tr>
<tr>
<td>MH</td>
<td>3rd</td>
<td><a alt='http://aowow.org/?item=12940' ><span style='color: #0070ff'>Dal'Rend's</span></a></td>
<td><a href='http://aowow.org/?npc=10429' >Dal'Rend's</a></td>
</tr>
<tr>
<td>OH</td>
<td>3rd</td>
<td><a alt='http://aowow.org/?item=12939' ><span style='color: #0070ff'>Dal'Rend's</span></a></td>
<td><a href='http://aowow.org/?npc=10429' >Dal'Rend's</a></td>
</tr>
<tr>
<td>Ranged</td>
<td>3rd</td>
<td><a alt='http://aowow.org/?item=18713' ><span style='color: #a335ee'>Rhok'Delar</span></a></td>
<td><a href='http://aowow.org/?quest=7632' >Rhok'Delar</a></td>
</tr>
<tr>
<td>Head</td>
<td>4th</td>
<td><a alt='http://aowow.org/?item=16846' ><span style='color: #a335ee'>Giantstalker</span></a></td>
<td><a href='http://aowow.org/?npc=12057' >Giantstalker</a></td>
</tr>
<tr>
<td>Shoulders</td>
<td>4th</td>
<td><a alt='http://aowow.org/?item=18742' ><span style='color: #0070ff'>Stratholme Militia</span></a></td>
<td>Stratholme Militia</td>
</tr>
<tr>
<td>Back</td>
<td>4th</td>
<td><a alt='http://aowow.org/?item=17102' ><span style='color: #a335ee'>Cloak of Shrouded Mists</span></a></td>
<td><a href='http://aowow.org/?npc=11502' >Cloak of Shrouded Mists</a></td>
</tr>
<tr>
<td>Chest</td>
<td>4th</td>
<td><a alt='http://aowow.org/?item=16466' ><span style='color: #a335ee'>Field Marshall</span></a></td>
<td><a href='http://aowow.org/?npc=12785' >Field Marshall</a></td>
</tr>
<tr>
<td>Bracers</td>
<td>4th</td>
<td><a alt='http://aowow.org/?item=18508' ><span style='color: #0070ff'>Swift Flight</span></a></td>
<td><a href='http://aowow.org/?spell=22923' >Swift Flight</a></td>
</tr>
<tr>
<td>Gloves</td>
<td>4th</td>
<td><a alt='http://aowow.org/?item=16852' ><span style='color: #a335ee'>Giantstalker</span></a></td>
<td><a href='http://aowow.org/?npc=12264' >Giantstalker</a></td>
</tr>
<tr>
<td>Boots</td>
<td>4th</td>
<td><a alt='http://aowow.org/?item=13967' ><span style='color: #0070ff'>Windreaver</span></a>*</td>
<td><a href='http://aowow.org/?npc=10506' >Windreaver</a></td>
</tr>
<tr>
<td>Rings</td>
<td>4th</td>
<td><a alt='http://aowow.org/?item=19325' ><span style='color: #a335ee'>Don Julio's Band</span></a>*</td>
<td><a href='http://aowow.org/?npc=13216' >Don Julio's Band</a></td>
</tr>
<tr>
<td>2H</td>
<td>4th</td>
<td><a alt='http://aowow.org/?item=19364' ><span style='color: #a335ee'>Ash'Kandi</span></a></td>
<td><a href='http://aowow.org/?npc=11583' >Ash'Kandi</a></td>
</tr>
<tr>
<td>MH</td>
<td>4th</td>
<td><a alt='http://aowow.org/?item=18737' ><span style='color: #0070ff'>Bone Slicing Hatchet</span></a></td>
<td><a href='http://aowow.org/?npc=10438' >Bone Slicing Hatchet</a></td>
</tr>
<tr>
<td>OH</td>
<td>4th</td>
<td><a alt='http://aowow.org/?item=18737' ><span style='color: #0070ff'>Bone Slicing Hatchet</span></a></td>
<td><a href='http://aowow.org/?npc=10438' >Bone Slicing Hatchet</a></td>
</tr>
<tr>
<td>Ranged</td>
<td>4th</td>
<td><a alt='http://aowow.org/?item=2099' ><span style='color: #a335ee'>Dwarven Hand Cannon</span></a></td>
<td>Dwarven Hand Cannon</td>
</tr>
<tr>
<td>Head</td>
<td>5th</td>
<td><a alt='http://aowow.org/?item=18421' ><span style='color: #0070ff'>Backwood Helm</span></a></td>
<td><a href='http://aowow.org/?quest=7462' >Backwood Helm</a></td>
</tr>
<tr>
<td>Shoulders</td>
<td>5th</td>
<td><a alt='http://aowow.org/?item=12927' ><span style='color: #0070ff'>Truestrike</span></a>*</td>
<td><a href='http://aowow.org/?npc=9816' >Truestrike</a></td>
</tr>
<tr>
<td>Back</td>
<td>5th</td>
<td><a alt='http://aowow.org/?item=22269' ><span style='color: #0070ff'>Shadow Prowler's Cloak</span></a></td>
<td><a href='http://aowow.org/?npc=10363' >Shadow Prowler's Cloak</a></td>
</tr>
<tr>
<td>Chest</td>
<td>5th</td>
<td><a alt='http://aowow.org/?item=16845' ><span style='color: #a335ee'>Giantstalker</span></a></td>
<td><a href='http://aowow.org/?npc=11988' >Giantstalker</a></td>
</tr>
<tr>
<td>Bracers</td>
<td>5th</td>
<td><a alt='http://aowow.org/?item=16681' ><span style='color: #0070ff'>Beaststalker's</span></a></td>
<td>Beaststalker's</td>
</tr>
<tr>
<td>Rings</td>
<td>5th</td>
<td><a alt='http://aowow.org/?item=13098' ><span style='color: #0070ff'>Painweaver</span></a></td>
<td><a href='http://aowow.org/?npc=10363' >Painweaver</a></td>
</tr>
<tr>
<td>2H</td>
<td>5th</td>
<td><a alt='http://aowow.org/?item=19334' ><span style='color: #a335ee'>The Untamed Blade</span></a></td>
<td><a href='http://aowow.org/?npc=12435' >The Untamed Blade</a></td>
</tr>
<tr>
<td>Ranged</td>
<td>5th</td>
<td><a alt='http://aowow.org/?item=18738' ><span style='color: #0070ff'>Carapace Spine</span></a></td>
<td><a href='http://aowow.org/?npc=10437' >Carapace Spine</a></td>
</tr>
<tr>
<td>Rings</td>
<td>6th</td>
<td><a alt='http://aowow.org/?item=18500' ><span style='color: #0070ff'>Tarnished Elven Ring</span></a>*</td>
<td><a href='http://aowow.org/?object=179564' >Tarnished Elven Ring</a></td>
</tr>
<?php
  // foreach ($bisArray as $itemRow) {
    // if ($itemRow[2] != "") {
    // echo "<tr>";
    // echo "<td>$itemRow[0]</td>";
    // echo "<td>$itemRow[1]</td>";
    // $query = "SELECT Quality, name FROM item_template WHERE entry=".$itemRow[4];
    // $result = $common->query($query);		
    // if (mysqli_num_rows($result)) {
      // list($quality,$name) = $result->fetch_row();
      // $color = "ffffff";
      // switch ($quality) {
        // case 0:
          // $color = "9d9d9d";
          // break;
        // case 1:
          // $color = "ffffff";
          // break;
        // case 2:
          // $color = "1eff00";
          // break;
        // case 3:
          // $color = "0070ff";
          // break;
        // case 4:
          // $color = "a335ee";
          // break;
        // case 5:
          // $color = "a335ee";
          // break;
        // case 6:
          // $color = "e6cc80";
          // break;
        // default:
          // $color = "ffffff";
      // }
      // if ($itemRow[7] != 1) {
        // echo "<td><a alt='http://aowow.org/?item=$itemRow[4]' ><span style='color: #$color'>$name</span></a></td>";
      // } else {
       // echo "<td><a alt='http://aowow.org/?item=$itemRow[4]' ><span style='color: #$color'>$name</span></a>*</td>";
      // }
      
    // } else {
      // echo "<td>$itemRow[2]</td>";
    // }
    // if ($itemRow[5] != '' && $itemRow[6] != '') {
      // echo "<td><a href='http://aowow.org/?$itemRow[6]=$itemRow[5]' >$itemRow[3]</a></td>";
    // } else {
      // echo "<td>$itemRow[3]</td>";
    // }
    // echo "</tr>";
    // }
  // }
?>
 
  </tbody></table>
<br><br>
<h1><a href='https://docs.google.com/spreadsheet/ccc?key=0AqC_mM1n_UiwdFl6UjZaNldDQ29vNl92M0Z4alI0OEE&usp=sharing'>Source</a></h1>
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
