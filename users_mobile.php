<?php
if (!ini_get('display_errors')) {
    ini_set('display_errors', 1);
}
// ini_set('memory_limit', '256M');
error_reporting(-1);

$docRoot = "/home/SOME_PATH/www/";

include_once($docRoot."backend/common.php");
$common = new Common();


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
	<title><<?php echo $common::guildName;?>></title> 
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
  <?php include_once($docRoot."backend/analyticstracking.php") ?>
	<link rel="stylesheet" href="/css/jquery.mobile-1.3.0.css" />
  <link rel="stylesheet" href="/css/jquery.jqplot.min.css" />
  <script src="/js/jquery-1.9.1.js"></script>
	<script src="/js/jquery.mobile-1.3.0.min.js"></script>
  <script src="/js/jqplot/jquery.jqplot.min.js" type="text/javascript"></script>
	<script src="/js/jqplot/jqplot.pieRenderer.min.js" type="text/javascript"></script>
  <script src="/js/jqplot/jqplot.barRenderer.min.js" type="text/javascript"></script>
  <script src="/js/jqplot/jqplot.categoryAxisRenderer.min.js" type="text/javascript"></script>
  <script src="/js/jqplot/jqplot.pointLabels.min.js" type="text/javascript"></script>
  <script>
  $(document).delegate('.ui-page', 'pageshow', function () {

    var classBarPlot = 0;
    $('#classSelect').change(function() {
    // console.log('change: '+$(this).val());
    // consolt.log($(this));
    	  drawClassLevelPlot($(this).val());
    // console.log('change');
	});
  var classColors = [
  <?php
    $output = "";
      foreach ($common->classColors as $color) {
        $output .= "'#$color',";
      }
      echo substr_replace($output ,"",-1);
  ?>
  ];
  var genericColors = ['#3366CC','#DC3912','#FF9900','#109618','#990099','#0099C6','#DD4477','#000000'];
  var classLabels = [
  <?php
      $output = "";
      foreach($common->classes as $class) {
        $output .= "{label:'$class'},";
      }
      echo substr_replace($output ,"",-1);
  ?>  
  ];
  var classPiedata = [
  <?php
    $output = "";
    foreach ($classCount['limit'] as $class => $data) {
      $output .= "['".$class."', ".$data."],";
    }
    echo substr_replace($output ,"",-1);
  ?>
  ];
  var levelPieData = [
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
			
      }
    }
  }
  $output = "";
  foreach ($levelRanges as $range => $stats) {
    $output .= "['".$range."', ";
    $output .= $stats['count'];
    $output .="],";
  }
  echo substr_replace($output ,"",-1);
  ?>
  ];
  
  var guildDistBarData = [
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
  
  // foreach($levelRanges as $range=>$data) {
  foreach($common->classes as $class) {
    $output .= "\r\n[ ";
    
    // foreach($common->classes as $class) {
    $varCount = 1;
    foreach($levelRanges as $range=>$data) {
      $count = 0;
      
      foreach($members as $member) {
        if (($member['class'] == $class) && ($member['level'] >= $data['start']) && ($member['level'] <= $data['end']))
          $count++;
      }
      $classLevelRanges[$class][$range] = $count;
      // $output .= "['$range', $count],";
      $output .= "[$count, '$varCount'],";
      $varCount++;
    }
    
    $output = substr_replace($output ,"",-1);
    $output .= "],";
    
  }
  // $output = substr_replace($output ,"",-1);
  print substr_replace($output ,"",-1)."];\r\n";
  ?>
  var guildDistTicks = [
  <?php
    $output = "";
    foreach($levelRanges as $range=>$data) {
      $output .= "'$range',";
    }
    echo substr_replace($output ,"",-1)."\r\n";
  ?>
  ];
  <?php
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
    // echo "['Range', '$class'],";
    $rangeCount = 1;
    foreach($data as $range => $count) {
      $output .= "[$count, '$rangeCount'],";
      $rangeCount++;
    }
    
    echo substr_replace($output ,"",-1);
    echo "]";
  }
  echo "];\r\n";
  ?>
  
  var maxLevelData = [
    <?php
        $output = "";
     
          // $output .= "[";
          // $classNum = 1
          foreach($common->classes as $class) {
            $count = 0;
            foreach($members as $member) {
              if (($member['class'] == $class) && ($member['level'] == 60))
                $count++;
            }
            
            // if (!is_array($classLevelRanges[$class])) {
              // $classLevelRanges[$class] = array();
            // } 
            // $classLevelRanges[$class][$range] = $count;
            $output .= "[$count],";
            // $classNum++;
          }
          $output = substr_replace($output ,"",-1);
          // $output .= "],";
          
        
        // $output = substr_replace($output ,"",-1);
        print $output;
      ?>
  
  ];
  var classNameTicks = [
  <?php
    $output = "";
    foreach($common->classes as $class) {
      $output .= "'$class',";
    }
    echo substr_replace($output ,"",-1)."\r\n";
  ?>
  ];
  var classPiePlot = jQuery.jqplot ('classPieChart', [classPiedata], 
    { 
      seriesDefaults: {
        // Make this a pie chart.
        renderer: jQuery.jqplot.PieRenderer, 
        rendererOptions: {
          // Put data labels on the pie slices.
          // By default, labels show the percentage of the slice.
          showDataLabels: true
        },
        markerOptions: {
            show: true,
            shadow: false
        }
      }, 
      title: {
        text: 'Class Breakdown',   // title for the plot,
        show: true,
      },
      legend: { show:true, location: 'e' },
      seriesColors: classColors,

    }
  );
  var levelPiePlot = jQuery.jqplot ('levelPieChart', [levelPieData], 
    { 
      seriesDefaults: {
        // Make this a pie chart.
        renderer: jQuery.jqplot.PieRenderer, 
        rendererOptions: {
          // Put data labels on the pie slices.
          // By default, labels show the percentage of the slice.
          showDataLabels: true
        }
      }, 
      title: {
        text: 'Level Breakdown',   // title for the plot,
        show: true,
      },
      legend: { show:true, location: 'e' },
      seriesColors: genericColors
    }
  );
  var guildBarPlot = $.jqplot('guildDistribution', guildDistBarData, {
    // Tell the plot to stack the bars.
    stackSeries: true,
    seriesDefaults:{
      renderer:$.jqplot.BarRenderer,
      rendererOptions: {
          // Highlight bars when mouse button pressed.
          // Disables default highlighting on mouse over.
          highlightMouseDown: true   
      },
      pointLabels: { show: true, location: 'e', edgeTolerance: -15 },
            // Rotate the bar shadow as if bar is lit from top right.
            shadowAngle: 135,
       rendererOptions: {
          barDirection: 'horizontal'
      }
    },
    axes: {
        yaxis: {
            renderer: $.jqplot.CategoryAxisRenderer,
            ticks: guildDistTicks
        }
        
    },
    legend: {
      show: false
    },
    title: {
      text: 'Guild Distribution',   // title for the plot,
      show: true,
    },
    series:classLabels,
    seriesColors: classColors
  });
 
  var maxLevelPlot = $.jqplot('maxLevelChart', maxLevelData, {
    // Tell the plot to stack the bars.
    seriesDefaults:{
      renderer:$.jqplot.BarRenderer,
      rendererOptions: {
          // Highlight bars when mouse button pressed.
          // Disables default highlighting on mouse over.
          highlightMouseDown: true   
      },
      pointLabels: { show: true, location: 'e', edgeTolerance: -15 },
            // Rotate the bar shadow as if bar is lit from top right.
            shadowAngle: 135,
       rendererOptions: {
          barDirection: 'horizontal'
      }
    },
    axes: {
        yaxis: {
            renderer: $.jqplot.CategoryAxisRenderer,
            ticks: ['60']
        }
        
    },
    legend: {
      show: false
    },
    title: {
        text: '# Classes at Max Level',   // title for the plot,
        show: true,
    },
    series: classLabels,
    seriesColors: classColors
  });
  drawClassLevelPlot(0);
  function drawClassLevelPlot(wowClass) {
    // if (classBarPlot != 0) {
      
    // }
   classBarPlot = $.jqplot('classLevelChart', [classData[wowClass]], {
      // Tell the plot to stack the bars.
      seriesDefaults:{
        renderer:$.jqplot.BarRenderer,
        rendererOptions: {
            // Highlight bars when mouse button pressed.
            // Disables default highlighting on mouse over.
            highlightMouseDown: true   
        },
        pointLabels: { show: true, location: 'e', edgeTolerance: -15 },
              // Rotate the bar shadow as if bar is lit from top right.
              shadowAngle: 135,
         rendererOptions: {
            barDirection: 'horizontal'
        }
      },
      axes: {
          yaxis: {
              renderer: $.jqplot.CategoryAxisRenderer,
              ticks: guildDistTicks
          }
          
      },
      legend: {
        show: true
      },
      title: {
        text: 'Single Class Breakdown',   // title for the plot,
        show: true,
      },
      series:[classLabels[wowClass]],
      seriesColors:[ classColors[wowClass]]
    });
    classBarPlot.replot();
  }
});


  
  </script>
</head> 
<body> 
<div data-role="page" >	
	<div data-role="header">
	<h1><?php echo $common::guildName;?> - Members</h1>
  <div data-role="navbar">
    <ul>
      <li><a href="/users.php?forceDesktop=1" data-ajax="false" data-icon="home" data-iconpos="top" onClick="_gaq.push(['_trackEvent', 'Site Display Change', 'Mobile-to-Desktop', 'Users', 1, true]);">Desktop</a></li>
      <li><a href="/forums/index.php?&mobile=mobile" target="_blank" data-icon="star" data-iconpos="top"  >Forums</a></li>
      <li><a href="/mobile.php" data-ajax="false" data-icon="home" data-iconpos="top" >Bank</a></li>
    </ul>
  </div>
  <?php echo $common->getMotd(true);?>
	</div><!-- /header -->	
	<div data-role="content">
    <div class="content-primary">
    <div class="ui-bar ui-bar-b"><h5><?php echo "Last update:".$common->getLastUpdated(). "CST";?></h5></div><br>
      <div id="classPieChart" class="myChart"></div>
      <br>
      <div id="levelPieChart" class="myChart"></div>
      <br>
      <div id="guildDistribution" class="myChart"></div>
      <br>
      <div id="maxLevelChart" class="myChart"></div>
      <br>
      <div id="classLevelChart" class="myChart"></div>		
      <div data-role="fieldcontain" style='z-index: 9999;height: 100px;'>
        <label for="classSelect" class="select">Classes:</label>
        <select id="classSelect" name="classSelect">
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
      <div class="ui-body ui-body-a">
      <h1>Count/Avg Lvl - By Class
      <div data-role="collapsible" data-collapsed="true" data-theme="a">
   <h3>Online <<?php echo readableHours($hoursLimit)." ago";?></h3>
      <table id="classCountLimit" data-role="table" data-mode="reflow" class="ui-responsive table-stroke">
      <thead>
        <tr>
          <th data-priority="persist">Class</th>
          <th data-priority="1"><abbr title="Count">#</abbr></th>
          <th data-priority="2"><abbr title="Average Level">Avg Lvl</abbr></th>
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
        echo "</tr>";
      }
        ?>
      </tbody>
      </table>
      </div>
     <div data-role="collapsible" data-collapsed="true" data-theme="a">
   <h3>All Members</h3>
      <table data-role="table" id="classCountNoLimit" data-mode="reflow" class="ui-responsive table-stroke">
      <thead>
        <tr>
          <th data-priority="persist">Class</th>
          <th data-priority="1"><abbr title="Count">#</abbr></th>
          <th data-priority="2"><abbr title="Average Level">Avg Lvl</abbr></th>
        </tr>
      </thead>
      <tbody>
      	<?php

      foreach ($common->classes as $class) {
        
        echo "<tr>";
        $count = $classCount['noLimit'][$class];
        $levelSum = $classTotalLevel['noLimit'][$class];
        $averageLevel = $classAvg['noLimit'][$class];

        
        echo "<td><FONT COLOR='".$common->classColors[$class]."'>$class</font></td><td><FONT COLOR='".$common->classColors[$class]."'>$count</font></td><td><FONT COLOR='".$common->classColors[$class]."'>".(int)$averageLevel."</font></td>";
        echo "</tr>";
      }
      ?>
      </tbody>
      </table>
      </div>
      </div>
		</div><!--/content-primary -->			
	</div><!-- /content -->
<div data-role="footer"  data-id="foo1" data-position="fixed">		
	<div data-role="navbar">
		<ul>
			<li><a href="mobile.php" data-ajax="false">Bank</a></li>
		</ul>
	</div><!-- /navbar -->
</div><!-- /footer -->
</div><!-- /page -->

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
?>