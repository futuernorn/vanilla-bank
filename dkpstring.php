<?php

if ($fileData = file_get_contents("CT_RaidTracker.lua", true)) {
	$rtRaidData = makePhpArray($fileData);
	foreach($rtRaidData['CT_RaidTracker_RaidLog'] as $key => $raidData) {
		echo "<pre>";
		print_r($raidData);
		echo "</pre>";	
	
	}
	// echo "<pre>";
	// print_r($rtRaidData['CT_RaidTracker_RaidLog']);
	// echo "</pre>";
	// local race, class, level;
	// local link = "<RaidInfo>";
	// if(CT_RaidTracker_Options["OldFormat"] == 1) then
		// link = link.."<key>"..CT_RaidTracker_RaidLog[id]["key"].."</key>";
	// end
	// if(CT_RaidTracker_Options["OldFormat"] == 0) then
		// link = link.."<start>"..CT_RaidTracker_GetTime(CT_RaidTracker_RaidLog[id]["key"]).."</start>";
	// else
		// link = link.."<start>"..CT_RaidTracker_RaidLog[id]["key"].."</start>";
	// end
	
	// if(CT_RaidTracker_RaidLog[id]["End"]) then
		// if(CT_RaidTracker_Options["OldFormat"] == 0) then
			// link = link.."<end>"..CT_RaidTracker_GetTime(CT_RaidTracker_RaidLog[id]["End"]).."</end>";
		// else
			// link = link.."<end>"..CT_RaidTracker_RaidLog[id]["End"].."</end>";
		// end
	// end
	// if(CT_RaidTracker_RaidLog[id]["zone"]) then
		// link = link.."<zone>"..CT_RaidTracker_RaidLog[id]["zone"].."</zone>";
	// end
	// if(CT_RaidTracker_RaidLog[id]["PlayerInfos"]) then
		// link = link.."<PlayerInfos>";
		// local playerinfosindex = 1;
		// for key, val in CT_RaidTracker_RaidLog[id]["PlayerInfos"] do
			// link = link.."<key"..playerinfosindex..">";
			// link = link.."<name>"..key.."</name>";
			// for key2, val2 in CT_RaidTracker_RaidLog[id]["PlayerInfos"][key] do
				// if(key2 == "note") then
					// link = link.."<"..key2.."><![CDATA["..val2.."]]></"..key2..">";
				
				// else
					// link = link.."<"..key2..">"..val2.."</"..key2..">";
				// end
			// end
			// link = link.."</key"..playerinfosindex..">";
			// playerinfosindex = playerinfosindex + 1;
		// end
		// link = link.."</PlayerInfos>";
	// end
	// if(CT_RaidTracker_RaidLog[id]["BossKills"]) then
		// local bosskillsindex = 1;
		// link = link.."<BossKills>";
		// for key, val in CT_RaidTracker_RaidLog[id]["BossKills"] do
			// link = link.."<key"..bosskillsindex..">";
			// link = link.."<name>"..val["boss"].."</name>";
			// if(CT_RaidTracker_Options["OldFormat"] == 0) then
				// link = link.."<time>"..CT_RaidTracker_GetTime(val["time"]).."</time>";
			// else
				// link = link.."<time>"..val["time"].."</time>";
				// if( CT_RaidTracker_RaidLog[id]["BossKills"][key]["attendees"]) then
					// link = link.."<attendees>";
					// for key2, val2 in CT_RaidTracker_RaidLog[id]["BossKills"][key]["attendees"] do
						// link = link.."<key"..key2..">";
						// link = link.."<name>"..val2.."</name>";
						// link = link.."</key"..key2..">";
					// end
					// link = link.."</attendees>";
				// end
			// end
			// link = link.."</key"..bosskillsindex..">";
			// bosskillsindex = bosskillsindex + 1;
		// end
		// link = link.."</BossKills>";
	// end
	// if(CT_RaidTracker_Options["OldFormat"] == 1) then
			// local sNote = "<note><![CDATA[";
			// if(CT_RaidTracker_RaidLog[id]["note"]) then sNote = sNote..CT_RaidTracker_RaidLog[id]["note"]; end
			// if(CT_RaidTracker_RaidLog[id]["zone"]) then sNote = sNote.." - Zone: "..CT_RaidTracker_RaidLog[id]["zone"]; end
			// sNote = sNote.."]]></note>";
			// link = link..sNote;
		// else
			// if(CT_RaidTracker_RaidLog[id]["note"]) then link = link.."<note><![CDATA["..CT_RaidTracker_RaidLog[id]["note"].."]]></note>"; end
		// end
	// link = link.."<Join>";
	// for key, val in CT_RaidTracker_RaidLog[id]["Join"] do
		// link = link.."<key"..key..">";
		// link = link.."<player>"..val["player"].."</player>";
		// if(CT_RaidTracker_Options["OldFormat"] == 1) then
			// if(val["race"]) then
				// race = val["race"]; 
			// elseif(CT_RaidTracker_RaidLog[id]["PlayerInfos"] and CT_RaidTracker_RaidLog[id]["PlayerInfos"][val["player"]] and CT_RaidTracker_RaidLog[id]["PlayerInfos"][val["player"]]["race"]) then
				// race = CT_RaidTracker_RaidLog[id]["PlayerInfos"][val["player"]]["race"]; 
			// else
				// race = nil;
			// end
			// if(val["class"]) then
				// class = val["class"]; 
			// elseif(CT_RaidTracker_RaidLog[id]["PlayerInfos"] and CT_RaidTracker_RaidLog[id]["PlayerInfos"][val["player"]] and CT_RaidTracker_RaidLog[id]["PlayerInfos"][val["player"]]["class"]) then
				// class = CT_RaidTracker_RaidLog[id]["PlayerInfos"][val["player"]]["class"]; 
			// else
				// class = nil;
			// end
			// if(val["level"]) then
				// level = val["level"]; 
			// elseif(CT_RaidTracker_RaidLog[id]["PlayerInfos"] and CT_RaidTracker_RaidLog[id]["PlayerInfos"][val["player"]] and CT_RaidTracker_RaidLog[id]["PlayerInfos"][val["player"]]["level"]) then
				// level = CT_RaidTracker_RaidLog[id]["PlayerInfos"][val["player"]]["level"]; 
			// else
				// level = nil;
			// end
			// if(race) then link = link.."<race>"..race.."</race>"; end
			// if(class) then link = link.."<class>"..class.."</class>"; end
			// if(level) then link = link.."<level>"..level.."</level>"; end
		// end
		// if(CT_RaidTracker_Options["OldFormat"] == 1 and CT_RaidTracker_RaidLog[id]["PlayerInfos"][val["player"]] and CT_RaidTracker_RaidLog[id]["PlayerInfos"][val["player"]]["note"]) then link = link.."<note>"..CT_RaidTracker_RaidLog[id]["PlayerInfos"][val["player"]]["note"].."</note>"; end
		// if(CT_RaidTracker_Options["OldFormat"] == 0) then
			// link = link.."<time>"..CT_RaidTracker_GetTime(val["time"]).."</time>";
		// else
			// link = link.."<time>"..val["time"].."</time>";
		// end
		// link = link.."</key"..key..">";
	// end
	// link = link.."</Join>";
	// link = link.."<Leave>";
	// for key, val in CT_RaidTracker_RaidLog[id]["Leave"] do
		// link = link.."<key"..key..">";
		// link = link.."<player>"..val["player"].."</player>";
		// if(CT_RaidTracker_Options["OldFormat"] == 0) then
			// link = link.."<time>"..CT_RaidTracker_GetTime(val["time"]).."</time>";
		// else
			// link = link.."<time>"..val["time"].."</time>";
		// end
		// link = link.."</key"..key..">";
	// end
	// link = link.."</Leave>";
	// link = link.."<Loot>";
	// for key, val in CT_RaidTracker_RaidLog[id]["Loot"] do
		// link = link.."<key"..key..">";
		// link = link.."<ItemName>"..val["item"]["name"].."</ItemName>";
		// link = link.."<ItemID>"..val["item"]["id"].."</ItemID>";
		// if(val["item"]["icon"]) then link = link.."<Icon>"..val["item"]["icon"].."</Icon>"; end
		// if(val["item"]["class"]) then link = link.."<Class>"..val["item"]["class"].."</Class>"; end
		// if(val["item"]["subclass"]) then link = link.."<SubClass>"..val["item"]["subclass"].."</SubClass>"; end
		// link = link.."<Color>"..val["item"]["c"].."</Color>";
		// link = link.."<Count>"..val["item"]["count"].."</Count>";
		// link = link.."<Player>"..val["player"].."</Player>";
		// if(val["costs"]) then
			// link = link.."<Costs>"..val["costs"].."</Costs>";
		// end
		// if(CT_RaidTracker_Options["OldFormat"] == 0) then
			// link = link.."<Time>"..CT_RaidTracker_GetTime(val["time"]).."</Time>";
		// else
			// link = link.."<Time>"..val["time"].."</Time>";
		// end
		// if(val["zone"]) then link = link.."<Zone>"..val["zone"].."</Zone>"; end
		// if(val["boss"]) then link = link.."<Boss>"..val["boss"].."</Boss>"; end
		// if(CT_RaidTracker_Options["OldFormat"] == 1) then
			// local sNote = "<Note><![CDATA[";
			// if(val["note"]) then sNote = sNote..val["note"]; end
			// if(val["zone"]) then sNote = sNote.." - Zone: "..val["zone"]; end
			// if(val["boss"]) then sNote = sNote.." - Boss: "..val["boss"]; end
			// if(val["costs"]) then sNote = sNote.." - "..val["costs"].." DKP"; end
			// sNote = sNote.."]]></Note>";
			// link = link..sNote;
		// else
			// if(val["note"]) then link = link.."<Note><![CDATA["..val["note"].."]]></Note>"; end
		// end
		// link = link.."</key"..key..">";
	// end
	// link = link.."</Loot>";
	// link = link.."</RaidInfo>";
	// CT_RaidTrackerShowDkpLink(link);
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

?>
