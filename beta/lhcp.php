<?php
$docRoot = "/home/SOME_PATH/www/beta/";

// include_once($docRoot.'backend/Mobile_Detect.php');
include_once($docRoot."backend/common.php");
$common = new Common();
// $detect = new Mobile_Detect();
// if ($detect->isMobile() && !isset($_GET['forceDesktop'])) {
  // exit();
// }


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
  <link rel="stylesheet" href="./css/mp3-player-button.css" />
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


	<script type="text/javascript" src="/js/power.js"></script>
  <?php include_once($docRoot."backend/analyticstracking.php") ?>
	<script src="/js/jquery-1.9.1.js"></script>
  <script src="/js/jquery.md5.min.js"></script>
  <script src="/js/jquery-ui-1.10.1.custom.min.js"></script>  
  <script src="/js/jquery.tablesorter.js"></script>	
	<script src="/js/jquery.tablesorter.widgets.js"></script>	
  <script src="./js/jquery.jeditable.mini.js"></script>	
  <script src="./js/soundmanager2-jsmin.js"></script>	
  <script src="./js/mp3-player-button.js"></script>	
  <script src="./js/loginFunctions.js"></script>	
  <script>
    $(document).ready(function() {
      $("#lhcp_queue_table").tablesorter({
        cssInfoBlock : "tablesorter-no-sort", 		
        widgets: ['zebra', 'stickyHeaders', 'filter']   
      });
      $("#lhcp_table").tablesorter({
        cssInfoBlock : "tablesorter-no-sort", 		
        widgets: ['zebra', 'stickyHeaders', 'filter']   
      });
      
       $('.edit').editable('/beta/backend/lhcp_save.php', {placeholder : "-"});
       $('.edit-category').editable('/beta/backend/lhcp_save.php', {
        data   : " {'Internet':'Internet','Misc':'Misc','Movies/TV':'Movies/TV','Music':'Music'}",
        placeholder : "-",
        type   : 'select',
        submit : 'OK'
       });
      // $('.edit-sub_category').editable('/beta/backend/lhcp_save.php', {
        // data   : " {'Music':'Music'}",
        // placeholder : "-"
      // });
      soundManager.setup({
        // required: path to directory containing SM2 SWF files
        url: 'http://DOMAIN/beta/backend/swf/',
        debugMode: false
      });

    });

  </script>
</head>
</head> 
<body> 
<div id="page">
<h1 style="text-align:center;background-color: #333;">
<?php echo $common->makeFabulous("<".$common::guildName."> - LHCP");?>
</h1>

<h3 style="text-align:center;background-color: #333;">
<?php
if (isset($_GET['forceDesktop'])) {
?>
<a target="_self" href="http://DOMAIN/index.php?forceDesktop=1">Bank</a> - <a target="_self" href="http://DOMAIN/users.php?forceDesktop=1">Members</a> - <a target="_self" href="http://DOMAIN/forums/index.php?&mobile=desktop">Forums</a> - <a target="_self" href="http://DOMAIN/admin.php">Admin</a> - <a target="_self" href="http://DOMAIN/mobile.php" onClick="_gaq.push(['_trackEvent', 'Site Display Change', 'Desktop-to-Mobile', 'Bank - Force Desktop', 1, true]);">Mobile</a><?php if ($common->isLoggedIn()) { echo ' - <a id="loginLink" onClick="doLogout();" href="javascript:void(0)">Logout</a>';} else { echo " - <a id='loginLink' href='javascript:void(0)' onClick='openLoginForm();'>Log in</a>";} ?>
<?php
} else {
?>
<a target="_self" href="http://DOMAIN/index.php">Bank</a> - <a target="_self" href="http://DOMAIN/users.php">Members</a> - <a target="_self" href="http://DOMAIN/forums">Forums</a> - <a target="_self" href="http://DOMAIN/admin.php">Admin</a> - <a target="_self" href="http://DOMAIN/mobile.php"  onClick="_gaq.push(['_trackEvent', 'Site Display Change', 'Desktop-to-Mobile', 'Bank', 1, true]);">Mobile</a>
<?php if ($common->isLoggedIn()) { echo ' - <a id="loginLink" onClick="doLogout();" href="javascript:void(0)">Logout</a>';} else { echo " - <a id='loginLink' href='javascript:void(0)' onClick='openLoginForm();'>Log in</a>";} ?>
<?php
}
?>
</h3>
<br>
<?php echo $common->getMotd();?>
<br>
<div id="main-content">

<br>

<?php 
$common->outputGreeting();
?>
</h1>
<br>

<br><br>
  <h1>Upload Queue</h1>
  <table class="tablesorter" id="lhcp_queue_table">
	<thead>	
  <tr>    
    <th>Command</th>
	  <th>Text</th>
		<th>Message</th>		
    <th>Emote</th>	
    <th class="filter-select">Category</th>
    <th class="filter-false">Approve</th>	
	</tr>
	</thead>
  <tbody>
  <tr>
    <td>Test</td>
    <td>Test</td>
    <td>Test</td>
    <td>Test</td>
    <td>Test</td>
    <td><button id='1-done' class='doneBtn'>Approve</button></td>
  </tr>
  </tbody>
  </table>
  <br><br>
  <h1>Current Data</h1>
	<table class="tablesorter" id="lhcp_table">
	<thead>	
  <tr>    
    <th>Command</th>
	  <th>Text</th>
		<th>Message</th>		
    <th>Emote</th>	
    <th class="filter-select">Category</th>
    <th class="filter-false">Play</th>
	</tr>
	</thead>
  <tbody>
<?php
  $audioDir = "/home/SOME_PATH/www/lhcp/audio/";
  $fileNames = array();
  if ($handle = opendir($audioDir)) {
      while (false !== ($entry = readdir($handle))) {
          if ($entry != "." && $entry != "..") {
            $baseName = pathinfo($audioDir.$entry, PATHINFO_FILENAME); // outputs html
              $fileNames[$baseName] = $entry;
              // echo "$entry\n";
          }
      }
      closedir($handle);
  }
  // echo "<pre>";
  // print_r($fileNames);
  // echo "</pre>";
  $query = "SELECT * from lhcp ORDER BY cmd ASC";
  $result = $common->query($query);
  
	while(list($id, $cmd, $lhcp_text, $alliance, $horde, $msg, $emote, $file, $category, $sub_category) = $result->fetch_row()) {
    $o .= "<tr>";
    $o .= "<td><div class='edit' id='$id-cmd'>$cmd</div></td>";
    $o .= "<td><div class='edit' id='$id-lhcp_text'>$lhcp_text</div></td>";
    $o .= "<td><div class='edit' id='$id-msg'>$msg</div></td>";
    $o .= "<td><div class='edit' id='$id-emote'>$emote</div></td>";
    // $o .= "<td>$file</td>";
    $o .= "<td><div class='edit-category' id='$id-category'>$category</div></td>";
    // $o .= "<td><div class='edit-sub_category' id='$id-sub_category'>$sub_category</div></td>";
    // $o .= "<td><button id='$id-play' class='playBtn' onClick='$file '>Play</button></td>"
    $o .= "<td><a href='http://DOMAIN/lhcp/audio/".$fileNames[$file]."' title='Play &quot;$cmd&quot;' class='sm2_button'>$cmd</a></td>";
    $o .= "</tr>";
	}


	echo $o;
?>
</tbody>
</table>
<br><br>

</div>
</div>
<div id="floatingLink" style='background-color:#000; left:0; position:fixed; text-align:center; bottom:0; width:100%;'>
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
<?php $common->outputDialog(); ?>
</body>
</html>

<?php
function getLastUpdated($banker, $common) {
 $query = "SELECT lastUpdated from bankitems WHERE banker='$banker' ORDER BY lastupdated DESC LIMIT 1";
	$result = $common->query($query);
  list($lastUpdated) = $result->fetch_row();
  return date(" F j, Y @ g:i a ", strtotime($lastUpdated));
}
?>
