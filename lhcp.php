<?php
$docRoot = "/home/SOME_PATH/www/";

include_once($docRoot.'backend/Mobile_Detect.php');
include_once($docRoot."backend/common.php");
$common = new Common();
$detect = new Mobile_Detect();
// if ($detect->isMobile() && !isset($_GET['forceDesktop'])) {
  // include 'mobile.php';
  // exit();
// }



?>
<!DOCTYPE html> 
<html>
<head>
	<base target="_blank"/>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<title>&lt;<?php echo $common::guildName;?>&gt; - LHCP</title> 
  <link rel="favicon" type="image/x-icon" href="/favicon.ico">
	<link rel="stylesheet" href="/css/style.css" />
	<link rel="stylesheet" href="/css/ui-darkness/jquery-ui-1.10.1.custom.min.css" />
  <?php echo $common->outputCommonJS();?>
  
	<script type="text/javascript" src="/js/power.js"></script>
  <?php include_once($docRoot."backend/analyticstracking.php") ?>
	<script src="/js/jquery-1.9.1.js"></script>
  <script src="/js/jquery.md5.min.js"></script>
  <script src="/js/jquery-ui-1.10.1.custom.min.js"></script>  
  <script src="/js/jquery.tablesorter.js"></script>	
	<script src="/js/jquery.tablesorter.widgets.js"></script>	
  <script>
    $(document).ready(function() {

      $("#lhcp_table").tablesorter({
        cssInfoBlock : "tablesorter-no-sort", 		
        widgets: ['zebra', 'stickyHeaders', 'filter']   
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
<a target="_self" href="http://DOMAIN/?forceDesktop=1">Bank</a> - <a target="_self" href="http://DOMAIN/users.php?forceDesktop=1">Members</a> - <a target="_self" href="http://DOMAIN/forums/index.php?mobile=desktop">Forums</a> - <a target="_self" href="http://DOMAIN/admin.php?forceDesktop=1">Admin</a> - <a target="_self" href="http://DOMAIN/mobile.php">Mobile</a> - <a target="_self" href="http://DOMAIN/forums/ucp.php?mode=logout&mobile=desktop&sid=<?php echo $sid;?>">Logout</a>
<?php
} else {
?>
<a target="_self" href="http://DOMAIN/">Bank</a> - <a target="_self" href="http://DOMAIN/users.php">Members</a> - <a target="_self" href="http://DOMAIN/forums">Forums</a> - <a target="_self" href="http://DOMAIN/admin.php">Admin</a> - <a target="_self" href="http://DOMAIN/mobile.php">Mobile</a> - <a target="_self" href="http://DOMAIN/forums/ucp.php?mode=logout&sid=<?php echo $sid;?>">Logout</a>
<?php
}
?>
</h3>
<br>
<?php echo $common->getMotd();?>
<br>
<div id="main-content">
<br>
	<table class="tablesorter" id="lhcp_table">
	<thead>
	
<tr>    
    <th>Command</th>
	  <th>Text</th>
		<th>Message</th>		
    <th class="filter-select">Category</th>
	</tr>
	</thead>
  <tbody>


<tr><td>!</td><td>!</td><td>moves in his cardboard box.</td><td>-</td></tr>
<tr><td>15yobikini</td><td>AWWWW YEAHHHH</td><td>is sooooo fatttt.</td><td>-</td></tr>
<tr><td>4thchaos</td><td>Where's that DAMN fourth chaos emerald??</td><td>will send you straight to hell.</td><td>-</td></tr>
<tr><td>68Correct</td><td>what are the odds?</td><td>sets the odds at 68.71% chance of being correct.</td><td>Movies/TV</td></tr>
<tr><td>88mph</td><td>If my calcuations are correct...</td><td>sees some serious shit.</td><td>-</td></tr>
<tr><td>KVN1</td><td>Klaatu Verata Nicto!</td><td>gets it right.</td><td>-</td></tr>
<tr><td>KVN2</td><td>Klaatu Verata Nfuhaw</td><td>gets it wrong.</td><td>-</td></tr>
<tr><td>Krom</td><td>KROM!</td><td>wants a new sword.</td><td>-</td></tr>
<tr><td>RUAHM</td><td>GOD KNOWS IM INNOCENT</td><td>prefers heavier unicorns.</td><td>-</td></tr>
<tr><td>acedetective</td><td>ACE DE TEC TIVE</td><td>solved the case!</td><td>-</td></tr>
<tr><td>achmed</td><td>Sillence! I kill you!</td><td>I kill you</td><td>our music</td></tr>
<tr><td>aggro</td><td>This aggression will not stand, man!</td><td>pulls aggro!</td><td>-</td></tr>
<tr><td>aids</td><td>Everyone has AIDS!</td><td>has aids!</td><td>Music</td></tr>
<tr><td>aidslong</td><td>AIDS AIDS AIDS!*</td><td>has aids!</td><td>Music</td></tr>
<tr><td>alpha</td><td>A B C D</td><td>talks like a little girl.</td><td>-</td></tr>
<tr><td>alright</td><td>Alright, alright, alright!</td><td>finally agrees with you.</td><td>-</td></tr>
<tr><td>alrighty</td><td>ALRIGHTY THEN!</td><td>thinks your an idiot.</td><td>Movies/TV</td></tr>
<tr><td>always</td><td>Wanna be with you</td><td>rides a unicorn.</td><td>-</td></tr>
<tr><td>america</td><td>America! Fuck yeah!*</td><td>loves his country!</td><td>Music</td></tr>
<tr><td>americalong</td><td>America! America!</td><td>loves his country!</td><td>Music</td></tr>
<tr><td>anidiot</td><td>He's an idiot.</td><td>thinks you're dumb.</td><td>-</td></tr>
<tr><td>annoying</td><td>wanna hear the most annoying noise in the world?</td><td>makes the most annoying noise in the world.</td><td>Movies/TV</td></tr>
<tr><td>appl</td><td>Bravo!</td><td></td><td>Etc</td></tr>
<tr><td>army</td><td>Army Strong!</td><td>is strong.</td><td>-</td></tr>
<tr><td>asshole</td><td>you are an ASSHOLE!</td><td>thinks you're pretty cool!</td><td>-</td></tr>
<tr><td>ateam</td><td>The A TEAM!</td><td>summons the A TEAM!</td><td>Movies/TV</td></tr>
<tr><td>atfries</td><td>Adventure Time Fries</td><td>eats cold fries.</td><td>-</td></tr>
<tr><td>athf</td><td>My name is...</td><td>has ice on his fingers and toes.</td><td>-</td></tr>
<tr><td>athouse</td><td>Adventure Time Househunting</td><td>is invested in a very cute video game.</td><td>-</td></tr>
<tr><td>attheme</td><td>Adventure Time Theme*</td><td>is mathmatical!</td><td>-</td></tr>
<tr><td>authority</td><td>Maybe this will teach you to listen to authority!</td><td>demands respect.</td><td>Movies/TV</td></tr>
<tr><td>aweyosuke</td><td>One...awesome...Yosuke...</td><td>is the true self.</td><td>-</td></tr>
<tr><td>awwcrap</td><td>Aww crap!</td><td>can't deal with the stress!</td><td>-</td></tr>
<tr><td>axebrings</td><td>Axe brings the axe!</td><td>has enough axe.</td><td>-</td></tr>
<tr><td>axehacks</td><td>Axe Hacks!</td><td>is not talking about computers.</td><td>-</td></tr>
<tr><td>axenothing</td><td>You get nothing!</td><td>explodes!</td><td>-</td></tr>
<tr><td>backinajiffy</td><td>I'll be back in a jiffy!</td><td>will be right back!</td><td>-</td></tr>
<tr><td>badger</td><td>Badger, badger, badger, badger...</td><td>is afraid of snakes</td><td>Internet</td></tr>
<tr><td>badtouch</td><td>Sweat baby, Sweat baby</td><td>loves dirty parodies.</td><td>-</td></tr>
<tr><td>badtouch2</td><td>You and me baby ain't nothin but mammals...</td><td>loves dirty parodies.</td><td>-</td></tr>
<tr><td>badtouch3</td><td>I love, that kind you clean up...</td><td>loves dirty parodies.</td><td>-</td></tr>
<tr><td>bailamos</td><td>Bailamoooos!</td><td>lets the rhythm take him over.</td><td>-</td></tr>
<tr><td>balls</td><td>I think you need your balls reattached.</td><td></td><td>Etc</td></tr>
<tr><td>banana1</td><td>Put a banana in your ear!</td><td>puts a banana in their ear.</td><td>-</td></tr>
<tr><td>banana2</td><td>Put another banana in your ear!</td><td>puts a second banana in their ear.</td><td>-</td></tr>
<tr><td>bananas</td><td>B A N A N A S</td><td>thinks this shit is BANANAS</td><td>Music</td></tr>
<tr><td>bankai</td><td>Bankai... Tensa Zangetsu!</td><td></td><td>Movies/TV</td></tr>
<tr><td>bankai2</td><td>Scatter... Senbonzakura Kageyoshi</td><td></td><td>Movies/TV</td></tr>
<tr><td>barney1</td><td>BELCH</td><td>had a little too much to drink</td><td>-</td></tr>
<tr><td>barney2</td><td>Words of wisdom</td><td>gives you some insight</td><td>-</td></tr>
<tr><td>barney3</td><td>Owww!</td><td>is in a great deal of pain!</td><td>-</td></tr>
<tr><td>barrel</td><td>DO A BARREL ROLL!</td><td>does a barrel roll!</td><td>Video Games</td></tr>
<tr><td>bbd</td><td>A man of my stature should have to wear a dress?</td><td>casts slow fall.</td><td>-</td></tr>
<tr><td>bde</td><td>Best day ever!</td><td>is having the time of their life!</td><td>Movies/TV</td></tr>
<tr><td>beaman</td><td>Be a man!</td><td>must be swift as the coursing river!</td><td>Movies/TV</td></tr>
<tr><td>bearnaked</td><td>gonna get BEAR NAKED!!</td><td>is the beary best.</td><td>-</td></tr>
<tr><td>bearserk</td><td>GOING BEARSERK</td><td>is gonna get grizzly!</td><td>-</td></tr>
<tr><td>bearzerk</td><td>I'M GOING BEARSERK</td><td>is beary mad!</td><td>-</td></tr>
<tr><td>beautiful</td><td>B E A UTIFUL!</td><td>can spell beautiful.</td><td>-</td></tr>
<tr><td>beback</td><td>I'll be back.</td><td>threatens you with the wrath of thrall.</td><td>Movies/TV</td></tr>
<tr><td>begreat</td><td>That'd be great.</td><td>sips coffee.</td><td>-</td></tr>
<tr><td>belly</td><td>Get In my belly.</td><td></td><td>Movies/TV</td></tr>
<tr><td>benny</td><td>gives it some Benny Hill!</td><td>gives it some Benny!</td><td>Music</td></tr>
<tr><td>berightback</td><td>We'll be right back.*</td><td>is inturrupted by commercials.</td><td>-</td></tr>
<tr><td>bestinlife</td><td>What is best in life?</td><td>lamentates.</td><td>-</td></tr>
<tr><td>better</td><td>Much better now.</td><td>eyes glow red.</td><td>-</td></tr>
<tr><td>betterrun</td><td>Faggot better run.</td><td>is a homophobe.</td><td>-</td></tr>
<tr><td>bf</td><td>Hello baby can I see you smile?</td><td>is your bestfriend.</td><td>-</td></tr>
<tr><td>bf2</td><td>He's my best friend, best of all best friends!</td><td>is his best friend.</td><td>-</td></tr>
<tr><td>bigboned</td><td>I'm not fat. I'm big boned.</td><td>is just big boned.</td><td>Movies/TV</td></tr>
<tr><td>bigbutts</td><td>Her butt is sooo big!</td><td>likes big butts.</td><td>-</td></tr>
<tr><td>bigkiss</td><td>No tongue!</td><td>puckers up.</td><td>-</td></tr>
<tr><td>bigotry</td><td>There is no racial bigotry here.</td><td>hates all people.</td><td>-</td></tr>
<tr><td>bigpenis</td><td>Big Penis</td><td>thinks the pen is big.</td><td>-</td></tr>
<tr><td>bikini</td><td>Check my bikini!</td><td>shows of their new bikini.</td><td>Music</td></tr>
<tr><td>billnye</td><td>Inertia is a property of matter</td><td>thinks science is cool</td><td>-</td></tr>
<tr><td>bing</td><td>Bing!</td><td>goes bing!</td><td>Etc</td></tr>
<tr><td>bj</td><td>Billie Jean!</td><td>claims the kid is not their son!</td><td>Music</td></tr>
<tr><td>bkb</td><td>The Blitzkrieg Bop!</td><td>plays his air guitar.</td><td>-</td></tr>
<tr><td>blade</td><td>Enters the Thrall Techno Club.</td><td></td><td>Music</td></tr>
<tr><td>blah1</td><td>blahblahblah</td><td>talks good.</td><td>-</td></tr>
<tr><td>blah2</td><td>blahblahblah blahblah</td><td>just keeps talking!</td><td>-</td></tr>
<tr><td>bleep</td><td>CENSORED</td><td></td><td>Etc</td></tr>
<tr><td>bloodinit</td><td>I'm only buying this...</td><td>doesn't know how to carry.</td><td>-</td></tr>
<tr><td>bloodytears</td><td>Bloody Tears</td><td>whips some fishmen.</td><td>-</td></tr>
<tr><td>blow</td><td>I'm gonna blow this guy.</td><td>is totally straight.</td><td>-</td></tr>
<tr><td>blubber</td><td>Look at that blubber fly!</td><td>appears to be mesmerized!</td><td>-</td></tr>
<tr><td>blue</td><td>I'm Blue, Dabba De Dabba Dai!</td><td>is turning blue.</td><td>-</td></tr>
<tr><td>boat</td><td>I'm on a boat!</td><td>won a boat ride for three.</td><td>-</td></tr>
<tr><td>bologna</td><td>Taking a ride on the bologna pony!</td><td></td><td>Movies/TV</td></tr>
<tr><td>bomb</td><td>SOME ONE SET US UP THE BOMB!</td><td>planted the bomb!</td><td>Video Games</td></tr>
<tr><td>bond</td><td>The name's Bond, James Bond!</td><td>pretends to be a spy.</td><td>Movies/TV</td></tr>
<tr><td>boogie</td><td>Get down, get down!</td><td>boogies on down.</td><td>Music</td></tr>
<tr><td>boomdiada</td><td>Boomdiada!</td><td>jumps off a cliff.</td><td>-</td></tr>
<tr><td>boomstick</td><td>This is my BOOMSTICK!</td><td>shops smart.</td><td>-</td></tr>
<tr><td>bored1</td><td>Tongue pierced!</td><td>has a stud.</td><td>-</td></tr>
<tr><td>bored2</td><td>Penis spear!</td><td>sets off metal detectors.</td><td>-</td></tr>
<tr><td>bouncy</td><td>Bouncy, bouncy</td><td>is topheavy.</td><td>-</td></tr>
<tr><td>bourbon</td><td>Wheres my bourbon?</td><td>is an angry drunk.</td><td>-</td></tr>
<tr><td>boyfriend</td><td>Can't I just have a normal boyfriend?</td><td>screams!</td><td>Etc</td></tr>
<tr><td>brain</td><td>Alright brain, you dont like me and i dont like you...</td><td>continues drinking.</td><td>Movies/TV</td></tr>
<tr><td>bravery</td><td>I've not seen such bravery!</td><td>pushes the envelope.</td><td>-</td></tr>
<tr><td>breakcuffs</td><td>I can break these cuffs...</td><td>can't break those cuffs.</td><td>-</td></tr>
<tr><td>brewmiss</td><td>How many times are you gonna miss?</td><td>brings beer to a fight.</td><td>-</td></tr>
<tr><td>brewsplit</td><td>Jump in any time guys!</td><td>is the life of the party.</td><td>-</td></tr>
<tr><td>bright</td><td>Always look on the bright side of life!</td><td>is feeling optimistic!</td><td>Music</td></tr>
<tr><td>bringiton</td><td>God...?</td><td>hates puny gods.</td><td>-</td></tr>
<tr><td>bruceanal</td><td>I've had anal sex...</td><td>has passed out a couple times.</td><td>-</td></tr>
<tr><td>buddy</td><td>Look Buddy!</td><td>gives it some lip.</td><td>Movies/TV</td></tr>
<tr><td>business</td><td>Let's get down to business!</td><td>fails at war.</td><td>-</td></tr>
<tr><td>butthead</td><td>What you looking at!</td><td>calls you a butthead.</td><td>Movies/TV</td></tr>
<tr><td>byh</td><td>I can be your healer baby!</td><td>assures you that they are 40 yards away.</td><td>Music</td></tr>
<tr><td>cake</td><td>It's a piece of cake!</td><td>loves cake!</td><td>Music</td></tr>
<tr><td>candy</td><td>Candy Mountain Charlie!</td><td>steps into the candy mountain candy cave.</td><td>-</td></tr>
<tr><td>cantdo</td><td>I can't do that. </td><td>speaks in monotone.</td><td>-</td></tr>
<tr><td>captainplanet</td><td>The power is yours!</td><td>got the heart ring.</td><td>-</td></tr>
<tr><td>caramell</td><td>Oo! Oo! Oo ah oo ah!</td><td>is elated!</td><td>Internet</td></tr>
<tr><td>caramell2</td><td>We're Caramelldansen!</td><td>plays caramelldansen on a guitar.</td><td>-</td></tr>
<tr><td>carneval</td><td>My lady carneval</td><td>is in love</td><td>our music</td></tr>
<tr><td>carryon</td><td>Carry on my wayward son!</td><td>doesn't want you to cry anymore.</td><td>Music</td></tr>
<tr><td>castleaban</td><td>Castlevania  Abandoned Castle</td><td>doesn't think its abandoned.</td><td>-</td></tr>
<tr><td>castlepinn</td><td>Castlevania  Demon Castle Pinnacle*</td><td>is ready to take on Drac!</td><td>-</td></tr>
<tr><td>castlepro</td><td>Castlevania prologue</td><td>gets a whip ready.</td><td>-</td></tr>
<tr><td>castlevamp</td><td>Castlevania  Vampire Killer</td><td>gives whips dumb names.</td><td>-</td></tr>
<tr><td>cbsmail</td><td>Lets open...</td><td>wonders what's in the mail</td><td>Etc</td></tr>
<tr><td>cbye</td><td>Kiss my butt goodbye!</td><td>makes his farewells.</td><td>Movies/TV</td></tr>
<tr><td>cgs</td><td>Come get some!</td><td></td><td>Video Games</td></tr>
<tr><td>champions</td><td>We are the champions my friends!</td><td>wins.</td><td>-</td></tr>
<tr><td>chatup</td><td>Of all the gin joints, in all the world...</td><td>feeds you a sleazy line.</td><td>Movies/TV</td></tr>
<tr><td>chefsong</td><td>They're big and salty and brown</td><td></td><td>Movies/TV</td></tr>
<tr><td>chewy</td><td>Raaaaaawwwwwww.</td><td>makes a wookie sound.</td><td>Etc</td></tr>
<tr><td>chickendance</td><td>So kiss my butt!</td><td>doesn't want to be a chicken!</td><td>Music</td></tr>
<tr><td>chickenpop</td><td>Popeyes chicken is Fucking awesome!!!!.</td><td></td><td>Movies/TV</td></tr>
<tr><td>chiksex</td><td>Sorry I had sex with a chicken. I won't do it again.</td><td>apologizes.</td><td>Movies/TV</td></tr>
<tr><td>chimps</td><td>Maybe we should tell them the truth!</td><td>has a confession to make!</td><td>-</td></tr>
<tr><td>chocolate</td><td>Some stay dry and others feel the pain</td><td>sings</td><td>Music</td></tr>
<tr><td>chocolates</td><td>You know mother, life is like a box of chocolates.</td><td></td><td>Movies/TV</td></tr>
<tr><td>clockcan</td><td>I AM a can of whoopass!</td><td>isn't a robot.</td><td>-</td></tr>
<tr><td>clocksix</td><td>Six Million Gold Piece Man!</td><td>doesn't move in slow motion.</td><td>-</td></tr>
<tr><td>cloudsong</td><td>YOU STOLE MY CLOUDSONG!</td><td>says you stole their cloudsong!</td><td>Internet</td></tr>
<tr><td>cod</td><td>Come on down!</td><td></td><td>Movies/TV</td></tr>
<tr><td>cokewhore</td><td>you coke whore...*</td><td>can't stand pepsi.</td><td>-</td></tr>
<tr><td>comfail</td><td>We have a failure to communicate!</td><td>is dissapointed at our attempts to interact succesfully.</td><td>Movies/TV</td></tr>
<tr><td>comply</td><td>YOU HAVE 20 SECONDS TO COMPLY!</td><td>presses you for action.</td><td>Movies/TV</td></tr>
<tr><td>cookie</td><td>Om nom nom nom nom!</td><td></td><td>Etc</td></tr>
<tr><td>cop</td><td>I'm a COP, you idiot</td><td>is angry</td><td>Movies/TV</td></tr>
<tr><td>cornhole</td><td>Watch your cornhole, buddy!</td><td>drops the soap.</td><td>-</td></tr>
<tr><td>cotc</td><td>CORN ON THE COB!</td><td>is hungry.</td><td>Music</td></tr>
<tr><td>ctm</td><td>Can't Touch Me!</td><td>has diplomatic immunity.</td><td>-</td></tr>
<tr><td>ctt</td><td>Can't touch this!</td><td>is untouchable!</td><td>Music</td></tr>
<tr><td>cuppycake</td><td>You're my cuppycake gumdrop..</td><td>thinks you're the apple of their eye.</td><td>Music</td></tr>
<tr><td>curvybutt</td><td>Cya later, shit lords!</td><td>will be right back!</td><td>-</td></tr>
<tr><td>dagbarf</td><td>BLUUUUUUUGH</td><td>throws up!</td><td>-</td></tr>
<tr><td>dagcheer</td><td>See my finger...</td><td>hips are shaking from left to right.</td><td>-</td></tr>
<tr><td>daglaugh</td><td>AHAHA AHAHA</td><td>is off their meds.</td><td>-</td></tr>
<tr><td>dagshut</td><td>SHUT! UP!</td><td>saves some BAY BEES.</td><td>-</td></tr>
<tr><td>damned</td><td>Your damned if your do, your damned if you dont.</td><td>gives up.</td><td>Movies/TV</td></tr>
<tr><td>damnlie</td><td>Thats a damn lie.</td><td>is wearing flaming pants.</td><td>-</td></tr>
<tr><td>darkpower</td><td>If you only knew the power of the darkside*</td><td></td><td>Movies/TV</td></tr>
<tr><td>darkside</td><td>You don't know the power of the dark side.</td><td>tempts you with the dark side.</td><td>Movies/TV</td></tr>
<tr><td>darksoul</td><td>I should have been the one...</td><td>just hit puberty</td><td>-</td></tr>
<tr><td>db</td><td>Dont you have some poor defenseless animal to Disembowl!</td><td>disembowels you!</td><td>Movies/TV</td></tr>
<tr><td>deadwife</td><td>LIKE YOUR DEAD WIFE??</td><td>is probably not the killer.</td><td>-</td></tr>
<tr><td>deathwarrant</td><td>Who the fuck said that*</td><td></td><td>Etc</td></tr>
<tr><td>demon</td><td>..is a demon slayer</td><td>strikes down his enemies with holy light!</td><td>Music</td></tr>
<tr><td>den</td><td>Raidovaci den</td><td>jde na raidovaci den</td><td>our music</td></tr>
<tr><td>despicable</td><td>Youre Despicable.</td><td>frowns upon you.</td><td>Movies/TV</td></tr>
<tr><td>desu</td><td>Soshite toki ga ugoki desu.</td><td>continues time.</td><td>Video Games</td></tr>
<tr><td>devoted</td><td>I'm hopelessly devoted to you! *vomit*</td><td>is sickeningly ingratiating.</td><td>Etc</td></tr>
<tr><td>dexbear</td><td>See how my fingers move?</td><td>waggles some claws.</td><td>-</td></tr>
<tr><td>dht</td><td>Listen to your heart</td><td></td><td>our music</td></tr>
<tr><td>diabetus</td><td>I work for Liberty Medical...</td><td>has diabetes.</td><td>-</td></tr>
<tr><td>dickless</td><td>Yes, it's true.</td><td>wears pants high in the crotch.</td><td>-</td></tr>
<tr><td>dieforyou</td><td>Yosuke is now your friend!</td><td>will now DIE FOR YOU.</td><td>-</td></tr>
<tr><td>dine</td><td>SPARTANS</td><td>is ready to DINE IN HELL</td><td>Movies/TV</td></tr>
<tr><td>disconnect</td><td>That is something I cannot allow to happen.</td><td>cannot do that, Dave.</td><td>-</td></tr>
<tr><td>dkp</td><td>50 DKP MINUS!</td><td>takes away your DKP!</td><td>Internet</td></tr>
<tr><td>dog</td><td>Okay, so...she's a dog</td><td>sleeps above the covers.</td><td>-</td></tr>
<tr><td>dogs</td><td>Who let the dogs out!</td><td>wants to know who aggrod the dogs!</td><td>Music</td></tr>
<tr><td>dogsbees</td><td>Dogs with bees in their mouths!</td><td>isn't afraid of you!</td><td>-</td></tr>
<tr><td>doingmybest</td><td>I'm trying to do my best here!</td><td>is freaking out, man!</td><td>-</td></tr>
<tr><td>donny</td><td>Shut the fuck up Donny.</td><td>abides.</td><td>-</td></tr>
<tr><td>donotgo</td><td>Do not go in there.</td><td>pulls up pants after taking a huge dump.</td><td>Etc</td></tr>
<tr><td>donthug</td><td>Do not hug me.</td><td>tells you not to hug him.</td><td>Movies/TV</td></tr>
<tr><td>dontlook</td><td>DON'T LOOK AT ME!</td><td>needs less than a minute.</td><td>-</td></tr>
<tr><td>dontstop</td><td>Don't stop me now!</td><td>is having such a good time!</td><td>Music</td></tr>
<tr><td>dontstop2</td><td>I'm a rocket ship, on my way to mars!</td><td>is a sex machine, ready to reload!</td><td>Music</td></tr>
<tr><td>donttazeme</td><td>Don't taze me bro!</td><td>doesn't like being tazed.</td><td>Internet</td></tr>
<tr><td>dota</td><td>Vi sitter har i venten och spelar lite DotA</td><td>is ready to play some DotA.</td><td>Internet</td></tr>
<tr><td>dots</td><td>MORE DOTS!</td><td>demands more DoTs!</td><td>Internet</td></tr>
<tr><td>dots2</td><td>Need more DoTs!</td><td>wants more DoTs.</td><td>Internet</td></tr>
<tr><td>dpm</td><td>Shouryuken!</td><td>moves forward, down, downforward.</td><td>-</td></tr>
<tr><td>dragon</td><td>Naruto Shippuuden Movie 2</td><td></td><td>our music</td></tr>
<tr><td>drewboogie</td><td>Get down, get down!</td><td>knows how to boogie!</td><td>-</td></tr>
<tr><td>drewcrank</td><td>Drew's crankyanker</td><td>ain't pistol rubbin.</td><td>-</td></tr>
<tr><td>drewdrops</td><td>A long collection</td><td>misses Drew.</td><td>-</td></tr>
<tr><td>drewshuffle</td><td>The Dr. Drew shuffle</td><td>is shufflin everyday.</td><td>-</td></tr>
<tr><td>drop</td><td>BLOOP</td><td>might be leaking.</td><td>-</td></tr>
<tr><td>drown</td><td>Sonic drowning</td><td>looks for a bubble!</td><td>-</td></tr>
<tr><td>druidtank</td><td>Why don't we have a druid tank Rag?</td><td>wants a druid to tank Rag.</td><td>Internet</td></tr>
<tr><td>dryrape</td><td>Dry Anal Rape</td><td>must be in Burbank.</td><td>-</td></tr>
<tr><td>duchove</td><td>At ziji duchove...</td><td>privolava Brenovo Pucha...teda Ducha</td><td>our music</td></tr>
<tr><td>dundun</td><td>DundundunDUNDUNDA</td><td>looks dramatically at the camera!</td><td>-</td></tr>
<tr><td>edn</td><td>Everybody Dance Now!</td><td>dances like they were in a gay steel mill factory!</td><td>Music</td></tr>
<tr><td>eeww</td><td>EEEEEEEeeeewwwwwww!</td><td>is disgusted.</td><td>Etc</td></tr>
<tr><td>eheh</td><td>Eh Eh Eeeeeh!</td><td>prods you with he finger.</td><td>Etc</td></tr>
<tr><td>elol</td><td>Mwahahaha!</td><td>laughs with an evil glint in his eye.</td><td>Etc</td></tr>
<tr><td>emo</td><td>IT DOESN'T EVEN MAATTEERRR</td><td>watches a Dragon Ball Z video on youtube.</td><td>Music</td></tr>
<tr><td>eng101</td><td>Do you speak it?</td><td>looks like a bitch.</td><td>-</td></tr>
<tr><td>entertain</td><td>Are you not entertained!?</td><td>spreads arms wide.</td><td>-</td></tr>
<tr><td>epic</td><td>EPIC WoW Maneuver!</td><td>pulls an epic maneuver!</td><td>Music</td></tr>
<tr><td>error</td><td>Human error.</td><td>might be a bit insane.</td><td>-</td></tr>
<tr><td>eternity</td><td>Echoes in eternity!</td><td>is ready for glory.</td><td>-</td></tr>
<tr><td>ewdead</td><td>EW DEAD BODIES</td><td>throws up.</td><td>-</td></tr>
<tr><td>ewicka</td><td>Ewa Farna powa!</td><td>is in love</td><td>our music</td></tr>
<tr><td>excellent</td><td>Excellent. Yeeessss!</td><td>is unbeatable!</td><td>Etc</td></tr>
<tr><td>facedeath</td><td>Youre just another weak human.</td><td>calls you a weak human.</td><td>Movies/TV</td></tr>
<tr><td>fail</td><td>YOU HAVE FAILED!</td><td>says you fail!</td><td>Etc</td></tr>
<tr><td>famguy</td><td>Lucky there's a family guy!</td><td>falls down the stairs</td><td>-</td></tr>
<tr><td>fascist</td><td>Fucking Fascist!</td><td>catches a coffee cup.</td><td>-</td></tr>
<tr><td>fastnumb</td><td>Linkin Park Fast Numb</td><td>For fun numb</td><td>our music</td></tr>
<tr><td>fat</td><td>You're fat.</td><td>jiggles.</td><td>-</td></tr>
<tr><td>father</td><td>I am your father.</td><td>tells you who your dad is.</td><td>Movies/TV</td></tr>
<tr><td>favour</td><td>Why don't you do the world a favour!</td><td>insults you!</td><td>Etc</td></tr>
<tr><td>feelgood</td><td>I FEEL GOOD!</td><td>is feeling great.</td><td>Music</td></tr>
<tr><td>feellucky</td><td>You gotta ask yourself, do you feel lucky?</td><td>taunts you.</td><td>Movies/TV</td></tr>
<tr><td>feelpain</td><td>I'm programmed to feel pain</td><td>is in a great amount of pain!</td><td>-</td></tr>
<tr><td>ff</td><td>Attacked by Green Ogre!</td><td>warns you of an approaching enemy!</td><td>-</td></tr>
<tr><td>finalcountdown</td><td>Dana na! na!</td><td></td><td>Music</td></tr>
<tr><td>finalfantasy</td><td>Attacked by Green Ogre!</td><td>warns you of an approaching enemy!</td><td>Video Games</td></tr>
<tr><td>finalfantasyloop</td><td>Green Ogre 6hits 9999!</td><td>is locked in combat!</td><td>Video Games</td></tr>
<tr><td>finest</td><td>This will be our finest hour!</td><td>is filled with confidence.</td><td>Movies/TV</td></tr>
<tr><td>flame</td><td>DO NOT MOVE!</td><td>will not move when flame wreath is cast.</td><td>Video Games</td></tr>
<tr><td>flamelong</td><td>I will not move when flame wreath is cast</td><td>will not move when flame wreath is cast.</td><td>Video Games</td></tr>
<tr><td>flipper</td><td>EE EEEE EE E</td><td>squeeks</td><td>Movies/TV</td></tr>
<tr><td>footloose</td><td>Kick off your Sunday shoes!</td><td>has to cut loose!</td><td>Music</td></tr>
<tr><td>forporn</td><td>The Internet is for porn!</td><td>is grossed out.</td><td>-</td></tr>
<tr><td>fpsdoug</td><td>IT'S LIKE BOOM HS!!</td><td>molds his hands into holding an Arctic Warfare Magnum.</td><td>Internet</td></tr>
<tr><td>freshprince</td><td>Fresh Prince of Bel Air!</td><td>is banished from Philly.</td><td>-</td></tr>
<tr><td>friedtofu</td><td>My...fried...tofu...</td><td>ate the whole thing!</td><td>-</td></tr>
<tr><td>friends</td><td>Friends</td><td></td><td>-</td></tr>
<tr><td>friendship</td><td>This is the beginnning of a beautiful friendship!</td><td>likes you.</td><td>Movies/TV</td></tr>
<tr><td>fsteak</td><td>Futile!</td><td>loves the kiddie corner!</td><td>-</td></tr>
<tr><td>fu</td><td>Fuck you asshole!</td><td></td><td>Movies/TV</td></tr>
<tr><td>fuckastranger</td><td>You see what happens?</td><td>loves to use a crowbar.</td><td>-</td></tr>
<tr><td>futurama</td><td>Futurama is best</td><td>Futurama</td><td>our music</td></tr>
<tr><td>gaia</td><td>Gaia nedala...</td><td>se smeje %t ze s nim nespala</td><td>our music</td></tr>
<tr><td>gamecharacter</td><td>Jeez how insulting!</td><td>hates video games.</td><td>-</td></tr>
<tr><td>gangnam</td><td>Gangnam Style!</td><td>drinks hot coffee in one swallow.</td><td>-</td></tr>
<tr><td>gas</td><td>GASEOUS SUBSTANCE DETECTED</td><td>sniffs at you.</td><td>Etc</td></tr>
<tr><td>gay</td><td>I just went gay!</td><td>has switched sides.</td><td>Etc</td></tr>
<tr><td>gay1</td><td>You're gay.</td><td>plays for the other team.</td><td>-</td></tr>
<tr><td>gay2</td><td>You're gay!</td><td>opens the closet door.</td><td>-</td></tr>
<tr><td>gdamn</td><td>G'damnit leeroy!</td><td>accuses you of acting like Leeroy Jenkins.</td><td>Internet</td></tr>
<tr><td>genius</td><td>You are a god damn genius!!</td><td>thinks your pretty smart.</td><td>Movies/TV</td></tr>
<tr><td>getbent</td><td>GET BENT</td><td>wants you to get BENT.</td><td>-</td></tr>
<tr><td>getbent2</td><td>GETBENTGETBENT</td><td>is supposed to be in highschool!</td><td>-</td></tr>
<tr><td>getdown</td><td>Get down tonight!</td><td>does a little dance.</td><td>Music</td></tr>
<tr><td>getdown2</td><td>Get down tonight baby!</td><td>gets down.</td><td>Music</td></tr>
<tr><td>getup</td><td>But I get up again!</td><td>gets knocked down!</td><td>Music</td></tr>
<tr><td>gg</td><td>World of Warcraft is the greatest game</td><td>sings.</td><td>-</td></tr>
<tr><td>girls</td><td>Where the white women at?</td><td>is lookin for the laydeez!</td><td>Etc</td></tr>
<tr><td>glike</td><td>GOD LIKE!</td><td>is a GOD!</td><td>Video Games</td></tr>
<tr><td>gobble</td><td>gobblegobble</td><td>hates Thanksgiving.</td><td>-</td></tr>
<tr><td>gof</td><td>Germany or Florida?</td><td>has had too much sun and nazis.</td><td>-</td></tr>
<tr><td>gog</td><td>The goggles! They do nothing!</td><td>finds that their goggles do nothing!</td><td>Movies/TV</td></tr>
<tr><td>gomer</td><td>Gomer Pile!</td><td>sings the Gomer Pile theme song</td><td>Music</td></tr>
<tr><td>goninja</td><td>GO NINJA GO NINJA GO!</td><td>busts out the ninja moves!</td><td>Music</td></tr>
<tr><td>gonnadie</td><td>WE ARE GOING TO DIE</td><td>is not going to make it!</td><td>Music</td></tr>
<tr><td>gonnapay</td><td>YOU'RE GONNA PAY</td><td>wants their money!</td><td>-</td></tr>
<tr><td>good3</td><td>Good Times!!</td><td>is not in studio.</td><td>-</td></tr>
<tr><td>goodlooking</td><td>You're Ridiculously good looking!</td><td>turns left.</td><td>-</td></tr>
<tr><td>goodthing</td><td>Rape is a good thing!</td><td>is wrong about many things.</td><td>-</td></tr>
<tr><td>goofed</td><td>I'm sorry Will Robinson...</td><td></td><td>Movies/TV</td></tr>
<tr><td>gotanother</td><td>Got another question weirdo??</td><td>hates callers.</td><td>-</td></tr>
<tr><td>gotohell</td><td>If I were human...</td><td>tells you to go to hell.</td><td>Movies/TV</td></tr>
<tr><td>gover</td><td>Game Over Man!</td><td>calls a wipe!</td><td>Movies/TV</td></tr>
<tr><td>gp</td><td>Grand Prix!</td><td>is gripping his steering wheel.... so tight!</td><td>Music</td></tr>
<tr><td>groovy</td><td>Groovy</td><td>digs it.</td><td>-</td></tr>
<tr><td>grunt</td><td>UHHHGH</td><td>feels too much.</td><td>-</td></tr>
<tr><td>gtfo</td><td>Get the out ma house B!</td><td>politely asks you to leave.</td><td>Etc</td></tr>
<tr><td>gum</td><td>I'm here to kick ass and chew bubblegum.</td><td></td><td>Video Games</td></tr>
<tr><td>gumi</td><td>Gumi maci*</td><td></td><td>our music</td></tr>
<tr><td>hack</td><td>To reach these kids...*</td><td>is a very special episode.</td><td>-</td></tr>
<tr><td>halloween</td><td>This is halloween</td><td>wishes it were halloween.</td><td>-</td></tr>
<tr><td>hamster</td><td>You mother was a hamster!</td><td>laughs at you.</td><td>Etc</td></tr>
<tr><td>hanachan</td><td>hana-chan~~</td><td>is gonna die soon.</td><td>-</td></tr>
<tr><td>happy</td><td>Ty radsi nedelej nic</td><td>prosi %t at nedela nic</td><td>our music</td></tr>
<tr><td>happybday</td><td>You're not special.</td><td>hates birthdays.</td><td>-</td></tr>
<tr><td>hard</td><td>Grind, baby, grind, baby</td><td></td><td>Internet</td></tr>
<tr><td>hard2</td><td>Hard like heroic, more than you can handle</td><td>wants do do it like a druid in the general channel</td><td>Internet</td></tr>
<tr><td>hard3</td><td>I think your wii's the one for me!</td><td>just wants the trial.</td><td>Internet</td></tr>
<tr><td>hard4</td><td>I think your wii's the one for me!</td><td>just wants the trial.</td><td>-</td></tr>
<tr><td>hassan</td><td>AYAYLELEAYALELEALA!</td><td></td><td>Etc</td></tr>
<tr><td>hasta</td><td>Hasta La Vista Baby.</td><td></td><td>-</td></tr>
<tr><td>hatedit</td><td>HATED IT</td><td></td><td>Etc</td></tr>
<tr><td>hatepants</td><td>I hate pants</td><td>is sick of these pants!</td><td>-</td></tr>
<tr><td>hawaii</td><td>YAYYYYY!</td><td>puts on a helmet.</td><td>-</td></tr>
<tr><td>hax</td><td>WTF UBER HAX!!1</td><td>thinks they got new hax!</td><td>Music</td></tr>
<tr><td>hb</td><td>Heartbeat!</td><td>listens to their heartbeat.</td><td>Music</td></tr>
<tr><td>headshot</td><td>HEADSHOT</td><td>crits for HEADSHOT!</td><td>Video Games</td></tr>
<tr><td>heavy</td><td>You are so small!</td><td>starts spinning up!</td><td>-</td></tr>
<tr><td>hereitgoes</td><td>Here it goes! Here it goes again!</td><td>dances on some treadmills.</td><td>Music</td></tr>
<tr><td>heroin</td><td>You're a heroin addict.</td><td>stages an intervention.</td><td>-</td></tr>
<tr><td>hescrazy</td><td>He's crazy...</td><td>is filled with doubt</td><td>-</td></tr>
<tr><td>hesgay</td><td>He's gay!</td><td>calls it like it is.</td><td>-</td></tr>
<tr><td>heysong</td><td>I SAID HEY</td><td>loves to use AIM.</td><td>-</td></tr>
<tr><td>hibaby</td><td>HELLOOOO BABY!</td><td>is feeling lucky</td><td>Etc</td></tr>
<tr><td>high5</td><td>HIGH FIVE!</td><td>goes down low.</td><td>-</td></tr>
<tr><td>hitit</td><td>Hit it like ya mean it!</td><td>wants you to put more effort in.</td><td>Internet</td></tr>
<tr><td>hollaback</td><td>I ain't no holla back girl</td><td>has been around that track.</td><td>Music</td></tr>
<tr><td>holocaust</td><td>Just thinkin...</td><td>knows about history.</td><td>-</td></tr>
<tr><td>holyy</td><td>Strach z nacku...</td><td></td><td>our music</td></tr>
<tr><td>homo2</td><td>Maybe you all are homosexuals, too!</td><td>questions your sexuality!</td><td>-</td></tr>
<tr><td>hooked</td><td>Iiiii'm hooked on a feeling!</td><td>is in love.</td><td>Music</td></tr>
<tr><td>hooker</td><td>GO GET YOURSELF A HOOKER</td><td>is good buddies with the red guy.</td><td>-</td></tr>
<tr><td>hooligan</td><td>you no good HOOLIGAN!</td><td>shakes a cane at you damn kids!</td><td>-</td></tr>
<tr><td>horny</td><td>I'm REALLY horny.</td><td>rubs up against you.</td><td>-</td></tr>
<tr><td>hotncold</td><td>You're Hot N' You're Cold!</td><td>changes their mind like a girl changes clothes.</td><td>-</td></tr>
<tr><td>hotpussy</td><td>Here kitty kitty!!</td><td>sings a song.</td><td>Etc</td></tr>
<tr><td>housewares</td><td>Name's Ash</td><td>has a job.</td><td>-</td></tr>
<tr><td>houston</td><td>Houston we have a problem!</td><td>shows signs of concern.</td><td>Movies/TV</td></tr>
<tr><td>howgay</td><td>How gay are you?</td><td>is very happy, thank you.</td><td>-</td></tr>
<tr><td>httk</td><td>Hail to the king, baby.</td><td></td><td>Video Games</td></tr>
<tr><td>httk2</td><td>Hail to the king!</td><td>goes medival.</td><td>-</td></tr>
<tr><td>hulk</td><td>DONT MAKE ME ANGRY!</td><td>starts to turn green.</td><td>Movies/TV</td></tr>
<tr><td>hulksad</td><td>HULK SAD :(</td><td>is not going to make it!</td><td>-</td></tr>
<tr><td>humiliation</td><td>HUMILIATION!</td><td>just totally noob'd his opponent!</td><td>Video Games</td></tr>
<tr><td>hummer</td><td>Dude, this car KICKS ASS.</td><td></td><td>Movies/TV</td></tr>
<tr><td>hustle</td><td>Do the Hustle!</td><td>does the hustle.</td><td>-</td></tr>
<tr><td>iamagod</td><td>Yes! I am a GOD!</td><td>is a god!</td><td>Video Games</td></tr>
<tr><td>iamtheone</td><td>I AM THE ONE AND ONLY!</td><td>is Chesney Hawks.</td><td>Music</td></tr>
<tr><td>ibb</td><td>I'll be back!</td><td>vow's his return.</td><td>Movies/TV</td></tr>
<tr><td>icantlose</td><td>I can't lose!</td><td>can't. Really!</td><td>-</td></tr>
<tr><td>idhitit</td><td>Give me your hearts!</td><td>would hit it.</td><td>-</td></tr>
<tr><td>idontknow</td><td>I don't even KNOW you man.</td><td>thinks you changed, bro.</td><td>-</td></tr>
<tr><td>ihavetopee</td><td>I HAVE TO PEE</td><td>is looking for the bathroom!</td><td>-</td></tr>
<tr><td>illsuck</td><td>For a thousand dollars.</td><td>enjoys meeting new people.</td><td>-</td></tr>
<tr><td>immakingcoffee</td><td>coming right up... MADAM</td><td>wants it black.</td><td>-</td></tr>
<tr><td>imp</td><td>DUN DUN DUN!</td><td>marches in lockstep.</td><td>Movies/TV</td></tr>
<tr><td>impooped</td><td>No energy or health?</td><td>is way too tired.</td><td>-</td></tr>
<tr><td>info</td><td>I'm the boss..... Need the info....</td><td>wants to know what's going on.</td><td>Movies/TV</td></tr>
<tr><td>insane</td><td>you'reinsane</td><td>didn't say anything. Are you hearing voices?</td><td>-</td></tr>
<tr><td>insult1</td><td>Your head is as empty as a eunoch's underpants!</td><td>insults you.</td><td>Etc</td></tr>
<tr><td>invofirst</td><td>I AM FIRST IN EVERYTHING</td><td>feeds hard.</td><td>-</td></tr>
<tr><td>invomatch</td><td>Like a match...</td><td>mind snuffs out.</td><td>-</td></tr>
<tr><td>invosqueek</td><td>Did I hear a squeek?</td><td>drops meatballs.</td><td>-</td></tr>
<tr><td>ious</td><td>Its official you Suck!</td><td>laughs at how bad you suck.</td><td>Video Games</td></tr>
<tr><td>irish</td><td>Everybody's a little Irish!</td><td>holds up his drink</td><td>-</td></tr>
<tr><td>isthislove</td><td>Is this Love that I'm feelin!</td><td>is Bob Marley.</td><td>-</td></tr>
<tr><td>itn</td><td>In the Navy!</td><td>wants to sail the seven seas!</td><td>Music</td></tr>
<tr><td>itsmylife</td><td>It's my life!</td><td>won't live forever!</td><td>Music</td></tr>
<tr><td>itsover</td><td>ITS OVER</td><td>casts Agidyne.</td><td>-</td></tr>
<tr><td>iwantcandy</td><td>I want candy</td><td></td><td>Music</td></tr>
<tr><td>jasb1</td><td>Jay and Silent Bob are in the house!</td><td>is stoned.</td><td>Movies/TV</td></tr>
<tr><td>jasb2</td><td>Freeze, you terrorist sons of bitches!!!</td><td>shoots Moopy.</td><td>Movies/TV</td></tr>
<tr><td>jedimaster</td><td>Don't fuck with a Jedi Master, son.</td><td>flips you off.</td><td>Etc</td></tr>
<tr><td>jeopardy</td><td>doo doo DOOOO doo</td><td>plays the jeopardy song.</td><td>Movies/TV</td></tr>
<tr><td>jugbeating</td><td>Fancy beating you here</td><td>ultis some creeps.</td><td>-</td></tr>
<tr><td>juggernaut</td><td>Don't you know who I am?</td><td>is the juggernaut, bitch!</td><td>Movies/TV</td></tr>
<tr><td>jumponit</td><td>Apache, Jump on it!</td><td>is in Drumline.</td><td>-</td></tr>
<tr><td>junes</td><td>Every days great in your...</td><td>misses dad.</td><td>-</td></tr>
<tr><td>justdance</td><td>It'll be okay!</td><td>just wants to dance.</td><td>-</td></tr>
<tr><td>kame</td><td>KAMEHAMEHA!!!</td><td>charges energy into his palms!</td><td>Movies/TV</td></tr>
<tr><td>kanjipersona</td><td>Kanji got a persona!</td><td>doesn't get to go.</td><td>-</td></tr>
<tr><td>kanjiserious</td><td>Wha?</td><td>doesn't get it.</td><td>-</td></tr>
<tr><td>katamari</td><td>NAA NANANANANA KATAMARI DAMACY!</td><td>rolls a Katamari!</td><td>Video Games</td></tr>
<tr><td>ketchup</td><td>KETCHUP SONG</td><td>asereje ja de je de jebe tu de jebere seibiunouva, majavi an de bugui an de buididipi!</td><td>Music</td></tr>
<tr><td>kicked</td><td>We came, we saw, we kicked its ass!</td><td>enjoys property damage.</td><td>-</td></tr>
<tr><td>kill</td><td>I REMEMBER YOU</td><td>flashes back a memory.</td><td>Movies/TV</td></tr>
<tr><td>killedbefore</td><td>GONNA KILL YOU</td><td>never died though!</td><td>-</td></tr>
<tr><td>killingspree</td><td>KILLING SPREE!</td><td>is on a Killing Spree!</td><td>Video Games</td></tr>
<tr><td>king</td><td>I am the king!</td><td>declares his superiority!</td><td>Music</td></tr>
<tr><td>kitty</td><td>And I dance dance dance!</td><td>is a kitty cat.</td><td>Internet</td></tr>
<tr><td>kma</td><td>Kiss my ass.</td><td>wants you to kiss his ass.</td><td>Etc</td></tr>
<tr><td>knees</td><td>On your knee, scumbag!</td><td>has a funny hat.</td><td>-</td></tr>
<tr><td>koala</td><td>KOALA</td><td></td><td>our music</td></tr>
<tr><td>koolaid</td><td>Hey! Koolaid!</td><td></td><td>Movies/TV</td></tr>
<tr><td>kotlillum</td><td>OH...there it goes!</td><td>getting too old for this.</td><td>-</td></tr>
<tr><td>krokodil</td><td>I am literally hitler</td><td>dies a little inside</td><td>-</td></tr>
<tr><td>krom2</td><td>KROM</td><td>finds a skeleton.</td><td>-</td></tr>
<tr><td>kunkka</td><td>KUNKKKAAAAAA</td><td>ravages creeps.</td><td>-</td></tr>
<tr><td>kunkset</td><td>You set sail...for fail!</td><td>buys shadowblades.</td><td>-</td></tr>
<tr><td>l2p</td><td>LEARN 2 PLAY</td><td>demands that you play wow every day.</td><td>Internet</td></tr>
<tr><td>l2plong</td><td>You've got to play every day.</td><td>has to play wow.</td><td>Internet</td></tr>
<tr><td>lady</td><td>I am a lady!</td><td>expresses his femininity.</td><td>Etc</td></tr>
<tr><td>landdownunder</td><td>Livin' in a land down under!</td><td>is moving to Australia.</td><td>-</td></tr>
<tr><td>lara</td><td>Lara Croft</td><td></td><td>our music</td></tr>
<tr><td>laser</td><td>Had to have laser!</td><td>is taken out of context.</td><td>-</td></tr>
<tr><td>lean</td><td>Lean on me!</td><td>needs to be leaned on.</td><td>-</td></tr>
<tr><td>leek</td><td>Yaa tsi tsup ari..</td><td>spins a leek.</td><td>Music</td></tr>
<tr><td>leeroy</td><td>invokes the power of Leeroy Jenkins!</td><td>invokes the power of Leeroy Jenkins!</td><td>Internet</td></tr>
<tr><td>leeroychicken</td><td>At least I have chicken!</td><td>has some chicken.</td><td>Internet</td></tr>
<tr><td>legshurt</td><td>My legs hurt</td><td>let's you in on the secret</td><td>-</td></tr>
<tr><td>lesbian</td><td>You're a lesbian.</td><td>is from the Isle of Lesbos.</td><td>-</td></tr>
<tr><td>lesbian2</td><td>you're a lesbian</td><td>just experimented in college.</td><td>-</td></tr>
<tr><td>letsdothis</td><td>LETS DO THIS!</td><td>summons a ninja frog.</td><td>-</td></tr>
<tr><td>lfl</td><td>Lets fighting love!</td><td></td><td>Movies/TV</td></tr>
<tr><td>lgw</td><td>LETS GET WEIRD</td><td>likes to chant.</td><td>-</td></tr>
<tr><td>lgwtheme</td><td>AHI</td><td>screams in whiteface.</td><td>-</td></tr>
<tr><td>liarwhore</td><td>Liar, liar, whore!</td><td>knows it.</td><td>-</td></tr>
<tr><td>life</td><td>Live your Life!</td><td>has no life.</td><td>-</td></tr>
<tr><td>lifeforce</td><td>Your lifeforce is running out!</td><td>asks where the food is.</td><td>-</td></tr>
<tr><td>likedudes</td><td>YOU SAYIN I LIKE DUDES?</td><td>loves GIRLS I LOVE GIRLS.</td><td>-</td></tr>
<tr><td>lind</td><td>LOVE IS IN DANGER!</td><td>is in danger!</td><td>Music</td></tr>
<tr><td>lionsleeps</td><td>In the jungle the mighty jungle!</td><td>goes into cat form.</td><td>-</td></tr>
<tr><td>listen</td><td>listen listen LISTEN!</td><td>is sick of your shit.</td><td>-</td></tr>
<tr><td>livetowin</td><td>Live! To! Win! 'Till you die!</td><td>is ready to grind on some boars!</td><td>Music</td></tr>
<tr><td>llap</td><td>Live long and prosper.</td><td>gives you the Vulcan hand sign.</td><td>Movies/TV</td></tr>
<tr><td>lls</td><td>LOVE LOVE SHINE!</td><td>wants to DDR!</td><td>Music</td></tr>
<tr><td>loca</td><td>Livin' La Vida Loca!</td><td>is going crazy.</td><td>-</td></tr>
<tr><td>lolguild</td><td>Weee represent...</td><td></td><td>-</td></tr>
<tr><td>lollipop</td><td>Sunshine and lollipops!!!</td><td>is elated.</td><td>Music</td></tr>
<tr><td>lookin</td><td>Here's lookin at you kid!</td><td>gives you a wink.</td><td>Movies/TV</td></tr>
<tr><td>loser</td><td>LOL YOU LOSER!</td><td>laughs at your moronic actions.</td><td>Movies/TV</td></tr>
<tr><td>lovethemballs</td><td>These balls are on fire!</td><td>doesn't join.</td><td>-</td></tr>
<tr><td>luvya</td><td>I love ya man</td><td></td><td>Etc</td></tr>
<tr><td>macarena</td><td>MACARENA</td><td>does the macarena.</td><td>Music</td></tr>
<tr><td>macho</td><td>Macho Macho Man!</td><td>is strong.</td><td>-</td></tr>
<tr><td>madness</td><td>This is madness!</td><td>kicks his enemies into a bottomless pit</td><td>Movies/TV</td></tr>
<tr><td>magic</td><td>Oh, ho, ho, it's magic!</td><td>does a little magic.</td><td>Music</td></tr>
<tr><td>makelove</td><td>I'm gonna make love to you woman!!</td><td>propositions you.</td><td>Music</td></tr>
<tr><td>mamap</td><td>little DUMPLIN?</td><td>raises a finger.</td><td>-</td></tr>
<tr><td>mambo</td><td>One, two, three four five!</td><td>is a pimp.</td><td>Music</td></tr>
<tr><td>mana</td><td>Manamana!</td><td>is a muppet!</td><td>Music</td></tr>
<tr><td>manalong</td><td>Manah manah!</td><td>is a muppet!</td><td>Music</td></tr>
<tr><td>margarita</td><td>Wastin' Away again in Margaritaville!</td><td>has been drinking.</td><td>-</td></tr>
<tr><td>mario</td><td>Do the Mario!</td><td>swings their arms from side to side.</td><td>-</td></tr>
<tr><td>marvin</td><td>I shot marvin!</td><td>needs to clean the car.</td><td>-</td></tr>
<tr><td>maryj</td><td>LSD IS THE BOMB</td><td>is a gateway drug.</td><td>-</td></tr>
<tr><td>matrix</td><td>THERE IS NO SPOON!</td><td>dodges bullets.</td><td>Movies/TV</td></tr>
<tr><td>mayo</td><td>My main man...</td><td>is whiter than wonderbread.</td><td>-</td></tr>
<tr><td>mcraiders</td><td>MC Raiders!</td><td></td><td>Internet</td></tr>
<tr><td>medieval</td><td>Get medieval on your ass.</td><td>hates rednecks.</td><td>-</td></tr>
<tr><td>meeposize</td><td>I guess size ain't everything</td><td>has low self esteem.</td><td>-</td></tr>
<tr><td>meepotough</td><td>Who's the tough guy now?</td><td>is never alone.</td><td>-</td></tr>
<tr><td>melted</td><td>My intelligence circuits have melted</td><td>wants to take a break</td><td>Movies/TV</td></tr>
<tr><td>mercy</td><td>Am I not merciful?</td><td>gives a thumbs up.</td><td>-</td></tr>
<tr><td>mesohorny</td><td>Me love you long time!</td><td>just wants two dollars.</td><td>-</td></tr>
<tr><td>mess</td><td>WHAT A MESS!</td><td>equips the mighty boot.</td><td>-</td></tr>
<tr><td>messiah</td><td>Where's your messiah now?</td><td></td><td>-</td></tr>
<tr><td>milks</td><td>Milkshake!</td><td>claims their milkshake is better.</td><td>Music</td></tr>
<tr><td>milkshakedrink</td><td>I DRINK it up.</td><td>reaches acrooooos the room.</td><td>-</td></tr>
<tr><td>mining</td><td>Day is never finished. Masters got me working.</td><td></td><td>Movies/TV</td></tr>
<tr><td>minty</td><td>Minty fresh.</td><td>practices good hygine.</td><td>-</td></tr>
<tr><td>mission</td><td>We're on a mission from God!</td><td>looks up at the sky...</td><td>Etc</td></tr>
<tr><td>missionimp</td><td>Goes into stealth mode*</td><td></td><td>Music</td></tr>
<tr><td>mkedit</td><td>Test your might.</td><td></td><td>Music</td></tr>
<tr><td>mkill</td><td>MONSTER KILL!</td><td>is a monster!</td><td>Video Games</td></tr>
<tr><td>ml</td><td>It's a MAGICAL Leopleurodon!</td><td>stands in disbelief.</td><td>-</td></tr>
<tr><td>mmd</td><td>Go ahaed! Make my day!</td><td>looks at you menacingly.</td><td>Movies/TV</td></tr>
<tr><td>mmmbop</td><td>Mmm bop!</td><td></td><td>Music</td></tr>
<tr><td>mondays</td><td>A case of the mondays!</td><td>asks you to hold please.</td><td>-</td></tr>
<tr><td>mormon</td><td>Are you a mormon?</td><td>has 100% accuracy.</td><td>-</td></tr>
<tr><td>mortal</td><td>MORTAL KOMBAT!</td><td>scores BRUTALITY!</td><td>Music</td></tr>
<tr><td>moskau</td><td>MOSKAU! MOSKAU!</td><td>does the Russian Moskau dance.</td><td>Music</td></tr>
<tr><td>mrazik</td><td>Pockej Ivane</td><td>Wait %T</td><td>our music</td></tr>
<tr><td>mrburns</td><td>Excellent!</td><td>is pleased</td><td>-</td></tr>
<tr><td>mreh</td><td>MREH</td><td>mrehs</td><td>Etc</td></tr>
<tr><td>mrt</td><td>I'm Mr. T, and I'm a night elf mohawk.</td><td></td><td>Video Games</td></tr>
<tr><td>mtrain</td><td>My baby takes the morning train!</td><td>is in love.</td><td>Music</td></tr>
<tr><td>muchbetter</td><td>Ahhhhh, much better!</td><td>lets loose.</td><td>-</td></tr>
<tr><td>muda</td><td>MUDADA!</td><td>does not think so!</td><td>Video Games</td></tr>
<tr><td>mudabu</td><td>MUDABUDABUDA!</td><td>unleashes a flurry of punches!</td><td>Video Games</td></tr>
<tr><td>murders</td><td>Who wants to talk about MURDER?</td><td>loves murder!</td><td>-</td></tr>
<tr><td>murloc</td><td>RLRLRLRLGLRLGLR</td><td>is a murloc!</td><td>Video Games</td></tr>
<tr><td>musicclub</td><td>Who wants to help?</td><td>is like 10 or something.</td><td>-</td></tr>
<tr><td>mvc2</td><td>Take you for a ride!</td><td>picks Cable.</td><td>-</td></tr>
<tr><td>nahpah</td><td>NAHHH PAH!</td><td>has a strong backhand!</td><td>-</td></tr>
<tr><td>nanaleader</td><td>Nananananananana Leader!</td><td>wants to be the leader!</td><td>-</td></tr>
<tr><td>nannerpuss</td><td>You can call me nannerpuss!</td><td>wants a Denny's Grand Slam.</td><td>-</td></tr>
<tr><td>napoleon</td><td>You know this boogie is for real.</td><td>shows his boogie dance skills! Gosh!</td><td>Music</td></tr>
<tr><td>narnia</td><td>Prepare to battle!</td><td>fights in Narnia.</td><td>-</td></tr>
<tr><td>naruto</td><td>NARUTARD POWA!</td><td>has gone beserk because their seal is broken!</td><td>Movies/TV</td></tr>
<tr><td>nedm</td><td>N E D M</td><td>thinks not even Doom music would make this better.</td><td>Music</td></tr>
<tr><td>needfood</td><td>Needs food badly!</td><td>shot the food.</td><td>-</td></tr>
<tr><td>nerds</td><td>Calling all nerds!</td><td>loves anime.</td><td>-</td></tr>
<tr><td>niceracklesh</td><td>Nice rack leshrac!</td><td>has an impressive rack.</td><td>-</td></tr>
<tr><td>ninja</td><td>GO NINJA GO NINJA GO!</td><td>busts out the ninja moves!</td><td>-</td></tr>
<tr><td>nint64</td><td>OMG NINTENDO SIXTYFOUR!!!</td><td>tears furiously into the loots!</td><td>Internet</td></tr>
<tr><td>nobodyfucks</td><td>Nobody fucks with the Jesus</td><td>loves bowling.</td><td>-</td></tr>
<tr><td>noclues</td><td>We've got no clues...</td><td>likes contractions.</td><td>-</td></tr>
<tr><td>nof</td><td>NIGHT OF FIRE!</td><td>hopes you better say...</td><td>Music</td></tr>
<tr><td>nofault</td><td>It's not my fault</td><td>pleades innocence.</td><td>Internet</td></tr>
<tr><td>nograsp</td><td>People have no grasp.</td><td>is also Mufasa and Vader.</td><td>-</td></tr>
<tr><td>noink</td><td>NOINK</td><td>kicks you into space.</td><td>-</td></tr>
<tr><td>nonstop</td><td>I want nonstop life*</td><td></td><td>our music</td></tr>
<tr><td>noo</td><td>NOOOOOOOOO!</td><td></td><td>Movies/TV</td></tr>
<tr><td>nopurpose</td><td>This conversation can serve no purpose.</td><td>will not talk anymore.</td><td>-</td></tr>
<tr><td>notallright</td><td>NO NOT ALRIGHT</td><td>is not cool with it.</td><td>-</td></tr>
<tr><td>notgoingdown</td><td>Its not going down!</td><td>expects the oneshot.</td><td>-</td></tr>
<tr><td>notsure</td><td>I'm not sure...</td><td>is probably racist.</td><td>-</td></tr>
<tr><td>noway</td><td>NO WAAYYYYY</td><td>obviously loses.</td><td>-</td></tr>
<tr><td>numa</td><td>Numa numa yay!</td><td>is an internet phenomenon!</td><td>Internet</td></tr>
<tr><td>numa2</td><td>When you leave my colors fade to grey!</td><td>is an english internet phenomenon.</td><td>-</td></tr>
<tr><td>numalong</td><td>Mai ya heee! Mai ya hooo!</td><td>is an internet phenomenon!</td><td>Internet</td></tr>
<tr><td>numalong2</td><td>Mai ya hee! Mai ya hoo!</td><td>is an english internet phenomenon.</td><td>-</td></tr>
<tr><td>numb</td><td>Linkin Park Numb</td><td></td><td>our music</td></tr>
<tr><td>numnuts</td><td>What is your major malfunction Numnuts*</td><td>slaps you silly and tells you to drop and give him 20.</td><td>Movies/TV</td></tr>
<tr><td>nyan</td><td>NYANYANYANYANYANYA</td><td>turns into a poptart and poops a rainbow!.</td><td>-</td></tr>
<tr><td>nyxnyx</td><td>Nyxnyxnyx</td><td>is behind you.</td><td>-</td></tr>
<tr><td>oc</td><td>Mmmm, watchya saayay</td><td>shoots a friend.</td><td>Music</td></tr>
<tr><td>odbadnews</td><td>I bring bad news..</td><td>loves to be the bearer.</td><td>-</td></tr>
<tr><td>odhard</td><td>Hard carry?</td><td>plays support.</td><td>-</td></tr>
<tr><td>offer</td><td>I'm gonna make you an offer you can't refuse.</td><td>makes you an offer you can't refuse.</td><td>Movies/TV</td></tr>
<tr><td>og</td><td>I AM THE ONLY GAY IN THE VILLAGE!</td><td>is the only gay in the village.</td><td>Etc</td></tr>
<tr><td>ohsnap</td><td>OH SNAP!</td><td>is suprized.</td><td>Etc</td></tr>
<tr><td>ohyeah</td><td>OH YEAH!</td><td>is the pimp daddy!</td><td>Etc</td></tr>
<tr><td>okiedokie</td><td>OKIE DOKIE!</td><td>can't dance.</td><td>-</td></tr>
<tr><td>omface</td><td>Two heads are better than none!</td><td>can't count to two.</td><td>-</td></tr>
<tr><td>omlaugh</td><td>What we laughin about?</td><td>saw a squirrel.</td><td>-</td></tr>
<tr><td>omlose</td><td>We won!</td><td>is dissapointed now.</td><td>-</td></tr>
<tr><td>omnumber</td><td>We got your number!</td><td>counts on fingers.</td><td>-</td></tr>
<tr><td>omonce</td><td>Once is not enough!</td><td>can count to potato.</td><td>-</td></tr>
<tr><td>omskill</td><td>OH! Skill shot!</td><td>isn't lucky.</td><td>-</td></tr>
<tr><td>onemore</td><td>You ask me another question...</td><td>looks menacing.</td><td>Etc</td></tr>
<tr><td>onenightoflove</td><td>I'll swing at it!</td><td>shoots stars out of their eyes.</td><td>-</td></tr>
<tr><td>ooga</td><td>OOGACHAKA</td><td>grunts.</td><td>Etc</td></tr>
<tr><td>oompa</td><td>Oompa Loompa Doopity Doo</td><td>shrinks in size.</td><td>-</td></tr>
<tr><td>oral</td><td>I know what the ladies like... </td><td>lies back...</td><td>-</td></tr>
<tr><td>ouch</td><td>OUCH</td><td>has a booboo.</td><td>-</td></tr>
<tr><td>ourchance</td><td>Aha! Is this our chance?</td><td>is ready!</td><td>-</td></tr>
<tr><td>outofbourbon</td><td>Dad will be home soon...</td><td>ate a science project.</td><td>-</td></tr>
<tr><td>over9000</td><td>IT'S OVER 9000!!</td><td></td><td>Internet</td></tr>
<tr><td>overweight</td><td>you're overweight</td><td>tips the scales.</td><td>-</td></tr>
<tr><td>oyster</td><td>Uh, the world is your oyster!</td><td>has the whole world.</td><td>-</td></tr>
<tr><td>pacman</td><td>*bloop bloop bloop</td><td>spins in a circle.</td><td>-</td></tr>
<tr><td>panther</td><td>Smooth baby!</td><td>feels a little pink!</td><td>Music</td></tr>
<tr><td>party1</td><td>When it's time to party</td><td>is ready to PARTY</td><td>Music</td></tr>
<tr><td>party2</td><td>We do what we like!</td><td>likes what he does!</td><td>Music</td></tr>
<tr><td>party3</td><td>Let's get a party going!</td><td>will always party hard!</td><td>Music</td></tr>
<tr><td>pbj</td><td>It's peanut butter jelly time!</td><td>wants to know where you at.</td><td>Internet</td></tr>
<tr><td>pcload</td><td>PC load letter??</td><td>doesn't like Micheal Bolton.</td><td>-</td></tr>
<tr><td>peewee</td><td>Pee wee speaking!</td><td>is silly</td><td>Movies/TV</td></tr>
<tr><td>peeweela</td><td>LAALAALAALAALAALAALAAA!</td><td>acts silly</td><td>Movies/TV</td></tr>
<tr><td>peeweelol</td><td>ha ha ha! AAHH!! ha ha!</td><td>laughs</td><td>Movies/TV</td></tr>
<tr><td>peterlol</td><td>eheheh heh heh</td><td></td><td>Movies/TV</td></tr>
<tr><td>peterlol2</td><td>heheh heheh</td><td></td><td>Movies/TV</td></tr>
<tr><td>peterlol3</td><td>eheheheh</td><td></td><td>Movies/TV</td></tr>
<tr><td>petersoap</td><td>All the rumors about dropping the soap are true</td><td>dropped the soap.</td><td>Movies/TV</td></tr>
<tr><td>pg</td><td>Pussy gnomes.</td><td>kicks the gnome, OH going, going gone. TOUCHDOWN.</td><td>Movies/TV</td></tr>
<tr><td>pi</td><td>3.141592653589793238..</td><td>3.14159265358979323846264338327950288419716939937510</td><td>Music</td></tr>
<tr><td>picard</td><td>Captain Jean Luc Picard.</td><td>of the USS. Enterprise</td><td>Internet</td></tr>
<tr><td>picardlong</td><td>Captain.  Jean Luc Picard.</td><td>of the USS. Enterprise</td><td>Internet</td></tr>
<tr><td>pigma</td><td>Daddy screamed REALLLLL good!</td><td>finally does a barrel roll.</td><td>-</td></tr>
<tr><td>pill</td><td>CRAZY PILLS!</td><td>is going crazy!</td><td>Movies/TV</td></tr>
<tr><td>pirate</td><td>Do what you want 'cuz a pirate is free...</td><td>is a pirate!</td><td>Music</td></tr>
<tr><td>pkmn</td><td>Gotta catch em all!</td><td>knows it is their destiny!</td><td>Movies/TV</td></tr>
<tr><td>pkmn2</td><td>Wild NUB wants to fight!</td><td>chooses you!</td><td>Movies/TV</td></tr>
<tr><td>playtime</td><td>Playtime's Over!</td><td>still wants to play.</td><td>-</td></tr>
<tr><td>plnumber</td><td>We out number you...</td><td>whacks you with a spear.</td><td>-</td></tr>
<tr><td>poc</td><td>THE POWER OF CHRIST COMPELS YOU!</td><td>tries to get the demons out of you.</td><td>Etc</td></tr>
<tr><td>pokemon</td><td>Pokemon Johto league</td><td></td><td>-</td></tr>
<tr><td>pond</td><td>Stick to the pond!</td><td>loves shooting frogs.</td><td>-</td></tr>
<tr><td>porn</td><td>PORN</td><td>rickrolls you!</td><td>Etc</td></tr>
<tr><td>portal</td><td>for the people who are still alive</td><td></td><td>Music</td></tr>
<tr><td>pos</td><td>That is one BIG pile of shit!</td><td>looks concerned.</td><td>Etc</td></tr>
<tr><td>posral</td><td>Cos to delal omg?</td><td>se smeje ze to posral...</td><td>our music</td></tr>
<tr><td>power</td><td>BY THE POWER OF GREYSKULL</td><td>screams BY THE POWER OF GREYSKULL!</td><td>Movies/TV</td></tr>
<tr><td>powerlevel</td><td>What's his power level?</td><td></td><td>Internet</td></tr>
<tr><td>prayformojo</td><td>Pray for Mojo</td><td>is all out of ideas!</td><td>-</td></tr>
<tr><td>prebeared</td><td>BEAR PUN</td><td>gets beary excited.</td><td>-</td></tr>
<tr><td>prepare</td><td>PREPARE TO FIGHT!</td><td>hits B, 8, 2, B, 4, 2, B, 1, and 4!</td><td>Video Games</td></tr>
<tr><td>prime</td><td>Well, that's just Prime.</td><td>looks annoyed.</td><td>Etc</td></tr>
<tr><td>prince</td><td>Good night, sweet prince</td><td>says good night.</td><td>-</td></tr>
<tr><td>professor</td><td>Futurama and Professor Hubert J Farnsworth</td><td>nese dobr? zpr?vy</td><td>-</td></tr>
<tr><td>profound</td><td>I'm going to say something amazingly profound right now.</td><td>is a genius.</td><td>-</td></tr>
<tr><td>puckout</td><td>PUCK. OUT.</td><td>is outta here.</td><td>-</td></tr>
<tr><td>puckrare</td><td>Hatched on a frond of the undertree...</td><td>consumes roots and stalks.</td><td>-</td></tr>
<tr><td>pudapple</td><td>You'll look good...</td><td>loves apples.</td><td>-</td></tr>
<tr><td>pudfirst</td><td>Do I have juice on my chins?</td><td>feeds first.</td><td>-</td></tr>
<tr><td>pudhook</td><td>Reel 'em in!</td><td>hooks allies.</td><td>-</td></tr>
<tr><td>pudmiss</td><td>BLOODY creeps!</td><td>does it on purpose.</td><td>-</td></tr>
<tr><td>pussy</td><td>Is that all you got pussy.</td><td></td><td>Movies/TV</td></tr>
<tr><td>pwrr</td><td>GO GO POWER RANGERS!</td><td>thinks its morphin time!</td><td>Movies/TV</td></tr>
<tr><td>qcf</td><td>Hadoken!</td><td>moves down, downforward, forward.</td><td>-</td></tr>
<tr><td>qoplittle</td><td>Such a little death!</td><td>likes it anyway.</td><td>-</td></tr>
<tr><td>rabies</td><td>It bit me.</td><td></td><td>Etc</td></tr>
<tr><td>rainingmen</td><td>It's raining men!</td><td></td><td>Music</td></tr>
<tr><td>rampage</td><td>RAMPAGE!</td><td>is on a RAMPAGE!</td><td>Video Games</td></tr>
<tr><td>raped</td><td>My God!</td><td>blows a whistle.</td><td>-</td></tr>
<tr><td>razordead</td><td>dead...DEAD</td><td>is shocked!</td><td>-</td></tr>
<tr><td>razorforever</td><td>This will only hurt... Forever!</td><td>whips it good.</td><td>-</td></tr>
<tr><td>redalert</td><td>Red Alert. Battle stations.</td><td>commands you to go to your battle station.</td><td>Movies/TV</td></tr>
<tr><td>replicants</td><td>Like any other machine.</td><td>call you brade runnah.</td><td>-</td></tr>
<tr><td>repressed</td><td>HELP HELP I'M BEIN REPRESSED!</td><td>is being REPRESSED!</td><td>Movies/TV</td></tr>
<tr><td>requiem</td><td>Requiem for a Dream</td><td></td><td>our music</td></tr>
<tr><td>rff</td><td>FEUER FREI!</td><td>points at the enemy!</td><td>Music</td></tr>
<tr><td>rickjames</td><td>Im Rickjames bitch.</td><td>slaps you for 1000 dmg.</td><td>Movies/TV</td></tr>
<tr><td>rickroll</td><td>RICKROLLED!</td><td>rickrolls you!</td><td>Music</td></tr>
<tr><td>rimshot</td><td>buh dum chish!</td><td>only tells bad puns.</td><td>-</td></tr>
<tr><td>rip</td><td>Yeah. RIP.</td><td>didn' ask for this.</td><td>-</td></tr>
<tr><td>rit9</td><td>Running in the 90's!</td><td>wants to run in the 90s!</td><td>Music</td></tr>
<tr><td>rockandroll</td><td>I want to rock and roll all night!</td><td></td><td>Music</td></tr>
<tr><td>rockboat</td><td>Rock the boat, Don't rock the boat baby!</td><td>fails at life.</td><td>-</td></tr>
<tr><td>rocky</td><td>Who wants to PVP!</td><td>is ready for some PVP!</td><td>Movies/TV</td></tr>
<tr><td>rockyou</td><td>We will, We will Rock you!</td><td>stomps his feet.</td><td>-</td></tr>
<tr><td>rof</td><td>Ring of fire!</td><td>goes down down down.</td><td>-</td></tr>
<tr><td>rollout</td><td>Autobots, transform and roll out.</td><td>tells everyone to rollout.</td><td>Movies/TV</td></tr>
<tr><td>roomfist</td><td>Leave enough room for my fist!</td><td>is sick of running.</td><td>-</td></tr>
<tr><td>roomwhore</td><td>EVERYONE IN THIS ROOM IS A WHORE</td><td>grabs a chasity belt.</td><td>-</td></tr>
<tr><td>rosham</td><td>Wants to roshambo you for it.</td><td>challenges you to a rhoshambo contest.</td><td>Movies/TV</td></tr>
<tr><td>royale</td><td>Royale with cheese</td><td>is burgin.</td><td>-</td></tr>
<tr><td>rsry</td><td>I'm really really sorry!</td><td>apologises profusely.</td><td>Etc</td></tr>
<tr><td>rumble</td><td>Let's get ready to rumble!!!</td><td>is ready for some action.</td><td>-</td></tr>
<tr><td>runaway</td><td>Run Away to save your life!</td><td>starts to run.</td><td>-</td></tr>
<tr><td>rush</td><td>Charge!</td><td>orders everyone to charge!</td><td>Etc</td></tr>
<tr><td>ruska</td><td>RUSSIA</td><td></td><td>our music</td></tr>
<tr><td>saber1</td><td>KSSHHH wooOOooo*</td><td>pulls out his lightsaber</td><td>Movies/TV</td></tr>
<tr><td>saber2</td><td>WHOOM KSHH WHOM KSHH KSHH*</td><td>is a jedi</td><td>Movies/TV</td></tr>
<tr><td>safetydance</td><td>We can dance if we want to, we can leave your friends behind!</td><td>wants to dance.</td><td>-</td></tr>
<tr><td>safetydance2</td><td>We can go where we want to, a place where they will never find!</td><td>really wants to dance.</td><td>-</td></tr>
<tr><td>sailor</td><td>Sailing, Sailing, til the ship is sinking!</td><td>jumps on the Titanic.</td><td>-</td></tr>
<tr><td>salami</td><td>Slipping her the old salami.</td><td></td><td>Movies/TV</td></tr>
<tr><td>sandlol</td><td>SANDLOL!</td><td>has got a jar of dirt!</td><td>Etc</td></tr>
<tr><td>sandman</td><td>Enter Sandman!</td><td></td><td>-</td></tr>
<tr><td>savebabies</td><td>Lets. Save. Some. BABIES!</td><td>thinks of the children.</td><td>-</td></tr>
<tr><td>savekeys</td><td>Save your keys!</td><td>doesn't know how locks work.</td><td>-</td></tr>
<tr><td>sayhello</td><td>Say hello to my little friend.</td><td></td><td>Movies/TV</td></tr>
<tr><td>saywhat</td><td>Say what again!</td><td>doesn't like to repeat.</td><td>-</td></tr>
<tr><td>scumbag</td><td>Were you born a scumbag?</td><td>thinks your a scumbag.</td><td>Movies/TV</td></tr>
<tr><td>sdurn</td><td>I'll rip your head off!</td><td>has a mighty kick.</td><td>-</td></tr>
<tr><td>sega</td><td>SEEEEGAAA</td><td>owns a genesis.</td><td>-</td></tr>
<tr><td>sexything</td><td>You sexy thing!</td><td>believes in miracles.</td><td>Music</td></tr>
<tr><td>sf3</td><td>Make your first pick!</td><td>parries all your attacks!</td><td>-</td></tr>
<tr><td>sf4</td><td>Indestructable</td><td>uses an EX dragon punch!</td><td>-</td></tr>
<tr><td>shadowbat</td><td>Shadow of the bat!</td><td>lassos you!</td><td>-</td></tr>
<tr><td>shadowform</td><td>Is shadowform okay?</td><td>is itchy to melt faces.</td><td>Internet</td></tr>
<tr><td>shag</td><td>You're shagadelic baby!</td><td>is looking at you groovy!</td><td>Movies/TV</td></tr>
<tr><td>sharper</td><td>Where do we keep the swords?</td><td>picks the katana.</td><td>-</td></tr>
<tr><td>shatner</td><td>Hello, I'm William Shatner.</td><td></td><td>Video Games</td></tr>
<tr><td>shayne</td><td>No promises</td><td>bez slibu</td><td>our music</td></tr>
<tr><td>sheesh</td><td>That hurt!</td><td>lands butt first.</td><td>-</td></tr>
<tr><td>shocking</td><td>SHOCKING</td><td>can't deal.</td><td>-</td></tr>
<tr><td>shoes</td><td>Shoes... Oh My God Shoes</td><td>get what they want.</td><td>-</td></tr>
<tr><td>shootfood</td><td>Don't shoot the food!</td><td>needed that food, badly.</td><td>-</td></tr>
<tr><td>shopsmart</td><td>Shop S-mart!</td><td>has a hair trigger.</td><td>-</td></tr>
<tr><td>shotgun</td><td>Shotgun chambering</td><td>gets the boomstick ready.</td><td>-</td></tr>
<tr><td>shrimp</td><td>Let's throw another shrimp on the barbie!</td><td>is getting excited!</td><td>Etc</td></tr>
<tr><td>shun</td><td>Shuuuuunnn!</td><td></td><td>Internet</td></tr>
<tr><td>shutup</td><td>Hahahaha SHUT UP*</td><td></td><td>Movies/TV</td></tr>
<tr><td>shutupkanji</td><td>Why did you bring trunks for me too?</td><td>wants to go swimming.</td><td>-</td></tr>
<tr><td>sidious</td><td>Wipe them out. All of them</td><td>tells you to kill them all.</td><td>Movies/TV</td></tr>
<tr><td>silite</td><td>Co silite?</td><td>vas fakt nechape...</td><td>our music</td></tr>
<tr><td>sis</td><td>You can come over to my house and fuck my sister!</td><td></td><td>Etc</td></tr>
<tr><td>skdebt</td><td>MY SWORD COLLECTS</td><td>only right clicks.</td><td>-</td></tr>
<tr><td>slicesofcheese</td><td>Mmmm 64 slices of American cheese</td><td>has a snack!</td><td>-</td></tr>
<tr><td>smallpenis</td><td>you have a small penis you fag</td><td>might be taken out of context.</td><td>-</td></tr>
<tr><td>smellslikeass</td><td>Oh man it smells like ass</td><td></td><td>Movies/TV</td></tr>
<tr><td>smokin</td><td>SMOKIN!</td><td>is smokin!</td><td>Etc</td></tr>
<tr><td>snickers</td><td>Happy Peanut song...</td><td>walks up to you and sings.</td><td>-</td></tr>
<tr><td>snoopdrew</td><td>Hizzel</td><td>knows whats cool.</td><td>-</td></tr>
<tr><td>sociallinkgo</td><td>SOCIAL LINK: GO!</td><td>grinds friends.</td><td>-</td></tr>
<tr><td>sociallinks</td><td>SOCIALLINKSSOCIALLINKS</td><td>has a pointy nose.</td><td>-</td></tr>
<tr><td>soldier</td><td>He would not have created ME!</td><td>rocket jumps.</td><td>-</td></tr>
<tr><td>sonic</td><td>Invincible!</td><td>gotta go fast.</td><td>-</td></tr>
<tr><td>sonicrings</td><td>Sonic Rings Out</td><td>jumps on spikes.</td><td>-</td></tr>
<tr><td>spinnaz</td><td>I ride spinnaz... they don't stop...</td><td>rides spinnaz, also loots!</td><td>Etc</td></tr>
<tr><td>sports</td><td>Not a recreational sport</td><td>thinks it is.</td><td>-</td></tr>
<tr><td>spot</td><td>Well, that hit the spot!</td><td>spits out a one liner.</td><td>-</td></tr>
<tr><td>ssfart</td><td>Surround sound fart!</td><td>farts all around you.</td><td>Etc</td></tr>
<tr><td>ssshack</td><td>NYAH AH TAYA</td><td>put points into Q.</td><td>-</td></tr>
<tr><td>sssunday</td><td>I CAN'T WORK UNDER THESE CONDITIONS</td><td>will be in their trailer</td><td>-</td></tr>
<tr><td>standbyme</td><td>Darlin, Darlin Stand, By Me</td><td>needs someone to stand next to.</td><td>-</td></tr>
<tr><td>stapler</td><td>I believe you have my stapler?</td><td>will set this place on fire.</td><td>-</td></tr>
<tr><td>startrek</td><td>Star Trekking accross the universe!</td><td>is a tekky!</td><td>Etc</td></tr>
<tr><td>startrun</td><td>Start running!</td><td>wins the home game.</td><td>-</td></tr>
<tr><td>stayalive</td><td>Ah, ah ah ah stayin alive!!</td><td>looks like John Trovolta.</td><td>Music</td></tr>
<tr><td>stickyourhand</td><td>DOITDOITDOIT</td><td>listens to appliances.</td><td>-</td></tr>
<tr><td>stole</td><td>STOLE MY FLAG!</td><td>chases after their flag thief.</td><td>Etc</td></tr>
<tr><td>stopfighting</td><td>ARE YOU FIGHTING??</td><td>has enough issues.</td><td>-</td></tr>
<tr><td>stopit</td><td>STOP IT</td><td>wants you to stop.</td><td>Movies/TV</td></tr>
<tr><td>stupidlikethat</td><td>Why you gotta be stupid like that?*</td><td>does two snaps in a circle.</td><td>-</td></tr>
<tr><td>suck</td><td>You Suck!</td><td></td><td>Video Games</td></tr>
<tr><td>suf</td><td>Shut up, fool!</td><td></td><td>Misc</td></tr>
<tr><td>sunglasses</td><td>Sunglasses at night</td><td>swiches the blade on the guy in shades.</td><td>-</td></tr>
<tr><td>sunshine</td><td>I'm walking on sunshine!</td><td>is elated!</td><td>Music</td></tr>
<tr><td>surprise</td><td>SURPRISE</td><td>is one angry motha fucka.</td><td>Movies/TV</td></tr>
<tr><td>survival</td><td>I'm getting a 32.33 percent chance of survival</td><td>is calculating the odds of success.</td><td>Internet</td></tr>
<tr><td>survive</td><td>I was afraid, I was petrified!</td><td>will survive.</td><td>-</td></tr>
<tr><td>sweetfox</td><td>Check out THIS sweet fox!</td><td>got leaves YIPYIPYIP.</td><td>-</td></tr>
<tr><td>taboo2</td><td>Taboo 2 Theme*</td><td>has it all.</td><td>-</td></tr>
<tr><td>take</td><td>GIVE THEM NOTHING</td><td>is ready to TAKE FROM THEM EVERYTHING</td><td>Movies/TV</td></tr>
<tr><td>tarzan</td><td>Oh oh ooaoaoo aah! Oh oh ah!</td><td></td><td>Music</td></tr>
<tr><td>tarzanandjane</td><td>Long Hair!</td><td>swings through the jungle.</td><td>-</td></tr>
<tr><td>tasty</td><td>TASTY</td><td>is delicious.</td><td>-</td></tr>
<tr><td>tastyburger</td><td>This IS a tasty burger!</td><td>is really burgin.</td><td>-</td></tr>
<tr><td>tastywaves</td><td>and I'm fine...!</td><td>gets a cool buzz.</td><td>-</td></tr>
<tr><td>tcats</td><td>Thundercats HO</td><td>screams Thundercats HO!</td><td>Movies/TV</td></tr>
<tr><td>tears</td><td>I've seen things.</td><td>is more human than human.</td><td>-</td></tr>
<tr><td>tehpwnerer</td><td>So this one time..</td><td>is teh_pwnerer.</td><td>Internet</td></tr>
<tr><td>tequila</td><td>Tequila!</td><td></td><td>Music</td></tr>
<tr><td>texas</td><td>Steers N Queers</td><td>has fun with both rifle and gun.</td><td>-</td></tr>
<tr><td>tffm</td><td>I don't want her!</td><td>doesn't want her.</td><td>-</td></tr>
<tr><td>thatsbad</td><td>Don't cross the streams.</td><td>is fuzzy on the good bad thing.</td><td>-</td></tr>
<tr><td>thatsnogood</td><td>thats NOGOOD</td><td>gives special hugs.</td><td>-</td></tr>
<tr><td>thebest</td><td>You're the best! Around!</td><td>is in the middle of an 80s montage.</td><td>Music</td></tr>
<tr><td>theforce</td><td>The force is with you young skywalker!</td><td>feels your presence.</td><td>Movies/TV</td></tr>
<tr><td>thehorns</td><td>Mess with the bull...</td><td>gets bent.</td><td>-</td></tr>
<tr><td>theone</td><td>I am nobodys bitch. You are mine!</td><td>will be the one!</td><td>Movies/TV</td></tr>
<tr><td>thepoint</td><td>Well, back to the point...</td><td>just ignores you.</td><td>-</td></tr>
<tr><td>thepulse</td><td>Here's the pulse. Here's your finger. </td><td>tells you to get your finger out of there.</td><td>Etc</td></tr>
<tr><td>thespot</td><td>This really hits the spot...</td><td>can't bear it.</td><td>-</td></tr>
<tr><td>thetouch</td><td>You got the touch!</td><td>got the power.</td><td>-</td></tr>
<tr><td>thinking</td><td>I'm trying to think, but nothing happens!</td><td>is trying to think.</td><td>Etc</td></tr>
<tr><td>thrall</td><td>Club Thrall!</td><td>sees lots of colors!</td><td>Music</td></tr>
<tr><td>thrall2</td><td>Thralls Ball!</td><td>goes into a trance.</td><td>Music</td></tr>
<tr><td>tidecaviar</td><td>Think of it as caviar!</td><td>eats well.</td><td>-</td></tr>
<tr><td>tiger</td><td>Eye of the Tiger!</td><td>has the eye.... of the tiger!</td><td>Music</td></tr>
<tr><td>tigershot</td><td>TIGER TIGER</td><td>is cheap as all hell.</td><td>-</td></tr>
<tr><td>tigeru</td><td>TIGER UPPERCUT</td><td>only uses projectiles.</td><td>-</td></tr>
<tr><td>tiggers</td><td>I'm the only one!</td><td>dances like a tigger.</td><td>Music</td></tr>
<tr><td>timetodie</td><td>Wake up!</td><td>throws you through a wall.</td><td>-</td></tr>
<tr><td>timetolisten</td><td>Time to start listening!</td><td>is fed up.</td><td>-</td></tr>
<tr><td>to</td><td>WE'RE TRYING TO TAKE OVER THE WORLD*</td><td></td><td>Movies/TV</td></tr>
<tr><td>toast</td><td>This chick is toast!</td><td>crosses the streams.</td><td>-</td></tr>
<tr><td>toki</td><td>TOKI WO TOMARE!</td><td>prepares to unleash a barage of knives!</td><td>Video Games</td></tr>
<tr><td>toledo</td><td>Hola, mi nomre es Willy Toledo. Y soy un paladin.</td><td></td><td>Video Games</td></tr>
<tr><td>toml</td><td>I had the time of my liiife</td><td>is happy.</td><td>-</td></tr>
<tr><td>tomoe</td><td>Protect me!</td><td>is a banana dominatrix.</td><td>-</td></tr>
<tr><td>toosexy</td><td>I'm too sexy for my shirt</td><td></td><td>Music</td></tr>
<tr><td>topgun</td><td>HIGHWAY TO THE DANGER ZONE!!</td><td>RIDES INTO THE DANGER ZONE!</td><td>Music</td></tr>
<tr><td>touch</td><td>When I think about you</td><td>loves you.</td><td>Music</td></tr>
<tr><td>touchhand</td><td>Can I touch your haaaaand?</td><td>won't see this guy again!</td><td>-</td></tr>
<tr><td>tralala</td><td>Ooh, you touch my tralala...!</td><td>thinks you touched their tralala!</td><td>Music</td></tr>
<tr><td>trap</td><td>It's a trap!</td><td>has walked into a trap!</td><td>Internet</td></tr>
<tr><td>tree</td><td>Make like a tree...and get outta here!</td><td>is a bit stupid.</td><td>Movies/TV</td></tr>
<tr><td>trialofthedragon</td><td>TRIALOFTHEDRAGOOOOON</td><td>is cracked.</td><td>-</td></tr>
<tr><td>troops</td><td>Alert the troops, We attack at dawn.</td><td>Orders you to prepare for an attack.</td><td>Movies/TV</td></tr>
<tr><td>truckin</td><td>Here we come a truckin in!</td><td>goes chish chichish chichish!</td><td>-</td></tr>
<tr><td>truth</td><td>YOU CANT HANDLE THE TRUTH!</td><td>laughs at you.</td><td>Movies/TV</td></tr>
<tr><td>trynot</td><td>Do, or do not. There is no try.</td><td>becomes possessed by Yoda.</td><td>Movies/TV</td></tr>
<tr><td>tunak</td><td>Tunak Tunak Tun...</td><td>mends the tunic!</td><td>Music</td></tr>
<tr><td>tunatown</td><td>Taking the skin boat to tuna town!</td><td></td><td>Movies/TV</td></tr>
<tr><td>twilight</td><td>You're traveling to another dimension</td><td>enters the twilight zone</td><td>Movies/TV</td></tr>
<tr><td>ual</td><td>Ualuealue!</td><td>adsjhfawshfgiuadhsjnads!</td><td>Internet</td></tr>
<tr><td>ugly</td><td>You found me beautiful once!</td><td>is very superficial.</td><td>-</td></tr>
<tr><td>uhohhotdog</td><td>Uh oh! Hot dog!</td><td></td><td>Movies/TV</td></tr>
<tr><td>uhyeah</td><td>uh, yeah?</td><td>already knows.</td><td>-</td></tr>
<tr><td>ultrakill</td><td>ULTRA KILL!</td><td>has become invincible!</td><td>Video Games</td></tr>
<tr><td>unaccept</td><td>UNACCEPTABLE</td><td>is not accepting.</td><td>-</td></tr>
<tr><td>unfuck</td><td>Best unfuck yourself!</td><td>puts soap in a sock.</td><td>-</td></tr>
<tr><td>unstoppable</td><td>UNSTOPPABLE!</td><td>is unstoppable!</td><td>Video Games</td></tr>
<tr><td>vagin</td><td>I want entry to your vagin.</td><td>asks you how much you want.</td><td>Movies/TV</td></tr>
<tr><td>vagpunch</td><td>I wanna punch somebody...</td><td>goes for the haymaker.</td><td>-</td></tr>
<tr><td>vandamme</td><td>Mon nom c'est Jean Claude Van Damme, et je suis un mage.</td><td></td><td>Video Games</td></tr>
<tr><td>venga</td><td>RIDE THE VENGABUS</td><td>jumps on the Vengabus!</td><td>Music</td></tr>
<tr><td>verne</td><td>Hello, I'm Verne Troyer.</td><td></td><td>Video Games</td></tr>
<tr><td>verybad</td><td>But the car is ok?</td><td>is pretty laid back!</td><td>-</td></tr>
<tr><td>verystupid</td><td>What you just said...*</td><td>doesn't think much of your ideas.</td><td>-</td></tr>
<tr><td>vicodin</td><td>Take a little vicodin...</td><td>parties hard.</td><td>-</td></tr>
<tr><td>victory</td><td>Victory is mine.</td><td>thinks that you just got pwned.</td><td>Movies/TV</td></tr>
<tr><td>vilewoman</td><td>Damn you, vile woman!</td><td></td><td>Movies/TV</td></tr>
<tr><td>violent</td><td>Parental discretion is advised</td><td>warns everyone around him.</td><td>Etc</td></tr>
<tr><td>vnice</td><td>Very Nice!</td><td>thinks its okay I guess.</td><td>-</td></tr>
<tr><td>vyridit</td><td>Co to tady zase hrotite??</td><td></td><td>our music</td></tr>
<tr><td>waffles</td><td>Waffa waffa waffa wa waffles!</td><td>opens up a Mrs.Buttersworth.</td><td>-</td></tr>
<tr><td>wantme</td><td>Dont you want me baby</td><td>needs some love.</td><td>-</td></tr>
<tr><td>warface</td><td>Show me your WARFACE!</td><td>loves to yell.</td><td>-</td></tr>
<tr><td>watchingyou</td><td>I'll be watching you!</td><td>looks into your soul.</td><td>-</td></tr>
<tr><td>watchu</td><td>Wutchu watin for!</td><td>wonders why you wait.</td><td>Music</td></tr>
<tr><td>wdcask1</td><td>Oh, look at it go!</td><td>stuns a single creep.</td><td>-</td></tr>
<tr><td>wdcask2</td><td>CASKET!</td><td>plays catch.</td><td>-</td></tr>
<tr><td>wdwait</td><td>Wait for it...</td><td>almost got him.</td><td>-</td></tr>
<tr><td>weakestlink</td><td>You are the weakest link!</td><td>insults you.</td><td>Etc</td></tr>
<tr><td>weed</td><td>THE WEED</td><td>has reefer madness.</td><td>-</td></tr>
<tr><td>whatchu</td><td>Wutchu watin for!</td><td>wonders why you wait.</td><td>-</td></tr>
<tr><td>whatever1</td><td>whatever</td><td>talks to the hand.</td><td>-</td></tr>
<tr><td>whatever2</td><td>yeahwhatever</td><td>just doesn't get it</td><td>-</td></tr>
<tr><td>whatever3</td><td>whatever!</td><td>unites states of whatever.</td><td>-</td></tr>
<tr><td>whatever4</td><td>yeah,whatever!</td><td>shoots dice in the ally.</td><td>-</td></tr>
<tr><td>whateverkanji</td><td>...whatever...</td><td>didn't want to get bent.</td><td>-</td></tr>
<tr><td>whatislove</td><td>WHAT IS LOVE?</td><td>swings head back and forth in rhythm.</td><td>Music</td></tr>
<tr><td>whelps</td><td>WHELPS!</td><td>aggroed the whelp cave!</td><td>Internet</td></tr>
<tr><td>whine</td><td>STOP WHINING!</td><td>says stop whining!</td><td>Movies/TV</td></tr>
<tr><td>whip</td><td>wha-PISH!</td><td>is whipped...</td><td>-</td></tr>
<tr><td>whocares</td><td>whoooooo cares??</td><td>certainly doesn't.</td><td>-</td></tr>
<tr><td>whoopass</td><td>I AM a can of whoop ass!</td><td>gets scepter first.</td><td>-</td></tr>
<tr><td>whore</td><td>You stinkin' whore!</td><td>think $15 is too much.</td><td>-</td></tr>
<tr><td>whothefuck</td><td>Who the fuck are you?</td><td>does not abide.</td><td>-</td></tr>
<tr><td>willtell</td><td>William Tell Overture!</td><td></td><td>-</td></tr>
<tr><td>willywonka</td><td>Willy Wonka</td><td></td><td>-</td></tr>
<tr><td>win</td><td>YOU ARE A WINNER!</td><td>declares you a winner!</td><td>Video Games</td></tr>
<tr><td>witchtit</td><td>Its Colder than a witches titty...</td><td></td><td>Movies/TV</td></tr>
<tr><td>wonderful</td><td>Having a wonderful time!</td><td>is having a wonderful time!</td><td>Music</td></tr>
<tr><td>wontlive</td><td>Too bad.</td><td>folds a unicorn.</td><td>-</td></tr>
<tr><td>wookies</td><td>SALSA WOOKIES!</td><td>saw some wookies.</td><td>Music</td></tr>
<tr><td>world</td><td>What a wonderful world!</td><td>sees trees of green.</td><td>-</td></tr>
<tr><td>wouldnt</td><td>I wouldn't do that!</td><td>gets killed in a chocolate factory.</td><td>-</td></tr>
<tr><td>wrdead</td><td>I'd shoot you again!</td><td>doesn't actually get kills.</td><td>-</td></tr>
<tr><td>wrists</td><td>CRAWLING IN MY SKIN!</td><td>slits their wrists.</td><td>Music</td></tr>
<tr><td>wrong</td><td>WRONG!!!</td><td>proves you wrong.</td><td>Movies/TV</td></tr>
<tr><td>wrrare</td><td>I once shot an ant...</td><td>only aims to wound.</td><td>-</td></tr>
<tr><td>wryy</td><td>WRYYYYY!</td><td>jumps on someone with a steamroller!</td><td>Video Games</td></tr>
<tr><td>wtf</td><td>What the fuck!</td><td>is amazed.</td><td>Etc</td></tr>
<tr><td>wurzel</td><td>I got a brand new combine harvester!</td><td>is a tube. Oh dear!</td><td>Music</td></tr>
<tr><td>wwbbd</td><td>What would brian boitano do?</td><td></td><td>Movies/TV</td></tr>
<tr><td>wwranger</td><td>Why so blue, ranger?</td><td>hates gingers.</td><td>-</td></tr>
<tr><td>wws</td><td>Who wants some?</td><td>will pay for trashing your ride.</td><td>-</td></tr>
<tr><td>xfile</td><td>X FILES</td><td>wonders why allys would do this.</td><td>Movies/TV</td></tr>
<tr><td>xkill</td><td>MULTI KILL!</td><td>is a mindless killer!</td><td>Video Games</td></tr>
<tr><td>yatta</td><td>YATTA!</td><td>bounces from left to right.</td><td>Music</td></tr>
<tr><td>yesmom</td><td>Yes Mommy!</td><td>agrees.</td><td>Etc</td></tr>
<tr><td>ymca</td><td>Y M C A!</td><td>has no need to feel down!</td><td>Music</td></tr>
<tr><td>yosukehelp</td><td>AHHAAHAHAH</td><td>has finally lost it.</td><td>-</td></tr>
<tr><td>youbitch</td><td>YOU BITCH!</td><td>may be overreacting</td><td>-</td></tr>
<tr><td>youlose</td><td>You LOSE! Good day sir!</td><td>kicks you out of his factory!</td><td>Movies/TV</td></tr>
<tr><td>youloser</td><td>Lahoooser</td><td>makes a L with one hand.</td><td>-</td></tr>
<tr><td>yourebeautiful</td><td>You're Beautiful, It's true!</td><td>is beautiful.</td><td>-</td></tr>
<tr><td>yourewrong</td><td>What you have done...</td><td></td><td>Etc</td></tr>
<tr><td>ytmnd</td><td>YOU'RE THE MAN NOW, DOG!</td><td>thinks you've made a breakthrough!</td><td>Internet</td></tr>
<tr><td>yukilaugh</td><td>uhuhuhhu</td><td>is a little creepy.</td><td>-</td></tr>
<tr><td>yukioops</td><td>How embarassing!</td><td>owns a kimono.</td><td>-</td></tr>
<tr><td>z</td><td>ZZZZZZ!</td><td>speaks spanish.</td><td>-</td></tr>
<tr><td>zaw</td><td>ZA WARUDO!</td><td>freezes time!</td><td>Video Games</td></tr>
<tr><td>zebrastrip</td><td>Oh I get it!</td><td>goes to the worst clubs.</td><td>-</td></tr>
<tr><td>zebrastrip2</td><td>Doesn't anyone get the joke?</td><td>dances poorly.</td><td>-</td></tr>
<tr><td>zoinks</td><td>ZOINKS!</td><td>solves mysteries with a dog.</td><td>-</td></tr>
<tr><td>zombienation</td><td>Zombie, Zombie, Zombie Nation!</td><td>feels like he's at a soccer game.</td><td>-</td></tr>
<tr><td>zuesgod</td><td>So called gods...</td><td>is looking for love.</td><td>-</td></tr>
<tr><td>1234</td><td>Raz Dva Tri Ctyri</td><td></td><td>our music</td></tr>
</tbody>
</table>
</div>
</div>

</div>


</body>
</html>
