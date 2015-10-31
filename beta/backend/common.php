<?php
define('IN_PHPBB', true);
define('LGW_COMMON', true);
  $phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : '/home/SOME_PATH/www/forums/';
  $phpbb_admin_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : '/home/SOME_PATH/www//forums/';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include_once($phpbb_root_path . 'common.' . $phpEx);
include_once($phpbb_root_path . 'includes/functions_posting.' . $phpEx);
include_once($phpbb_root_path . 'includes/functions_display.' . $phpEx);
include_once($phpbb_root_path . 'includes/functions_user.' . $phpEx);
include_once($phpbb_root_path . 'includes/message_parser.' . $phpEx);
include_once($phpbb_root_path . 'includes/functions_profile_fields.' . $phpEx);



class Common {
  const guildName = "lets get weird";
  const sqlServer = "localhost";
  const sqlDB = "DB_USER";
  const sqlUser = "DB_USER";
  const sqlPass = "DB_PASS";
  const docRoot = "/home/SOME_PATH/www/beta/";
  const aowowURL = 'http://aowow.org/';
  
  public $bankerList = array('Goonblues','Goonherbs','Goonleather','Goonmetal','Goonquest','Goonshards','Goonwife','Goonrecipies','Goonrandom','Gooncloth');
  
  public $qualityList = array('Poor','Common','Uncommon','Rare','Epic','Legendary','Artifact');
  public $levelRanges = array("1-9"=>array('start'=>0,'end'=>9),
            "10-19"=>array('start'=>10,'end'=>19),
            "20-29"=>array('start'=>20,'end'=>29),
            "30-39"=>array('start'=>29,'end'=>39),
            "40-49"=>array('start'=>39,'end'=>49),
            "50-59"=>array('start'=>50,'end'=>59),
            "60+"=>array('start'=>60,'end'=>9999));
  public $inventoryType = array();
  public $subClass = array();
  
  public $classes = array("Warrior","Rogue","Druid","Mage","Warlock","Hunter","Priest","Paladin");
  public $classColors = array("Warrior"=>"C79C6E","Rogue"=>"FFF569","Druid"=>"FF7D0A","Mage"=>"69CCF0","Warlock"=>"9482C9","Hunter"=>"ABD473","Priest"=>"FFFFFF","Paladin"=>"F58CBA");

  private $realUserData = null;
  private $userSID = null;
  
  private $db = null;
  private $rainbow = array('#ff0000', '#ff3300', '#ff6600', '#ff9900', '#ffcc00', '#ffff00', '#ccff00', '#99ff00', '#66ff00', '#33ff00', '#00ff00', '#00ff33', '#00ff66', '#00ff99', '#00ffcc', '#00ffff', '#00ccff', '#0099ff', '#0066ff', '#0033ff', '#0000ff', '#3300ff', '#6600ff', '#9900ff', '#cc00ff', '#ff00ff', '#ff00cc', '#ff0099', '#ff0066', '#ff0033'); 

  
  function __construct() {
    global $user, $auth;
    $this->db = new mysqli(self::sqlServer,self::sqlUser ,self::sqlPass ,self::sqlDB );
    if (mysqli_connect_errno($this->db)) {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    $this->setupItemData();
    // Start session management
    $user->session_begin();
    $auth->acl($user->data);
    $user->setup();
    $this->userSID = $user->session_id;
 }
 
 function __destruct() {

  
  $this->db->close();
  // Revert data from logged on user
  $this->revertForumsUser();

 }
 
  function query($query, $flags=MYSQLI_STORE_RESULT) {
    return $this->db->query($query, $flags);
  }
 
 function loginForumsAdmin() {
  global $user, $auth, $db;
   // Keep this, as we now overwrite this with the user of our choice
  $this->realUserData = $user-> data;

  $sql = 'SELECT u.* FROM '. USERS_TABLE. ' u WHERE u.user_id= 2';  // Your account of choice
  $result= $db-> sql_query( $sql );
  if( $row= $db-> sql_fetchrow( $result ) ) {
      // Only overwrite Keys which actually exist, no other ones
      foreach( $row as $k1=> $v1 ) if( isset( $user-> data[$k1] ) ) $user-> data[$k1]= $v1;
  };
  $db-> sql_freeresult( $result );
  $auth-> acl( $user->data );  // Also take permissions of the new account
  $user->setup('common');
 }
 
 function revertForumsUser() {
  global $user, $auth;
  if ($this->realUserData != null) {
    $user->data = $this->realUserData;
    $auth->acl($user->data);
    $user->setup('common');
    $this->realUserData = null;
  }
 }
 
 function getSID() {
  global $user;
  return $user->session_id;
 
 }
 
 function getRealUserData() {
  return $this->realUserData;
 }

 function isForumAdmin() {
  global $user;
  $currentUser = null;
  if ($this->realUserData != null) {
    $currentUser = $this->realUserData;
  } else {
    $currentUser = $user;
  }
  // return print_r($user);
  if ($this->isLoggedIn()) {  
    return (group_memberships(8,$currentUser->data['user_id'], true) || group_memberships(9,$currentUser->data['user_id'], true));
  } else {
    return false;
  }
 }
 
 function isLoggedIn() {
  global $user;
  $currentUser = null;
  if ($this->realUserData != null) {
    $currentUser = $this->realUserData;
  } else {
    $currentUser = $user;
  }
  
  return (($currentUser != null) && ($currentUser->data['user_id'] != ANONYMOUS));
 }
 
 function getLastUpdated($isFormatted = true) {
  $query = 'SELECT lastUpdated FROM information';
  
  $result = $this->query($query);
  list($lastUpdated) = $result->fetch_row();
  if ($isFormatted)
    return date(" F j, Y @ g:i a ", strtotime($lastUpdated));
  return $lastUpdated;
 }
 function getMemberNamesJS() {  
  $output = "var memberNames = [";
  $query = 'SELECT name FROM members ORDER BY name ASC';
  $result = $this->query($query, MYSQLI_STORE_RESULT);  
  while(list($name) = $result->fetch_row()) {
    $output .= "'".$name."',";
  }
  $output = substr($output, 0, -1);
  $output .= "];";
  return $output;
 }
 
 function getWowName() {
  if ($this->isLoggedIn()) {
    $cp = new custom_profile();
    $profile_fields = $cp->generate_profile_fields_template('grab', $user->data['user_id']);
    $profile_fields = (isset($profile_fields[$user->data['user_id']])) ? $cp->generate_profile_fields_template('show', false, $profile_fields[$user->data['user_id']]) : array();
    
    if (isset($profile_fields['row']['PROFILE_WOW_CHARACTER_VALUE'])) {
      return $profile_fields['row']['PROFILE_WOW_CHARACTER_VALUE'];
    }
  }
  return "";
 }
 function outputCommonJS() {
  $output = "<script>\r\n";
  if (isset($_GET['debug'])) {
    $output .= "window.debug = true;\r\n";
  } else {
    $output .= "window.debug = false;\r\n";
  }
  $output .= "window.loggedIn = ";
  if ($this->isLoggedIn()) {
    $output .= "true;\r\n";
  } else {
    $output .= "false;\r\n";
  }
  $output .= "window.wowName = '".$this->getWowName()."';\r\n";
  $output .= "window.SID = '".$this->getSID()."';\r\n";
  $output .= "window.lastUpdated = '".$this->getLastUpdated(false)."';\r\n";
  $output .= "</script>";
  return $output;
 }
 
 function outputMenu() {
  if (isset($_GET['forceDesktop'])) {
    ?>
    <a target="_self" href="http://DOMAIN/?forceDesktop=1">Bank</a> - <a target="_self" href="http://DOMAIN/users.php?forceDesktop=1">Members</a> - <a target="_self" href="http://DOMAIN/forums/index.php?&mobile=desktop">Forums</a> - <a target="_self" href="http://DOMAIN/admin.php">Admin</a>  - <a target="_self" href="http://DOMAIN/lhcp.php?forceDesktop=1">LHCP</a> - <a target="_self" href="http://DOMAIN/mobile.php" onClick="_gaq.push(['_trackEvent', 'Site Display Change', 'Desktop-to-Mobile', 'Bank - Force Desktop', 1, true]);">Mobile</a><?php if ($this->isLoggedIn()) { echo ' - <a id="loginLink" onClick="doLogout();" href="javascript:void(0)">Logout</a>';} else { echo " - <a id='loginLink' href='javascript:void(0)' onClick='openLoginForm();'>Log in</a>";} ?>
    <?php
    } else {
    ?>
    <a target="_self" href="http://DOMAIN/">Bank</a> - <a target="_self" href="http://DOMAIN/forums">Forums</a> - <a target="_self" href="http://DOMAIN/admin.php">Admin</a> - <a target="_self" href="http://DOMAIN/lhcp.php">LHCP</a> - <a target="_self" href="http://DOMAIN/mobile.php"  onClick="_gaq.push(['_trackEvent', 'Site Display Change', 'Desktop-to-Mobile', 'Bank', 1, true]);">Mobile</a>
    <?php if ($this->isLoggedIn()) { echo ' - <a id="loginLink" onClick="doLogout();" href="javascript:void(0)">Logout</a>';} else { echo " - <a id='loginLink' href='javascript:void(0)' onClick='openLoginForm();'>Log in</a>";} ?>
    <?php
  }
 
 }
 
 function outputGreeting() {
  if ($this->isLoggedIn()) {
  ?>
  <h1 id="userNameHeading" style="text-align:center;">
  <?php
    echo 'Hi <span id="forumName">' . ucfirst(strtolower($user->data['username_clean']))."</span>!";
  } else {
  ?>
  <h1 id="userNameHeading" style="text-align:center;display:none;">
  <?php
  }
 }
 
 function outputDialogs() {
  ?>
  <div id="login-form" title="Log In">
    <form>
    <fieldset>
      <h3 style='text-align:left;'>Log in using forum account:</h3>
      <div class="ui-widget">
      <label for="forumName">Name:</label>
      <input type="text" name="forumName" id="forumName" class="text ui-widget-content ui-corner-all" />
      </div>
      <label for="password">Password:</label>
      <input type="password" name="password" id="password" value="" class="text ui-widget-content ui-corner-all" /></br>
    </fieldset>
    </form>
    </br>
    <div id="loginStatus" style='display:none;'>  </div>
  </div>
  <?php
 }
 
 function real_escape_string($str) {
  return $this->db->real_escape_string($str);
 }
 
 function mysqli_affected_rows() {
  return $this->db->affected_rows;
 }
 
 function queryMotd() {
  $query = 'SELECT motd FROM information WHERE id=1';
  $result = $this->query($query, MYSQLI_STORE_RESULT);  
  list($motd) = $result->fetch_row();
  return $motd;
 }
 function getMotd($mobile = false) {
  $motd = $this->queryMotd();
  if (!$mobile) { 
    return "<div id='motdDisplayDiv' style='background-color:#222;width:80%;margin: auto;padding:5px;text-align:center;'><h3 style='color:#FFF;'>MOTD: $motd</h3></div>";
  } else {
    return '<div class="ui-bar ui-bar-e"><h3>MOTD: '.$motd.'</h3></div>';
  }
 }
 function getMotdLight($mobile = false) {
  $motd = $this->queryMotd();
  if (!$mobile) { 
    return "<div style='background-color:#DDD;width:80%;margin: auto;padding:5px;text-align:center;'><h3 style='color:#222;'>MOTD: $motd</h3></div>";
  } else {
    return '<div class="ui-bar ui-bar-b"><h3>MOTD: '.$motd.'</h3></div>';
  }
 }
 function makeFabulous($text) {
  $rainbowText = "";
  //split message into array of single letters 
  $textArray = str_split($text);
  $i = 0; //$i will keep count of which color in $rainbow we're up to 
  $max = count($this->rainbow); //the total number of colors in $rainbow
  //loop through $messagearr 
  foreach ($textArray as $letter) { 
    //if character isn't a space, assign color and add to $rainbowmsg: 
    if ($letter != " ") { 
   	  $rainbowText .= "<font color=\"".$this->rainbow[$i]."\">$letter</font>"; 
    } 
    //else add a space to $rainbowmsg: 
    else { $rainbowText .= " "; } 
    //+1 to $i (so that the next loop uses the next color in $colorarr): 
    $i++; 
    //if we've reached the end of $colorarr, set $i to zero to start again: 
    if ($i == $max) { $i = 0; } 
  } //(end foreach loop)
  return $rainbowText;
 }
 
 function setupItemData() {
    $this->inventoryType[0] = "Non equipable";
    $this->inventoryType[1] = "Head";
    $this->inventoryType[2] = "Neck";
    $this->inventoryType[3] = "Shoulder";
    $this->inventoryType[4] = "Shirt";
    $this->inventoryType[5] = "Chest";
    $this->inventoryType[6] = "Waist";
    $this->inventoryType[7] = "Legs";
    $this->inventoryType[8] = "Feet";
    $this->inventoryType[9] = "Wrists";
    $this->inventoryType[10] = "Hands";
    $this->inventoryType[11] = "Finger";
    $this->inventoryType[12] = "Trinket";
    $this->inventoryType[13] = "Weapon";
    $this->inventoryType[14] = "Shield";
    $this->inventoryType[15] = "Ranged";
    $this->inventoryType[16] = "Back";
    $this->inventoryType[17] = "Two-Hand";
    $this->inventoryType[18] = "Bag";
    $this->inventoryType[19] = "Tabard";
    $this->inventoryType[20] = "Robe";
    $this->inventoryType[21] = "Main hand";
    $this->inventoryType[22] = "Off hand";
    $this->inventoryType[23] = "Holdable (Tome)";
    $this->inventoryType[24] = "Ammo";
    $this->inventoryType[25] = "Thrown";
    $this->inventoryType[26] = "Ranged right";
    $this->inventoryType[27] = "Quiver";
    $this->inventoryType[28] = "Quiver";

    $this->subClass[0][0] = "Consumable";
    $this->subClass[0][1] = "Potion";
    $this->subClass[0][2] = "Elixir";
    $this->subClass[0][3] = "Flask";
    $this->subClass[0][4] = "Scroll";
    $this->subClass[0][5] = "Food & Drink";
    $this->subClass[0][6] = "Item Enhancement	";
    $this->subClass[0][7] = "Bandage";
    $this->subClass[0][8] = "Other";
    $this->subClass[1][0] = "Bag";
    $this->subClass[1][1] = "Soul Bag";
    $this->subClass[1][2] = "Herb Bag";
    $this->subClass[1][3] = "Enchanting Bag";
    $this->subClass[1][4] = "Engineering Bag";
    $this->subClass[1][5] = "Gem Bag";
    $this->subClass[1][6] = "Mining Bag";
    $this->subClass[1][7] = "Leatherworking Bag";
    $this->subClass[2][0] = "Axe";
    $this->subClass[2][1] = "Axe";
    $this->subClass[2][2] = "Bow";
    $this->subClass[2][3] = "Gun";
    $this->subClass[2][4] = "Mace";
    $this->subClass[2][5] = "Mace";
    $this->subClass[2][6] = "Polearm";
    $this->subClass[2][7] = "Sword";
    $this->subClass[2][8] = "Sword";
    $this->subClass[2][9] = "Obsolete";
    $this->subClass[2][10] = "Staff";
    $this->subClass[2][11] = "Exotic";
    $this->subClass[2][12] = "Exotic";
    $this->subClass[2][13] = "Fist Weapon";
    $this->subClass[2][14] = "Miscellaneous";
    $this->subClass[2][15] = "Dagger";
    $this->subClass[2][16] = "Thrown";
    $this->subClass[2][17] = "Spear";
    $this->subClass[2][18] = "Crossbow";
    $this->subClass[2][19] = "Wand";
    $this->subClass[2][20] = "Fishing Pole";
    $this->subClass[3][1] = "Red";
    $this->subClass[3][2] = "Blue";
    $this->subClass[3][3] = "Yellow";
    $this->subClass[3][4] = "Purple";
    $this->subClass[3][5] = "Green";
    $this->subClass[3][6] = "Orange";
    $this->subClass[3][7] = "Meta";
    $this->subClass[3][8] = "Simple";
    $this->subClass[3][9] = "Prismatic";
    $this->subClass[4][0] = "Miscellaneous";
    $this->subClass[4][1] = "Cloth";
    $this->subClass[4][2] = "Leather";
    $this->subClass[4][3] = "Mail";
    $this->subClass[4][4] = "Plate";
    $this->subClass[4][5] = "Buckler(OBSOLETE)";
    $this->subClass[4][6] = "Shield";
    $this->subClass[4][7] = "Libram";
    $this->subClass[4][8] = "Idol";
    $this->subClass[4][9] = "Totem";
    $this->subClass[5][0] = "Reagent";
    $this->subClass[6][0] = "Wand";
    $this->subClass[6][1] = "Bolt";
    $this->subClass[6][2] = "Arrow";
    $this->subClass[6][3] = "Bullet";
    $this->subClass[6][4] = "Thrown";
    $this->subClass[7][0] = "Trade Goods";
    $this->subClass[7][1] = "Parts";
    $this->subClass[7][2] = "Explosives";
    $this->subClass[7][3] = "Devices";
    $this->subClass[7][4] = "Jewelcrafting";
    $this->subClass[7][5] = "Cloth";
    $this->subClass[7][6] = "Leather";
    $this->subClass[7][7] = "Metal & Stone";
    $this->subClass[7][8] = "Meat";
    $this->subClass[7][9] = "Herb";
    $this->subClass[7][10] = "Elemental";
    $this->subClass[7][11] = "Other";
    $this->subClass[7][12] = "Enchanting";
    $this->subClass[8][0] = "Generic";
    $this->subClass[9][0] = "Book";
    $this->subClass[9][1] = "Leatherworking";
    $this->subClass[9][2] = "Tailoring";
    $this->subClass[9][3] = "Engineering";
    $this->subClass[9][4] = "Blacksmithing";
    $this->subClass[9][5] = "Cooking";
    $this->subClass[9][6] = "Alchemy";
    $this->subClass[9][7] = "First Aid";
    $this->subClass[9][8] = "Enchanting";
    $this->subClass[9][9] = "Fishing";
    $this->subClass[9][10] = "Jewelcrafting";
    $this->subClass[10][0] = "Money";
    $this->subClass[11][0] = "Quiver";
    $this->subClass[11][1] = "Quiver";
    $this->subClass[11][2] = "Quiver";
    $this->subClass[11][3] = "Ammo Pouch";
    $this->subClass[12][0] = "Quest";
    $this->subClass[13][0] = "Key";
    $this->subClass[13][1] = "Lockpick";
    $this->subClass[14][0] = "Permanent";
    $this->subClass[15][0] = "Junk";
    $this->subClass[15][1] = "Reagent";
    $this->subClass[15][2] = "Pet";
    $this->subClass[15][3] = "Holiday";
    $this->subClass[15][4] = "Other";
    $this->subClass[15][5] = "Mount";
 }
}

?>
