<?php
$docRoot = "/home/SOME_PATH/www/beta/";

// include_once($docRoot.'backend/Mobile_Detect.php');
include_once($docRoot."backend/common.php");
$common = new Common();
// $detect = new Mobile_Detect();
// if ($detect->isMobile() && !isset($_GET['forceDesktop'])) {
  // exit();
// }
$filename = '/home/SOME_PATH/www/lhcp/LHCP_pkg.lua';

$output = <<<EOQ
local dir = "Interface\\AddOns\\LHCP_Mudabu\\"

if not LeeroyHillCatsPower_data
  or type(LeeroyHillCatsPower_data) ~= "table" then
	LeeroyHillCatsPower_data = {};
end
\r\n
\r\n
\r\n
\r\n
EOQ;

$query = "SELECT * from lhcp ORDER BY cmd ASC";
$result = $common->query($query);

while(list($id, $cmd, $lhcp_text, $alliance, $horde, $msg, $emote, $file, $category, $sub_category) = $result->fetch_row()) {
$output .= <<<EOQ
LeeroyHillCatsPower_data["$cmd"] = {
	["text"]              =   "$lhcp_text",
	["AllianceEnemyText"] =   "$alliance",
	["HordeEnemyText"]    =   "$horde",
	["msg"]               =   "$msg",
	["emote"]             =   "$emote",
	["file"]              =   dir.."$file",
	["category"]          =   "$category",
	["subcategory"]       =   "$sub_category",  
};
\r\n
\r\n
EOQ;


}



// Let's make sure the file exists and is writable first.
if (is_writable($filename)) {
    if (!$handle = fopen($filename, 'w')) {
         echo "Cannot open file ($filename)";
         exit;
    }

    // Write $somecontent to our opened file.
    if (fwrite($handle, $output) === FALSE) {
        echo "Cannot write to file ($filename)";
        exit;
    }


    fclose($handle);

} else {
    echo "The file $filename is not writable";
}

function input() {
  $maxLengths = array();
  $maxValues = array();
  if ($fileData = file_get_contents('/home/SOME_PATH/www/beta/lhcpSeedData.lua', true)) {
    $lhcpData = makePhpArray($fileData);
    echo "<pre>";
    // print_r($lhcpData);
    echo "</pre>";
    foreach ($lhcpData as $cmd => $entry) {
      $cmd = $common->real_escape_string($cmd);
      $lhcp_text = $common->real_escape_string($entry['text']);
      $alliance = "";
      $horde = "";
      $msg = $common->real_escape_string($entry['msg']);
      $emote = $common->real_escape_string($entry['emote']);
      $file = $common->real_escape_string(str_replace("dir..\"", "", $entry['file']));
      $emote = $common->real_escape_string($entry['emote']);
      $category = "";
      $sub_category = "";
      $query = "INSERT INTO lhcp (id, cmd, lhcp_text, alliance, horde, msg, emote, file, category, sub_category) VALUES ".
                          "(NULL, '$cmd', '$lhcp_text', '$alliance', '$horde', '$msg', '$emote', '$file', '$category', '$sub_category');";
      print $query."<br>";
      $result = $common->query($query);

        
      
    }
    echo "<hr><hr><hr><pre>";
    // print_r($maxLengths);
    // print_r($maxValues);
    echo "</pre>";
  }
}

      
      
      
function trimval($str) {
  $str = trim($str);
  if (substr($str,0,1)=="\""){
    
    $str  = trim(substr($str,1,strlen($str)));
  }
  if (substr($str,-1,1)==","){
    $str  = trim(substr($str,0,strlen($str)-1));
  }

  if (substr($str,-1,1)=="\""){
    $str  = trim(substr($str,0,strlen($str)-1));
  }
  
  if ($str =='false') 
  {
    $str = false;
  }
  if ($str =='true') 
  {
    $str = true;
  }
  
  return $str;
}

/*
  function array_id(string)
  
  extracts the Key-Value for array indexing 
  String-Example:
    Input: ["Key"]
    Output: Key    
  Int-Example:
    Input: [0]
    Output: 0    
*/
function array_id($str) {
  $id1 = sscanf($str, "[%d]");  
  if (strlen($id1[0])>0){
    return $id1[0];    
  }
  else
  {
    if (substr($str,0,1)=="[")
    {
      $str  = substr($str,1,strlen($str));
    }
    if (substr($str,0,1)=="\"")
    {
      $str  = substr($str,1,strlen($str));
    }
    if (substr($str,-1,1)=="]")
    {
      $str  = substr($str,0,strlen($str)-1);
    }
    if (substr($str,-1,1)=="\"")
    {
      $str  = substr($str,0,strlen($str)-1);
    }
    return $str;
  } 
}

/*
  function luaparser(array, arrayStartIndex)
  
  recursive Function - it does the main work
*/
function luaparser($lua, &$pos) {
  $parray = array();
  $stop = false;
  if ($pos < count($lua)) 
  {
    for ($i = $pos;$stop ==false;)
    {
      if ($i >= count($lua)) { $stop=true;}
      $strs = @explode("=",utf8_decode($lua[$i]));
      if (@trim($strs[1]) == "{"){
        $i++;
        $parray[array_id(trim($strs[0]))]=luaparser($lua, $i);
      } 
      else if (trim($strs[0]) == "}" || trim($strs[0]) == "},")
      {
        //$i--;
        $i++;
        $stop = true;
      }
      else
      {
        $i++;
        if (strlen(array_id(trim($strs[0])))>0 && strlen($strs[1])>0) 
        {
          $parray[array_id(trim($strs[0]))]=trimval($strs[1]);
        }
      } 
    }
  }
  $pos=$i;
  return $parray;
}

/*
  function makePhpArray($input)
  
  thst the thing to call :-)
  
  $input can be 
    - an array with the lines of the LuaFile
    - a String with the whole LuaFile
    - a Filename
  
*/
function makePhpArray($input) {
  $start = 0;
  if (is_array($input))
  {    
    return luaparser($input,$start);
  } 
  elseif (is_string($input))
  {
    if (@is_file ( $input ))
    {
      return luaparser(file($input),$start);
    }
    else
    {
      return luaparser(explode("\n",$input),$start);
    }
  }  
}
