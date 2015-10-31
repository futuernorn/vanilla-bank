<?php
if (!ini_get('display_errors')) {
    ini_set('display_errors', 1);
}
error_reporting(-1);

include_once("backend/Mobile_Detect.php");
include_once("backend/common.php");
$common = new Common();
$detect = new Mobile_Detect();

if ($detect->isMobile() && !isset($_GET['forceDesktop'])) {
    include 'users_mobile.php';
    exit();
}

$hoursLimit = 24*14;
if (isset($_GET['hoursLimit']))
  $hoursLimit = $_GET['hoursLimit'];
  
$levelLimit = 1;
if (isset($_GET['levelLimit']))
  $levelLimit = $_GET['levelLimit'];




$members = array();
$classCount = array('limit'=>array(),'noLimit'=>array());
$classAvg = array('limit'=>array(),'noLimit'=>array());
$classTotalLevel = array('limit'=>array(),'noLimit'=>array());

$query = "SELECT * FROM members WHERE level>$levelLimit";
$result = $common->query($query);
while($row = $result->fetch_array(MYSQLI_ASSOC)) {
  $members[] = $row;
  
}
foreach ($common->classes as $class) {
  $count = 0;
  $levelSum = 0;
  $averageLevel = 0;
  $query = "SELECT name,level FROM members WHERE class='$class' AND level>$levelLimit AND last_online<$hoursLimit";
  $result = $common->query($query);
  while($row = $result->fetch_array(MYSQLI_ASSOC)) {
    if (in_array($row['name'],$common->bankerList))
      continue;
    $count++;
    $levelSum += $row['level'];
    
    if ($count > 0)
      $averageLevel = (int)$levelSum/$count;
    
  }
  $classCount['limit'][$class] = $count;
  $classAvg['limit'][$class] = $averageLevel;
  $classTotalLevel['limit'][$class] = $levelSum;
  $count = 0;
  $levelSum = 0;
  $averageLevel = 0;
  $query = "SELECT name,level FROM members WHERE class='$class' AND level>$levelLimit";
  $result = $common->query($query);
  while($row = $result->fetch_array(MYSQLI_ASSOC)) {
    if (in_array($row['name'],$common->bankerList))
      continue;
    $count++;
    $levelSum += $row['level'];
    
    if ($count > 0)
      $averageLevel = (int)$levelSum/$count;
    
  }
  $classCount['noLimit'][$class] = $count;
  $classAvg['noLimit'][$class] = $averageLevel;
  $classTotalLevel['noLimit'][$class] = $levelSum;
}
?>
<!DOCTYPE html> 
<html> 
	<head> 
	<title>&lt;<?php echo $common::guildName;?>&gt;</title> 
  <link rel="stylesheet" href="/css/style.css" />
  <?php include_once("backend/analyticstracking.php") ?>
	<script src="/js/power.js"></script>
	<script src="/js/jquery-1.9.1.js"></script>
	<script src="/js/jquery.tablesorter.js"></script>	
	<script src="/js/jquery.tablesorter.widgets.js"></script>
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
      1 : rangeFilterFunc
    }
  </script>
  <script type="text/javascript">
  $(document).ready(function() {
    $('#classSelect').change(function() {
      drawClassLevelChart($('#classSelect').val());//('value'));
    });
    drawClassPieChart();
    drawLevelPieChart();
    drawGuildDistribution();
    drawClassLevelChart(0);
    drawMaxLevelChart();
    $("#myTable").tablesorter({
      widthFixed: true, 
      widgetFilterChildRows: true,
      widgets: ['zebra', 'filter', 'stickyHeaders'],
          widgetOptions: {
     // Add select box to 4th column (zero-based index)
      // each option has an associated function that returns a boolean
      // function variables:
      // e = exact text from cell
      // n = normalized value returned by the column parser
      // f = search filter input value
      // i = column index
      filter_functions : window.filter_functions_list
      
      
    
    }
    });
  });

  </script>
  <script type="text/javascript" src="https://www.google.com/jsapi"></script>
  <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      // google.setOnLoadCallback(drawClassPieChart);
      function drawClassPieChart() {
        var data = google.visualization.arrayToDataTable([
          ['Class', 'Characters'],
          <?php
          $output = "";
          foreach ($classCount['limit'] as $class => $data) {
            $output .= "['".$class."', ".$data."],";
          }
          echo substr_replace($output ,"",-1);
          ?>
        ]);

        var options = {
          title: 'Class Breakdown',
          backgroundColor:'#000000',
          titleTextStyle: {color: 'white'},
          legend: {textStyle: {color: 'white'}},          
          pieSliceTextStyle: {color: '#000'},
          chartArea: {width:"50%",height:"200"},
          <?php
          $output = "colors: [";
          foreach ($common->classColors as $color) {
            $output .= "'#$color',";
          }
          echo substr_replace($output ,"",-1).']';
          ?>
        };

        var chart = new google.visualization.PieChart(document.getElementById('classPieChart'));
        chart.draw(data, options);
      }
      function drawLevelPieChart() {
        var data = google.visualization.arrayToDataTable([
          ['Level Range', 'Characters'],
          <?php
          
          $levelRanges = array("1-9"=>array('start'=>1,'end'=>9,'count'=>0),
            "10-19"=>array('start'=>10,'end'=>19,'count'=>0),
            "20-29"=>array('start'=>20,'end'=>29,'count'=>0),
            "30-39"=>array('start'=>29,'end'=>39,'count'=>0),
            "40-49"=>array('start'=>39,'end'=>49,'count'=>0),
            "50-59"=>array('start'=>50,'end'=>59,'count'=>0),
            "60"=>array('start'=>60,'end'=>60,'count'=>0));
          foreach ($members as $member) {
            foreach ($levelRanges as $range => &$data) {
              if(($member['level'] >= $data['start']) && ($member['level'] <= $data['end'])) {
                $data['count']++;
				// echo $data['start']."-".$data['end']."--".$member['name']."\r\n";
			  }
            }
          }
		  // print_r($levelRanges);
          $output = "";
          foreach ($levelRanges as $range => $stats) {
			// if ($range == "60")
				// continue;
            $output .= "['".$range."', ";
			$output .= $stats['count'];
			$output .="],";
          }
		  // print_r($levelRanges);
          echo substr_replace($output ,"",-1);
          ?>
        ]);

        var options = {
          title: 'Level Breakdown',
          backgroundColor:'#000000',
          titleTextStyle: {color: 'white'},
          legend: {textStyle: {color: 'white'}},
          chartArea: {width:"50%",height:"200"}
        };

        var chart = new google.visualization.PieChart(document.getElementById('levelPieChart'));
        chart.draw(data, options);
      }
      function drawGuildDistribution() {
  // Create and populate the data table.
      var data = google.visualization.arrayToDataTable([
        ['Range', "Warrior","Rogue","Druid","Mage","Warlock","Hunter","Priest","Paladin"],
      <?php
        $output = "";
        $classLevelRanges = array("Warrior"=>array(),"Rogue"=>array(),"Druid"=>array(),"Mage"=>array(),"Warlock"=>array(),"Hunter"=>array(),"Priest"=>array(),"Paladin"=>array());
        $levelRanges = array("1-9"=>array('start'=>1,'end'=>9,'count'=>0),
          "10-19"=>array('start'=>10,'end'=>19,'count'=>0),
          "20-29"=>array('start'=>20,'end'=>29,'count'=>0),
          "30-39"=>array('start'=>30,'end'=>39,'count'=>0),
          "40-49"=>array('start'=>40,'end'=>49,'count'=>0),
          "50-59"=>array('start'=>50,'end'=>59,'count'=>0),
          "60"=>array('start'=>60,'end'=>60,'count'=>0));
        // $output += "";
        foreach($levelRanges as $range=>$data) {
          $output .= "['$range', ";
          
          foreach($common->classes as $class) {
            $count = 0;
            foreach($members as $member) {
              if (($member['class'] == $class) && ($member['level'] >= $data['start']) && ($member['level'] <= $data['end']))
                $count++;
            }
            
            // if (!is_array($classLevelRanges[$class])) {
              // $classLevelRanges[$class] = array();
            // } 
            $classLevelRanges[$class][$range] = $count;
            $output .= "$count,";
          }
          $output = substr_replace($output ,"",-1);
          $output .= "],";
          
        }
        $output = substr_replace($output ,"",-1);
        print $output;
      ?>
      ]);

  // Create and draw the visualization.
  new google.visualization.BarChart(document.getElementById('guildDistribution')).
      draw(data,
           {title:"Guild Distribution",
           backgroundColor:'#000000',
          titleTextStyle: {color: 'white'},
          legend: {textStyle: {color: 'white'}},
            width:'50%', height:'300',
            vAxis: {title: "Level Range", baselineColor: '#FFF', girdlines:{color: '#FFF'},textStyle:{color: '#FFF'},titleTextStyle:{color: '#FFF'}},
            hAxis: {title: "Characters", baselineColor: '#FFF', girdlines:{color: '#FFF'},textStyle:{color: '#FFF'},titleTextStyle:{color: '#FFF'}},
            isStacked: true,
                      <?php
          $output = "colors: [";
          foreach ($common->classColors as $color) {
            $output .= "'#$color',";
          }
          echo substr_replace($output ,"",-1).']';
          ?>
            }
      );
}
 
      function drawClassLevelChart(wowClass) {
      console.log(wowClass);
       <?php
  echo "var classColors = [";
  $output = "";
  foreach ($common->classColors as $color) {
	$output .= "'#$color',";
  }
  echo substr_replace($output ,"",-1)."];\r\n";
  echo "var classData = [";
  $isFirst = true;
  foreach ($classLevelRanges as $class => $data) {
  	if (!$isFirst) {
		echo ",\r\n";
	} else {
		$isFirst = false;
	}
	$output = "";
    echo "[";
    echo "['Range', '$class'],";

    foreach($data as $range => $count) {
      $output .= "['$range', $count],";
    }
    echo substr_replace($output ,"",-1);
    echo "]";
  }
  echo "];\r\n";
      ?>
		var data = google.visualization.arrayToDataTable(classData[wowClass]);

  // Create and draw the visualization.
  new google.visualization.BarChart(document.getElementById('classLevelChart')).
      draw(data,
           {title:"Class Distribution",
           backgroundColor:'#000000',
          titleTextStyle: {color: 'white'},
          legend: {textStyle: {color: 'white'}},
            width:'50%', height:'300',
            vAxis: {title: "Level Range", baselineColor: '#FFF', girdlines:{color: '#FFF'},textStyle:{color: '#FFF'},titleTextStyle:{color: '#FFF'}},
            hAxis: {title: "Characters", baselineColor: '#FFF', girdlines:{color: '#FFF'},textStyle:{color: '#FFF'},titleTextStyle:{color: '#FFF'}},
            isStacked: true,
			colors: [classColors[wowClass]]
                  
            }
      );
}
    function drawMaxLevelChart() {
  // Create and populate the data table.
      var data = google.visualization.arrayToDataTable([
        ['Range', "Warrior","Rogue","Druid","Mage","Warlock","Hunter","Priest","Paladin"],
      <?php
        $output = "";
     
          $output .= "['$range', ";
          
          foreach($common->classes as $class) {
            $count = 0;
            foreach($members as $member) {
              if (($member['class'] == $class) && ($member['level'] == 60))
                $count++;
            }
            
            // if (!is_array($classLevelRanges[$class])) {
              // $classLevelRanges[$class] = array();
            // } 
            $classLevelRanges[$class][$range] = $count;
            $output .= "$count,";
          }
          $output = substr_replace($output ,"",-1);
          $output .= "],";
          
        
        $output = substr_replace($output ,"",-1);
        print $output;
      ?>
      ]);

  // Create and draw the visualization.
  new google.visualization.BarChart(document.getElementById('maxLevelChart')).
      draw(data,
           {title:"Guild Distribution at Maximum Level",
           backgroundColor:'#000000',
          titleTextStyle: {color: 'white'},
          legend: {textStyle: {color: 'white'}},
            width:'50%', height:'300',
            vAxis: {title: "Level Range", baselineColor: '#FFF', girdlines:{color: '#FFF'},textStyle:{color: '#FFF'},titleTextStyle:{color: '#FFF'}},
            hAxis: {title: "Characters", baselineColor: '#FFF', girdlines:{color: '#FFF'},textStyle:{color: '#FFF'},titleTextStyle:{color: '#FFF'}},
            bar: {groupWidth: '100%'},
            isStacked: false,
                      <?php
          $output = "colors: [";
          foreach ($common->classColors as $color) {
            $output .= "'#$color',";
          }
          echo substr_replace($output ,"",-1).']';
          ?>
            }
      );
}

    </script>
</head> 
<body> 

<div id="page">	
<h1 style="text-align:center;background-color: #333;">
<?php echo $common->makeFabulous("<".$common::guildName."> - Members");?>
</h1>
<h3 style="text-align:center;background-color: #333;">
<?php
if (isset($_GET['forceDesktop'])) {
?>
<a target="_self" href="http://DOMAIN/?forceDesktop=1">Bank</a> - <a target="_self" href="http://DOMAIN/forums/index.php?&mobile=desktop">Forums</a> - <a target="_self" href="http://DOMAIN/admin.php?forceDesktop=1">Admin</a> - <a target="_self" href="http://DOMAIN/users_mobile.php"  onClick="_gaq.push(['_trackEvent', 'Site Display Change', 'Desktop-to-Mobile', 'Users - Force Desktop', 1, true]);">Mobile</a>
<?php
} else {
?>
<a target="_self" href="http://DOMAIN/">Bank</a> - <a target="_self" href="http://DOMAIN/forums">Forums</a> - <a target="_self" href="http://DOMAIN/admin.php">Admin</a> - <a target="_self" href="http://DOMAIN/users_mobile.php"  onClick="_gaq.push(['_trackEvent', 'Site Display Change', 'Desktop-to-Mobile', 'Users', 1, true]);">Mobile</a>
<?php

}
?>
</h3>
<br>
<?php echo $common->getMotd();?>
<br>
<div id="main-content">
<div class="infoText" id="lastUpdatedTxt">
<?php
echo "Latest update:".$common->getLastUpdated(). "CST";
echo "</br>Counting users with levels greater than $levelLimit"
?>
</div>
</br>
<table class="tablesorter" style='text-align:center;'>
<thead>
<tr>
<th style="text-align:center;" colspan="3"><h3>Online less than <?php echo readableHours($hoursLimit)." ago";?></h3></th> 
<th style="text-align:center;background-color: #000;">
<th></th><th></th>
<th style="text-align:center;background-color: #000;">
<th style="text-align:center;" colspan="3"><h3>All-time</h3></th> 
<tr>
<th>Class</th>
<th>Number</th>
<th>Average Level</th>
<th style="text-align:center;background-color: #000;"></th>
<th>&#916; Number</th>
<th>&#916; Avg Lvl</th>
<th style="text-align:center;background-color: #000;"></th>
<th>Class</th>
<th>Number</th>
<th>Average Level</th>
</tr>
</thead>
<tbody>
	<?php

foreach ($common->classes as $class) {
  
  $count = $classCount['limit'][$class];
  $levelSum = $classTotalLevel['limit'][$class];
  $averageLevel = $classAvg['limit'][$class];
  echo "<tr>";
  echo "<td><FONT COLOR='".$common->classColors[$class]."'>$class</font></td><td><FONT COLOR='".$common->classColors[$class]."'>$count</font></td><td><FONT COLOR='".$common->classColors[$class]."'>".(int)$averageLevel."</font></td>";
  $countNoLimit = $classCount['noLimit'][$class];
  $levelSumNoLimit = $classTotalLevel['noLimit'][$class];
  $averageLevelNoLimit = $classAvg['noLimit'][$class];

  
  echo "<td style='text-align:center;background-color: #000;'></td>";
  echo "<td style='color:#".$common->classColors[$class].";'>".abs($count - $countNoLimit)."</td><td style='color:#".$common->classColors[$class].";'>".(int)abs($averageLevel - $averageLevelNoLimit)."</td>";
  echo "<td style='text-align:center;background-color: #000;'></td>";
  
  echo "<td><FONT COLOR='".$common->classColors[$class]."'>$class</font></td><td><FONT COLOR='".$common->classColors[$class]."'>$countNoLimit</font></td><td><FONT COLOR='".$common->classColors[$class]."'>".(int)$averageLevelNoLimit."</font></td>";
  echo "</tr>";
}
echo "</tbody></table>";
?>
</br>

<div id="graphs" style=' background-color:#000;'>
  <div id="classPieChart" style="float:left; width: 50%; height: 300px;"></div>
  <div id="levelPieChart" style="float:left; width: 50%; height: 300px;"></div>
  <div id="guildDistribution" style="float:left; width: 50%; height: 300px;"></div>
  <div id="classLevelDiv" style="float:left; width: 50%;">
  <div id="classLevelChart" style="float:left; width: 100%; height: 300px;"></div>
  <select style="float:right;" id="classSelect">
  <option value="0">Warrior</option>
  <option value="1">Rogue</option>
  <option value="2">Druid</option>
  <option value="3">Mage</option>
  <option value="4">Warlock</option>
  <option value="5">Hunter</option>
  <option value="6">Priest</option>
  <option value="7">Paladin</option>
</select>
  </div>
  <div style="clear:both;"></div>
  <div id="maxLevelChart" style="float:left; width: 50%; height: 300px;"></div>
  
  <div style="clear:both;"></div>
</div>
</br>
  <br />
	<table class="tablesorter" id="myTable">
	<thead>
	<tr>
		<th>Name</th>	
    <th style='width:2%;'>Level</th>				
    <th class="filter-select">Class</th>				
    <th class="filter-select">Rank</th>		
    <th>Note</th>		
    <th class="filter-false">Last Online</th>			    
	</tr>
	</thead>
  <tbody>
<?php
foreach ($members as $member) {
  if (in_array($member['name'],$common->bankerList))
      continue;
	// if ($row['level'] == 1)
    // continue;
  $currentName = $member['name'];

	echo "<tr>";
	echo "<td><FONT COLOR='".$common->classColors[$member['class']]."'>$currentName</font></td>";
  echo "<td><FONT COLOR='".$common->classColors[$member['class']]."'>".$member['level']."</font></td>";
  echo "<td><FONT COLOR='".$common->classColors[$member['class']]."'>".$member['class']."</font></td>";
  echo "<td>".$member['rank']."</td>";
  echo "<td>".$member['guild_note']."</td>";
  if (intval($member['last_online']) > (24*30)) {
    echo "<td style='color:#F00;'>".$member['last_online']."</td>";
  } else {
    echo "<td>".$member['last_online']."</td>";
  }

  echo "</tr>";
}
  
	?>
</tbody>
</table>	
</div>
</div>
</body>
</html>

<?php

function readableHours($totalhours) {
$days = round($totalhours / 24);
$hours = $totalhours % 24;
if ($days == 0)
  return "$hours hours";
if ($hours == 0)
  return "$days days";
return "$days days - $hours hours";

}
