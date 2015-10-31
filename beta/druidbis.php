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
    <th class="filter-select">Spec</th>
    <th class="filter-select">Slot</th>		
    <th>Item</th>		
    <th class="filter-select">Location</th>
    <th>Points</th>
	</tr>
	</thead>
  <tbody>
  <tr>
  <td>Restro</td>
  <td>Head</td>
  <td><a href='http://aowow.org/?item=13102' ><span style='color: #4169E1'>Cassandra&#39;s Grace</span></a></td>
  <td>World Random Drop (AH)</td>
  <td>48,1</td>
  </tr>
  <tr>
  <td>Restro</td>
  <td>Head</td>
  <td><a href='http://aowow.org/?item=18490' ><span style='color: #4169E1'>Insightful Hood</span></a></td>
  <td><a href='http://www.aowow.org/?npc=14324'>DM North</a></td>
  <td>54,6</td>
  </tr>
  <tr>
  <td>Restro</td>
  <td>Head</td>
  <td><a href='http://aowow.org/?item=22689' ><span style='color: #4169E1'>Sanctified Leather Helm</span></a></td>
  <td><a href='http://www.aowow.org/?quest=9221'>Quest</a></td>
  <td>57,8</td>
  </tr>
    <tr>
  <td>Restro</td>
  <td>Neck</td>
  <td><a href='http://aowow.org/?item=13141' ><span style='color: #4169E1'>Tooth of Gnarr</span></a></td>
  <td><a href='http://www.aowow.org/?npc=10363'>UBRS</a></td>
  <td>22,0</td>
  </tr>
    <tr>
  <td>Restro</td>
  <td>Neck</td>
  <td><a href='http://aowow.org/?item=22327' ><span style='color: #4169E1'>Amulet of the Redeemed</span></a></td>
  <td><a href='http://www.aowow.org/?object=181083'>Strath</a></td>
  <td>24,6</td>
  </tr>
    <tr>
  <td>Restro</td>
  <td>Neck</td>
  <td><a href='http://aowow.org/?item=18723' ><span style='color: #4169E1'>Animated Chain Necklace</span></a></td>
  <td><a href='http://www.aowow.org/?npc=10439'>Strath</a></td>
  <td>36,2</td>
  </tr>
    <tr>
  <td>Restro</td>
  <td>Shoulders</td>
  <td><a href='http://aowow.org/?item=22405' ><span style='color: #4169E1'>Mantle of the Scarlet Crusade</span></a></td>
  <td><a href='http://www.aowow.org/?npc=10997'>Strath</a></td>
  <td>32,4</td>
  </tr>
    <tr>
  <td>Restro</td>
  <td>Shoulders</td>
  <td><a href='http://aowow.org/?item=18757' ><span style='color: #4169E1'>Diabolic Mantle</span></a> </td>
  <td><a href='http://www.aowow.org/?npc=14506'>DM West</a></td>
  <td>35,2</td>
  </tr>
    <tr>
  <td>Restro</td>
  <td>Shoulders</td>
  <td><a href='http://aowow.org/?item=22234' ><span style='color: #4169E1'>Mantle of Lost Hope</span></a></td>
  <td><a href='http://www.aowow.org/?npc=9025'>BRD</a></td>
  <td>45,6</td>
  </tr>
    <tr>
  <td>Restro</td>
  <td>Back</td>
  <td><a href='http://aowow.org/?item=18350' ><span style='color: #00FF00'>Amplifying Cloak</span></a></td>
  <td><a href='http://www.aowow.org/?npc=11487'>DM West</a></td>
  <td>18,0</td>
  </tr>
    <tr>
  <td>Restro</td>
  <td>Back</td>
  <td><a href='http://aowow.org/?item=18389' ><span style='color: #4169E1'>Cloak of the Cosmos</span></a></td>
  <td><a href='http://www.aowow.org/?npc=11496'>DM West</a></td>
  <td>34,0</td>
  </tr>
    <tr>
  <td>Restro</td>
  <td>Back</td>
  <td><a href='http://aowow.org/?item=18510' ><span style='color: #9932CC'>Hide of the Wild</span></a></td>
  <td><a href='http://www.aowow.org/?spell=22927'>Leatherworking</a></td>
  <td>49,6</td>
  </tr>
    <tr>
  <td>Restro</td>
  <td>Chest</td>
  <td><a href='http://aowow.org/?item=940' ><span style='color: #9932CC'>Robes of Insight</span></a> </td>
  <td>World Random Drop (AH)</td>
  <td>52,8</td>
  </tr>
    <tr>
  <td>Restro</td>
  <td>Chest</td>
  <td><a href='http://aowow.org/?item=22272' ><span style='color: #4169E1'>Forest&#39;s Embrace</span><span style='color: #0000cd'></a></td>
  <td><a href='http://www.aowow.org/?quest=9053'>Quest</a></td>
  <td>61,9</td>
  </tr>
    <tr>
  <td>Restro</td>
  <td>Chest</td>
  <td><a href='http://aowow.org/?item=13346' ><span style='color: #4169E1'>Robes of the Exalted</span></a></td>
  <td><a href='http://www.aowow.org/?npc=10440'>Strath</a></td>
  <td>74,3</td>
  </tr>
    <tr>
  <td>Restro</td>
  <td>Wrist</td>
  <td><a href='http://aowow.org/?item=18497' ><span style='color: #4169E1'>Sublime Wristguards</span></a></td>
  <td><a href='http://www.aowow.org/?npc=14326'>DM North</a></td>
  <td>21,0</td>
  </tr>
    <tr>
  <td>Restro</td>
  <td>Wrist</td>
  <td><a href='http://aowow.org/?item=13208' ><span style='color: #4169E1'>Bleak Howler Armguards</span></a></td>
  <td><a href='http://www.aowow.org/?npc=10268'>LBRS</a></td>
  <td>24,0</td>
  </tr>
    <tr>
  <td>Restro</td>
  <td>Wrist</td>
  <td><a href='http://aowow.org/?item=18525' ><span style='color: #4169E1'>Bracers of Prosperity</span></a></td>
  <td><a href='http://www.aowow.org/?npc=11501'>DM North</a></td>
  <td>31,1</td>
  </tr>
    <tr>
  <td>Restro</td>
  <td>Hands</td>
  <td><a href='http://aowow.org/?item=18309' ><span style='color: #4169E1'>Gloves of Restoration</span></a></td>
  <td><a href='http://www.aowow.org/?npc=11492'>DM East</a></td>
  <td>44,4</td>
  </tr>
    <tr>
  <td>Restro</td>
  <td>Hands</td>
  <td><a href='http://aowow.org/?item=12554' ><span style='color: #4169E1'>Hands of the Exalted Herald</span></a></td>
  <td><a href='http://www.aowow.org/?npc=8929'>BRD</a></td>
  <td>44,4</td>
  </tr>
    <tr>
  <td>Restro</td>
  <td>Hands</td>
  <td><a href='http://aowow.org/?item=13258' ><span style='color: #4169E1'>Slaghide Gauntlets of Healing</span></a></td>
  <td><a href='http://www.aowow.org/?npc=10584'>LBRS</a></td>
  <td>46,0</td>
  </tr>
    <tr>
  <td>Restro</td>
  <td>Waist</td>
  <td><a href='http://aowow.org/?item=18391' ><span style='color: #4169E1'>Eyestalk Cord</span></a> <span style='color: #FFA500'></td>
  <td><a href='http://www.aowow.org/?npc=11496'>DM West</a></td>
  <td>45,8</td>
  </tr>
    <tr>
  <td>Restro</td>
  <td>Waist</td>
  <td><a href='http://aowow.org/?item=14553' ><span style='color: #9932CC'>Sash of Mercy</span></a> <span style='color: #FFA500'></td>
  <td>World Random Drop (AH)</td>
  <td>58,8</td>
  </tr>
    <tr>
  <td>Restro</td>
  <td>Waist</td>
  <td><a href='http://aowow.org/?item=18327' ><span style='color: #4169E1'>Whipvine Cord</span></a></td>
  <td><a href='http://www.aowow.org/?npc=11492'>DM East</a></td>
  <td>60,4</td>
  </tr>
    <tr>
  <td>Restro</td>
  <td>Legs</td>
  <td><a href='http://aowow.org/?item=18682' ><span style='color: #4169E1'>Ghoul Skin Leggings</span></a></td>
  <td>Scholo</td>
  <td>55,2</td>
  </tr>
    <tr>
  <td>Restro</td>
  <td>Legs</td>
  <td><a href='http://aowow.org/?item=20674' ><span style='color: #4169E1'>Abyssal Cloth Pants of Restoration</span></a></td>
  <td>Local Random Drop (AH)</td>
  <td>67,5</td>
  </tr>
    <tr>
  <td>Restro</td>
  <td>Legs</td>
  <td><a href='http://aowow.org/?item=18386' ><span style='color: #4169E1'>Padre&#39;s Trousers</span></a></td>
  <td><a href='http://www.aowow.org/?npc=11488'>DM West</a></td>
  <td>78,0</td>
  </tr>
    <tr>
  <td>Restro</td>
  <td>Feet</td>
  <td><a href='http://aowow.org/?item=18507' ><span style='color: #4169E1'>Boots of the Full Moon</span></a></td>
  <td><a href='http://www.aowow.org/?npc=14325'>DM North</a></td>
  <td>38,3</td>
  </tr>
    <tr>
  <td>Restro</td>
  <td>Feet</td>
  <td><a href='http://aowow.org/?item=22247' ><span style='color: #4169E1'>Faith Healer&#39;s Boots</span></a></td>
  <td><a href='http://aowow.org/?npc=10429'>UBRS</a></td>
  <td>38,8</td>
  </tr>
    <tr>
  <td>Restro</td>
  <td>Feet</td>
  <td><a href='http://aowow.org/?item=20652' ><span style='color: #00FF00'>Abyssal Cloth Slippers of Restoration</span></a></td>
  <td>Local Random Drop (AH)</td>
  <td>42,0</td>
  </tr>
    <tr>
  <td>Restro</td>
  <td>Ring</td>
  <td><a href='http://aowow.org/?item=18314' ><span style='color: #4169E1'>Ring of Demonic Guile</span></a></td>
  <td><a href='http://www.aowow.org/?npc=11492'>DM East</a></td>
  <td>30,0</td>
  </tr>
    <tr>
  <td>Restro</td>
  <td>Ring</td>
  <td><a href='http://aowow.org/?item=22334' ><span style='color: #4169E1'>Band of Mending</span></a></td>
  <td><a href='http://www.aowow.org/?object=181083'>Strath</a></td>
  <td>38,4</td>
  </tr>
    <tr>
  <td>Restro</td>
  <td>Ring</td>
  <td><a href='http://aowow.org/?item=16058' ><span style='color: #4169E1'>Fordring&#39;s Seal</span></a></td>
  <td><a href='http://www.aowow.org/?quest=5944'>Quest</a></td>
  <td>40,8</td>
  </tr>
    <tr>
  <td>Restro</td>
  <td>Ring</td>
  <td><a href='http://aowow.org/?item=22681' ><span style='color: #4169E1'>Band of Piety</span></a></td>
  <td><a href='http://www.aowow.org/?quest=9221'>Quest</a></td>
  <td>46,0</td>
  </tr>
    <tr>
  <td>Restro</td>
  <td>Ring</td>
  <td><a href='http://aowow.org/?item=13178' ><span style='color: #4169E1'>Rosewine Circle</span></a></td>
  <td><a href='http://www.aowow.org/?npc=10584'>LBRS</a></td>
  <td>49,0</td>
  </tr>
    <tr>
  <td>Restro</td>
  <td>Trinket</td>
  <td><a href='http://aowow.org/?item=12930' ><span style='color: #4169E1'>Briarwood Reed</span></a></td>
  <td><a href='http://www.aowow.org/?npc=10509'>UBRS</a></td>
  <td>29,0</td>
  </tr>
    <tr>
  <td>Restro</td>
  <td>Trinket</td>
  <td><a href='http://aowow.org/?item=22268' ><span style='color: #4169E1'>Draconic Infused Emblem</span></a></td>
  <td><a href='http://www.aowow.org/?npc=10363'>UBRS</a></td>
  <td>38,0</td>
  </tr>
    <tr>
  <td>Restro</td>
  <td>Trinket</td>
  <td><a href='http://aowow.org/?item=19288' ><span style='color: #9932CC'>Darkmoon Card: Blue Dragon</span></a></td>
  <td><a href='http://www.aowow.org/?quest=7907'>Quest</a></td>
  <td>40,0</td>
  </tr>
    <tr>
  <td>Restro</td>
  <td>Trinket</td>
  <td><a href='http://aowow.org/?item=18371' ><span style='color: #4169E1'>Mindtap Talisman</span></a></td>
  <td><a href='http://www.aowow.org/?npc=11487'>DM West</a></td>
  <td>44,0</td>
  </tr>
    <tr>
  <td>Restro</td>
  <td>Trinket</td>
  <td><a href='http://aowow.org/?item=18470' ><span style='color: #4169E1'>Royal Seal of Eldre&#39;Thalas</span></a></td>
  <td><a href='http://www.aowow.org/?quest=7506'>Quest</a></td>
  <td>44,0</td>
  </tr>
    <tr>
  <td>Restro</td>
  <td>2-Hand</td>
  <td><a href='http://aowow.org/?item=22394' ><span style='color: #4169E1'>Staff of Metanoia</span></a></td>
  <td><a href='http://www.aowow.org/?npc=10503'>Scholo</a></td>
  <td>48,9</td>
  </tr>
    <tr>
  <td>Restro</td>
  <td>2-Hand</td>
  <td><a href='http://aowow.org/?item=11932' ><span style='color: #4169E1'>Guiding Stave of Wisdom</span></a></td>
  <td><a href='http://www.aowow.org/?npc=9019'>BRD</a></td>
  <td>58,2</td>
  </tr>
    <tr>
  <td>Restro</td>
  <td>2-Hand</td>
  <td><a href='http://aowow.org/?item=22406' ><span style='color: #4169E1'>Redemption</span></a></td>
  <td><a href='http://www.aowow.org/?npc=10997'>Strath</a></td>
  <td>69,6</td>
  </tr>
    <tr>
  <td>Restro</td>
  <td>1-Hand</td>
  <td><a href='http://aowow.org/?item=18321' ><span style='color: #4169E1'>Energetic Rod</span></a> </td>
  <td><a href='http://www.aowow.org/?npc=11492'>DM East</a></td>
  <td>17,0</td>
  </tr>
    <tr>
  <td>Restro</td>
  <td>1-Hand</td>
  <td><a href='http://aowow.org/?item=22315' ><span style='color: #4169E1'>Hammer of Revitalization</span></a></td>
  <td><a href='http://www.aowow.org/?npc=16097'>DM East</a></td>
  <td>27,0</td>
  </tr>
    <tr>
  <td>Restro</td>
  <td>1-Hand</td>
  <td><a href='http://aowow.org/?item=11923' ><span style='color: #4169E1'>The Hammer of Grace</span></a></td>
  <td><a href='http://www.aowow.org/?npc=9476'>BRD</a></td>
  <td>31,0</td>
  </tr>
    <tr>
  <td>Restro</td>
  <td>Off-Hand</td>
  <td><a href='http://aowow.org/?item=18523' ><span style='color: #4169E1'>Brightly Glowing Stone</span></a></td>
  <td><a href='http://www.aowow.org/?npc=11501'>DM North</a></td>
  <td>38,4</td>
  </tr>
    <tr>
  <td>Restro</td>
  <td>Off-Hand</td>
  <td><a href='http://aowow.org/?item=22319' ><span style='color: #4169E1'>Tome of Divine Right</span></a></td>
  <td><a href='http://www.aowow.org/?npc=16080'>LBRS</a></td>
  <td>45,8</td>
  </tr>
    <tr>
  <td>Restro</td>
  <td>Off-Hand</td>
  <td><a href='http://aowow.org/?item=19312' ><span style='color: #9932CC'>Lei of the Lifegiver</span></a></td>
  <td><a href='http://www.aowow.org/?npc=13216'>Alterac Valley Exalted</a></td>
  <td>65,0</td>
  </tr>
    <tr>
  <td>Restro</td>
  <td>Idol</td>
  <td><a href='http://aowow.org/?item=22398' ><span style='color: #4169E1'>Idol of Rejuvenation</span></a></td>
  <td><a href='http://www.aowow.org/?npc=16080'>LBRS</a></td>
  <td>50,0</td>
  </tr>
    <tr>
  <td>Feral</td>
  <td>Head</td>
  <td><a href='http://aowow.org/?item=14539' ><span style='color: #4169E1'>Bone Ring Helm<span></a></td>
  <td><a href='http://www.aowow.org/?npc=11622'>Scholo</a></td>
  <td></td>
  </tr>
    <tr>
  <td>Feral</td>
  <td>Neck</td>
  <td><a href='http://aowow.org/?item=13177' ><span style='color: #4169E1'>Talisman of Evasion</span></a></td>
  <td><a href='http://www.aowow.org/?npc=9237'>LBRS</a></td>
  <td></td>
  </tr>
    <tr>
  <td>Feral</td>
  <td>Neck</td>
  <td><a href='http://aowow.org/?item=18381' ><span style='color: #4169E1'>Evil Eye Pendant</span></a></td>
  <td><a href='http://www.aowow.org/?npc=11496'>DM West</a></td>
  <td></td>
  </tr>
    <tr>
  <td>Feral</td>
  <td>Shoulders</td>
  <td><a href='http://aowow.org/?item=13358' ><span style='color: #4169E1'>Wyrmtongue Shoulders</span></a></td>
  <td><a href='http://www.aowow.org/?npc=10813'>Strath</a></td>
  <td></td>
  </tr>
    <tr>
  <td>Feral</td>
  <td>Shoulders</td>
  <td><a href='http://aowow.org/?item=19058' ><span style='color: #4169E1'>Golden Mantle of the Dawn</span></a></td>
  <td><a href='http://www.aowow.org/?spell=23706'>Leatherworking</a></td>
  <td></td>
  </tr>
    <tr>
  <td>Feral</td>
  <td>Back</td>
  <td><a href='http://aowow.org/?item=18413' ><span style='color: #4169E1'>Cloak of Warding</span></a></td>
  <td><a href='http://www.aowow.org/?spell=22870'>Tailoring</a></td>
  <td></td>
  </tr>
    <tr>
  <td>Feral</td>
  <td>Chest</td>
  <td><a href='http://aowow.org/?item=15064' ><span style='color: #4169E1'>Warbear Harness</span></a></td>
  <td><a href='http://www.aowow.org/?spell=19068'>Leatherworking</a></td>
  <td></td>
  </tr>
    <tr>
  <td>Feral</td>
  <td>Wrist</td>
  <td><a href='http://www.aowow.org/?item=16710'><span style='color: #4169E1'>Shadowcraft Bracers</span></a></td>
  <td></td>
  <td></td>
  </tr>
    <tr>
  <td>Feral</td>
  <td>Wrist</td>
  <td><a href='http://aowow.org/?item=22668' ><span style='color: #9932CC'>Bracers of Subterfuge</span></a></td>
  <td><a href='http://www.aowow.org/?quest=9222'>Quest</a></td>
  <td></td>
  </tr>
    <tr>
  <td>Feral</td>
  <td>Hands</td>
  <td><a href='http://aowow.org/?item=18377' ><span style='color: #4169E1'>Quickdraw Gloves</span></a></td>
  <td><a href='http://www.aowow.org/?npc=11496'>DM West</a></td>
  <td></td>
  </tr>
    <tr>
  <td>Feral</td>
  <td>Waist</td>
  <td><a href='http://www.aowow.org/?item=13962'><span style='color: #4169E1'>Vosh'gajin's Strand</span></a></td>
  <td><a href='http://aowow.org/?quest=4903' >Quest</a></td>
  <td></td>
  </tr>
    <tr>
  <td>Feral</td>
  <td>Waist</td>
  <td><a href='http://www.aowow.org/?item=20261'><span style='color: #4169E1'>Shadow Panther Hide Belt</span></a></td>
  <td>ZG</td>
  <td></td>
  </tr>
    <tr>
  <td>Feral</td>
  <td>Legs</td>
  <td><a href='http://aowow.org/?item=11821' ><span style='color: #4169E1'>Warstrife Leggings</span></a></td>
  <td><a href='http://www.aowow.org/?npc=9033'>BRD</a></td>
  <td></td>
  </tr>
    <tr>
  <td>Feral</td>
  <td>Feet</td>
  <td><a href='http://aowow.org/?item=18716' ><span style='color: #4169E1'>Ash Covered boots</span></a></td>
  <td><a href='http://www.aowow.org/?npc=10811'>Strath</a></td>
  <td></td>
  </tr>
    <tr>
  <td>Feral</td>
  <td>Ring</td>
  <td><a href='http://aowow.org/?item=11669' ><span style='color: #4169E1'>Naglering</span></a></td>
  <td><a href='http://www.aowow.org/?npc=8983'>BRD</a></td>
  <td></td>
  </tr>
    <tr>
  <td>Feral</td>
  <td>Ring</td>
  <td><a href='http://aowow.org/?item=22331' ><span style='color: #4169E1'>Band of the Steadfast Hero</span></a></td>
  <td><a href='http://www.aowow.org/?npc=16118'>Scholo</a></td>
  <td></td>
  </tr>
      <tr>
  <td>Feral</td>
  <td>Ring</td>
  <td><a href='http://aowow.org/?item=15855' ><span style='color: #4169E1'>Ring of Protection</span></a></td>
  <td><a href='http://www.aowow.org/?quest=5942'>Quest</a></td>
  <td></td>
  </tr>
      <tr>
  <td>Feral</td>
  <td>Ring</td>
  <td><a href='http://aowow.org/?item=12544' ><span style='color: #4169E1'>Thrall's Resolve</span></a></td>
  <td><a href='http://www.aowow.org/?quest=4004'>Quest</a></td>
  <td></td>
  </tr>
    <tr>
  <td>Feral</td>
  <td>Trinket</td>
  <td><a href='http://aowow.org/?item=11811' ><span style='color: #4169E1'>Smoking Heart of the Mountain</span></a></td>
  <td><a href='http://www.aowow.org/?spell=15596'>Enchanting</a></td>
  <td></td>
  </tr>
    <tr>
  <td>Feral</td>
  <td>Trinket</td>
  <td><a href='http://aowow.org/?item=13966' ><span style='color: #4169E1'>Mark of Tyranny</span></a></td>
  <td><a href='http://www.aowow.org/?quest=5102'>Quest</a></td>
  <td></td>
  </tr>
    <tr>
  <td>Feral</td>
  <td>Idol</td>
  <td><a href='http://aowow.org/?item=23198' ><span style='color: #4169E1'>Idol of Brutality</span></a></td>
  <td><a href='http://www.aowow.org/?npc=10435'>Strath</a></td>
  <td></td>
  </tr>
    <tr>
  <td>Feral</td>
  <td>2-Hand</td>
  <td><a href='http://aowow.org/?item=943' ><span style='color: #9932CC'>Warden Staff</span></a></td>
  <td>World Random Drop (AH)</td>
  <td></td>
  </tr>
<tr><td>Feral</td><td>Wrist</td><td><a href='http://aowow.org/?item=12966' ><span style='color: #4169E1'>Blackmist Armguards</span></a></td><td><a href='http://www.aowow.org/?npc=10430'>UBRS</a></td><td></td></tr>
<tr><td>Feral</td><td>Head</td><td><a href='http://aowow.org/?item=16983' ><span style='color: #9932CC'>Molten Helm</span></a></td><td><a href='http://www.aowow.org/?spell=20854'>Leatherworking</a></td><td></td></tr>
<tr><td>Feral</td><td>Neck</td><td><a href='http://aowow.org/?item=19871' ><span style='color: #4169E1'>Talisman of Protection</span></a></td><td><a href='http://www.aowow.org/?npc=14510'>ZG</a></td><td></td></tr>
<tr><td>Feral</td><td>Back</td><td><a href='http://aowow.org/?item=12551' ><span style='color: #4169E1'>Stoneshield Cloak</span></a></td><td>BRD</td><td></td></tr>
<tr><td>Feral</td><td>Back</td><td><a href='http://aowow.org/?item=19760' ><span style='color: #4169E1'>Overlord's Embrace</span></a></td><td><a href='http://database.wow-one.com/index.php?npc=11380'>ZG</a></td><td></td></tr>
<tr><td>Feral</td><td>Wrist</td><td><a href='http://aowow.org/?item=18700' ><span style='color: #4169E1'>Malefic Bracers</span></a></td><td>Scholo</td><td></td></tr>
<tr><td>Feral</td><td>Hands</td><td><a href='http://aowow.org/?item=13258' ><span style='color: #4169E1'>Slaghide Gauntlets of the Monkey</span></a></td><td><a href='http://www.aowow.org/?npc=10584'>LBRS</a></td><td></td></tr>
<tr><td>Feral</td><td>Waist</td><td><a href='http://aowow.org/?item=19163' ><span style='color: #9932CC'>Molten Belt</span></a></td><td><a href='http://www.aowow.org/?spell=23710'>Leatherworking</a></td><td></td></tr>
<tr><td>Feral</td><td>Waist</td><td><a href='http://aowow.org/?item=19149' ><span style='color: #9932CC'>Lava Belt</span></a> </td><td><a href='http://www.aowow.org/?spell=23707'>Leatherworking</a></td><td></td></tr>
<tr><td>Feral</td><td>Legs</td><td><a href='http://aowow.org/?item=19889' ><span style='color: #4169E1'>Blooddrenched Leggings</span></a> </td><td><a href='http://www.aowow.org/?npc=11380'>ZG</a></td><td></td></tr>
<tr><td>Feral</td><td>Ring</td><td><a href='http://www.aowow.org/?item=12548' ><span style='color: #4169E1'>Magni's Will</span></a> </td><td><a href='http://www.aowow.org/?quest=4363'>Quest</a></td><td></td></tr>
<tr><td>Feral</td><td>Waist</td><td><a href='http://www.aowow.org/?item=14502' ><span style='color: #4169E1'>Frostbite Girdle</span></a></td><td><a href='http://www.aowow.org/?npc=10508'>Scholo</a></td><td></td></tr>
<tr><td>Feral</td><td>Chest</td><td><a href='http://www.aowow.org/?item=12793' ><span style='color: #4169E1'>Mixologist's Tunic</span></a> </td><td><a href='http://www.aowow.org/?npc=9499'>BRD</a></td><td></td></tr>
  </tbody></table>



<br>
<h1>Restro Druid - <a href='http://www.wow-one.com/forum/topic/8775-list-of-druid-healing-gear/'>Source</a></h1>
<span class='bbc_underline'>Total stats</span><br />
The best items for each slot from the list above leave you with total +stats of 62 stam, 94 int, 34 spirit, 42mp5, 0 crit and 553 +heal.<br />
Combined with the useful +heal enchants for such gear level (i.e. 24 +heal on bracers, 55 +heal on weapon, 30 +heal on gloves, 8 +heal on head, 8 +heal on legs) you will end up with an amazing <span style='color: #ff0000'>678 +heal</span> and <span style='color: #ff0000'>42mp5</span> in total unbuffed.<br />
The maximum enchants (i.e. 24 +heal on head and legs from zg enchant instead of +8 from dm arcanum and 33 +heal on shoulders from zg exalted enchant) will increase you even to <span style='color: #ff0000'>743 +heal </span>unbuffed pre-raid.<br />
<br />
<span class='bbc_underline'>Basic assumptions</span><br />
The stats most important to a healing druid at the beginning of raiding are +heal and mp5, followed by int, spirit, crit and stam.<br />
Reasons are as follows: +heal increases your healing and makes downranking more effective, which helps to save mana. Mp5 increases mana reg and is just cheaper than spirit in terms of itemization (see my answer to <a href='http://www.wow-one.com/forum/index.php?/topic/10324-most-unusual-guide-for-pre-raid-restor-druid/' class='bbc_url' title=''>http://www.wow-one.c...d-restor-druid/</a> for details and formula). Int increases your starting mana pool, meaning its more efficient in short fights than in longer ones; also it gives crit. Spirit increases mana reg. Crit effectively increases heal, but we don’t like it yet (in a starting 5 0 46 specc), cause its wasted overheal most of the time. Stamina is basically useless for us, but we can’t heal, when we are dead.<br />
<br />
<span class='bbc_underline'>Valuation of stats</span><br />
The exact valuation and weighting of the stats is, as always, a question of taste and playing style.<br />
I calculated them in healing equivaleny points (HEP) based on the following: 1 +heal is worth 1 +heal (of course :-D); 1mp5 is worth 4 +heal; 1 int is worth 0,6 +heal; 1 spirit is worth 0,3 +heal; 1 crit is worth 7,5 +heal; and 1 stam is worth 0,2 +heal.<br />
Or, in short: +heal=1; mp5=4; int=0,6; spirit=0,3; crit=7,5; stam=0,2.<br />
<br />
<span class='bbc_underline'>Reevaluation of stats (HEP2 and HEPNAXX)</span><br />
<br />
5.1 Later, in the midgame content with 3/8 t2 bonus, the value of spirit doubles in relation to mp5. From that point on, +heal becomes even more efficient as the bigger mana pool and higher manareg decreases the importance of int and spirit/mp5. Stamina is worth nothing anymore, because you will have enough life to survive anyway.<br />
These changes are reflected best by a second value for the midgame content i call HEP2, based on a reevaluation of stats as follows:<br />
+heal=1; mp5=3; int=0,3; spirit=0,45; crit=10; stam=0.<br />
<br />
5.2 Then in the endgame content with t3 and a 24 0 27 specc, crit finally becomes more valuable, whilst spirit is cut down half again, as soon as you replace 3/8 t2 with 4/9 t3. Also, the importance of +heal rises even more because you will mostly rely on cheap low ranked healing touches now.<br />
These final changes are reflected by a third value for the endgame content i call HEPNAXX, based on another reevaluation of stats as follows:<br />
+heal=1,2; mp5=3; int=0,3; spirit=0,225; crit=12; stam=0.<br />
<br />
<br />
<br />
Thanks for the co<span style='font-size: 14px;'>nstant support, feel free t</span>o comment or pm me in case you have any questions.<br />
<br />
<br />
<span style='font-size: 14px;'>Please see the the following great threads for more background on druid healing:</span><br />
<span style='font-size: 12px;'>Resto Guide <a href='http://www.wow-one.com/forum/index.php?/topic/12549-pve-druid-restoration-guide/' class='bbc_url' title=''>http://www.wow-one.c...toration-guide/</a></span> <span style='font-size: 12px;'>(not all given information is 100% correct for feenix mechanics)</span><br />
<span style='font-size: 12px;'>Theory Craft on spirit/mp5 <a href='http://www.wow-one.com/forum/index.php?/topic/10324-most-unusual-guide-for-pre-raid-restor-druid/' class='bbc_url' title=''>http://www.wow-one.c...d-restor-druid/</a></span><br />
<span style='font-size: 12px;'>Spreadsheet for bis gear based on HEP2 <a href='http://www.wow-one.com/forum/index.php?/topic/13141-restoration-druid-gear-spreadsheet/' class='bbc_url' title=''>http://www.wow-one.c...ar-spreadsheet/</a></span>
<br /><br />
<strong class='bbc'>Enchants</strong><br />
 <br />
<em class='bbc'>Head:</em> <a href='http://aowow.org/?item=19789' >Zul'Gurub Enchant</a><br />
   alternative: <a href='http://aowow.org/?item=18330' >Arcanum of Focus</a><br />
<em class='bbc'>Shoulders:</em> <a href='http://aowow.org/?item=20078' >Zul'Gurub Exalted Enchant</a>, later <a href='http://aowow.org/?item=23547' >Sapphiron Enchant</a><br />
   alternative: <a href='http://aowow.org/?item=18182' >Argent Dawn Reputation Reward</a><br />
<em class='bbc'><span style='font-size: 14px;'>Back</span>:</em> <a href='http://aowow.org/?spell=25084' >Subtlety</a><br />
<em class='bbc'>Chest:</em> <a href='http://aowow.org/?spell=20028' >Major Mana</a> or <a href='http://aowow.org/?spell=20025' >Greater Stats</a><br />
<em class='bbc'>Bracer:</em> <a href='http://aowow.org/?spell=23802' >Healing Power</a><br />
<em class='bbc'>Hands:</em> <a href='http://aowow.org/?spell=25079' >Healing Power</a><br />
<em class='bbc'>Legs:</em> <a href='http://aowow.org/?item=19789' >Zul'Gurub Enchant</a><br />
   alternative: <a href='http://aowow.org/?item=18330' >Arcanum of Focus</a><br />
<em class='bbc'>Boots:</em> <a href='http://aowow.org/?spell=13890' >Minor Speed</a><br />
<em class='bbc'>Weapon:</em> <a href='http://aowow.org/?spell=22750' >Healing Power</a><br />
 <br />
 
 Feral Enchants:<br />
+1% Dodge to Head/Legs, +100 HP to Chest +9 Stam to Bracers, +15 Agi to gloves, +7 stam for boots, +25 agi to staff +70 armor cloak<br />
 <br />
I would always prefer Speed on Boots to the other enchants, the stat increase is just too small to keep up with walking speed increase for better movement.<br />
 <br />
<strong class='bbc'>Consumables</strong><br />
 <br />
Consumables are very important for vanilla raiding, even if it can take a lot of time to farm them all. If you want to be a successful raider, you will have to work for it.<br />
 <br />
Buff Potions:<br />
<a href='http://aowow.org/?spell=17636' >Flask of distilled Wisdom</a><br />
<a href='http://aowow.org/?spell=17555' > Elixir of the Sages</a><br />
<a href='http://aowow.org/?spell=24365' >Mageblood Potion</a><br />
<a href='http://aowow.org/?item=9179' >Elixir of Greater Intellect</a><br />
<a href='http://aowow.org/?item=21151' >Rumsey Rum Black Label</a><br />
 <br />
Buff Food:<br />
<a href='http://aowow.org/?spell=25954' >Sagefish Delight</a><br />
 <br />
Temporary Weapon Buff:<br />
<a href='http://aowow.org/?spell=25130' >Brilliant Mana Oil</a><br />
 <br />
Mana Potions:<br />
<a href='http://aowow.org/?spell=17580' >Major Mana Potion</a><br />
<a href='http://aowow.org/?item=11952#objective-of' >Night Dragon's Breath</a><br />
<a href='http://aowow.org/?item=20520' >Dark Rune</a><br />
 <br />
If you want to buff yourself to the max, farm/buy also<br />
<a href='http://aowow.org/?item=11563#reward-of' >Crystal Force</a><br />
<a href='http://aowow.org/?item=10308' >Scroll of Intellect IV</a><br />
<a href='http://aowow.org/?item=10307' >Scroll of Stamina IV</a><br />
<a href='http://aowow.org/?item=10306' >Scroll of Spirit IV</a><br />
 <br />
<br /><br />
<h1>Feral Druid - <a href='http://www.wow-one.com/forum/topic/12719-feral-tank-bis-pre-raid/'>Source</a></h1>
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
