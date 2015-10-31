<?php
$docRoot = "/home/SOME_PATH/www/";
include_once($docRoot."backend/common.php");
$common = new Common();
?>
<!DOCTYPE html> 
<html>
<head>
	<title>&lt;<?php echo $common::guildName;?>&gt;</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <?php include_once($docRoot."backend/analyticstracking.php") ?>
	<link rel="stylesheet" href="/css/jquery.mobile-1.3.0.css" />
  <?php echo $common->outputCommonJS();?>
  <script src="/js/jquery-1.9.1.js"></script>
  <script src="/js/jquery.md5.min.js"></script>
	<script src="/js/jquery.mobile-1.3.0.min.js"></script>
  <script>
  var currentPage = "";
  var aowowURL = "<?php echo $common::aowowURL;?>";
  var xhr = null;
  var selections = new Array();
  var itemCounts = new Array();
  var updateCheckTimer = setInterval(function(){updateCheck()},60000);
  var lastUpdateDate = new Date();
  lastUpdateDate.setFullYear(1970,1,1);
  $(document).delegate('.ui-page', 'pageshow', function () {
    $.get( "index.php", { checkUpdate: "true" }, function( data ) {
      var t = data.split(/[- :]/);
      lastUpdateDate = new Date(t[0], t[1]-1, t[2], t[3], t[4], t[5]);    
    });
    $('.bankerList').unbind('click').delegate('li', 'click', function () {
        var clickedClassName = 'undefined';
        if (typeof event.srcElement !== 'undefined') {		
          clickedClassName = event.srcElement.className;
        }
        if (clickedClassName != "ui-btn-inner") {
          $('.panelImg').attr('src','/images/icons/404.png');
          currentPage = $.mobile.activePage.attr("id");
          
               var title = this.innerText;
        n = title.lastIndexOf(' ');
        if (n >= 0) {
            title = 'Qty: ' + title.substring(n)
        }
         $.mobile.showPageLoadingMsg();
         $('.itemInfo').html('</p>Loading data for '+this.innerText.substring(0, n)+' from '+aowowURL+'...</p>');
         $( "#"+currentPage+"_panel" ).panel( "open" );
        $('.panelImg').attr('src','/images/icons/'+$(this).attr('img')+'.png');
        var url = aowowURL+"?item="+this.id;
        $('.dbLink').attr('href',url);        
        xhr = $.get("/backend/getTooltip.php", {itemID: this.id}, function(data) {
                  $('.itemInfo').html(data);
                  $.mobile.hidePageLoadingMsg();
                  $( "#"+currentPage+"_panel" ).panel( "open" );
                  $( "#"+currentPage+"_panel" ).trigger( "updatelayout" );
                }       
              );
        } else {
          var itemID = $(this).attr('id');
          var dataIcon = $('#'+itemID+'-purchase').data('icon');
          
          if (dataIcon == 'plus') {
            var itemCount = $('#'+itemID+'-count').html();
            $('#itemCountSlider').val(itemCount);
            if (itemCount <= 1) {
              addToCart(itemID);
            } else {
              var itemName = $('#'+itemID+'-name').html();              
              $.mobile.changePage('#purchase', 'pop', true, true);
              $('#dialogAddBtn').attr('onClick','addToCart('+itemID+');');
              $('#dialogItemName').html(itemName);
              $('#itemCountSlider').attr('max',itemCount);
              $('#itemCountSlider').val(itemCount);
              $('#itemCountSlider').slider('refresh');
           }
          } else {
            removeFromCart(itemID);
          }
        }
    });
  });
  
  function updateCheck() {
  $.get( "index.php", { checkUpdate: "true" }, function( data ) {
    var t = data.split(/[- :]/);
    currentUpdateDate = new Date(t[0], t[1]-1, t[2], t[3], t[4], t[5]);
    if (lastUpdateDate.getTime() != currentUpdateDate.getTime()) {
      $.mobile.changePage("#dialog-Refresh");
    } else {
      console.log("don't match:"+lastUpdateDate.getTime()+"=="+currentUpdateDate.getTime());
    }
  });
}
  function closePanel() {
    xhr.abort();
    $.mobile.hidePageLoadingMsg();
    xhr = null;
  }

  function addToCart(itemID) {
    _gaq.push(['_trackEvent', 'Requests - Mobile', 'Row Clicked', 'Any Row', 1, true]);
    var selectedCount = $('#itemCountSlider').val();
    if (selectedCount <= 0) {
      return 1;
    }
    $('#'+itemID+'-purchase').data('icon','minus');
    $('#'+itemID+'-purchase .ui-icon').addClass("ui-icon-minus").removeClass("ui-icon-plus"); 
    
    $('#'+itemID+'-count').html(selectedCount);
    $("#"+itemID+'-count').addClass("ui-btn-active");
  }
  
  function removeFromCart(itemID) {
    $('#'+itemID+'-purchase').data('icon','plus');
    $('#'+itemID+'-purchase .ui-icon').addClass("ui-icon-plus").removeClass("ui-icon-minus"); 
    var originalCount = $('#'+itemID+'-count').attr('count');
    $('#'+itemID+'-count').html(originalCount);
    $("#"+itemID+'-count').removeClass("ui-btn-active");
  }
  function endAjaxRequest() {
    $("#checkoutCancelBtn").removeClass("ui-disabled");
    // $('#password').val("");
  }
  function doCheckout() {
    _gaq.push(['_trackEvent', 'Requests - Mobile', 'Open Checkout Window', 'Clicked Checkout Link', 1, true]);
    $('#checkoutStatus').hide();
    $.mobile.showPageLoadingMsg();
    $("#submitCartBtn").removeClass("ui-disabled");
    $("#emptyCartBtn").removeClass("ui-disabled");
    
    selections.splice(0,selections.length);
		itemCounts.splice(0,itemCounts.length);
    $('.ui-icon-minus').each(function() {
      var itemID = $(this).closest('li').attr('id');
      
      if (itemID  !== 'undefined') {
        //console.log(itemID);
        var selectedCount = $('#'+itemID+'-count').html();
        var rowID = $('#'+itemID).attr('rowID');
        selections.push(rowID);
        itemCounts.push(selectedCount);
      } else {
        // console.log($(this));
      }
    });
    if (selections.length <= 0) {
      $.mobile.hidePageLoadingMsg();
      alert("You currently have no items selected for checkout. Please select your items by click on the 'plus' icon located to the right of the item you desire.");
      
    } else {
      //console.log(selections);
      //console.log(itemCounts);
      $.ajax({			
        url: "/backend/checkout.php",
        type: 'POST',
        data: {"selections[]" :selections, "itemCounts[]":itemCounts, "mobile":1, "review":1},
        timeout : 20000,
        tryCount : 0,
        retryLimit : 3,
        success: function(data) {
          $('#currentCart').html(data);
          $.mobile.changePage('#checkout', 'pop', true, true);
          $.mobile.hidePageLoadingMsg();
        },
        error: function(xhr, textStatus, errorThrown ) {
          if (textStatus == 'timeout') {
            this.tryCount++;
            if (this.tryCount <= this.retryLimit) {
                //try again
                $.ajax(this);
                return;
            }
              alert("Have tried to pull up your order " + this.retryLimit + " times and it is still not working. We give in. Sorry. Please try again. If issues persist please contact: webmaster@DOMAIN.");$.mobile.hidePageLoadingMsg();                   
              return;
            }              
          alert("Checkout process failed! Server responded with code: "+xhr.status+". Please try again. If issues persist please contact: webmaster@DOMAIN.");
          $.mobile.hidePageLoadingMsg();
      }
      });
    }
  }
  
  function emptyCart() {
    $('.ui-icon-minus').each(function() {
      var itemID = $(this).closest('li').attr('id');
      if (itemID  != 'undefined') {
        // console.log(itemID);
        removeFromCart(itemID);
      } else {
        // console.log($(this));
      }
    });
  
  }
  
  function submitOrder() {
    _gaq.push(['_trackEvent', 'Requests - Mobile', 'Inside Checkout Window', 'Clicked Checkout Button', 1, true]);
    var bValid = true;
    name = $('#name').val();
    bValid = bValid && ((name.length > 1) && (name.length < 13)) ;
    var password = $('#password').val();
    bValid = bValid && ($.md5(password) == PASS_HASH);
    if ( bValid ) {
      
      name = $('#name').val();
      $("#submitCartBtn").addClass("ui-disabled");
      $("#emptyCartBtn").addClass("ui-disabled");
      $("#checkoutCancelBtn").addClass("ui-disabled");
      // $('#checkoutStatus').show();
      $.mobile.showPageLoadingMsg();
      $('#checkoutStatus').html("Submitting order...</br><em>(May take a few moments)</em>");
      $('#checkoutStatus').show();
          $.ajax({			
          url: '/backend/checkout.php',
          type: 'POST',
          data: {"selections[]" :selections, "itemCounts[]":itemCounts, "debug":window.debug, "name":name, "mobile":1},
          success: function(data) {
            endAjaxRequest();
            emptyCart();
            $('#currentCart').html("Empty");
            $('#checkoutStatus').html(data);
            $.mobile.hidePageLoadingMsg();
            // console.log(data);
            
            // setTimeout(function(){ $( "#dialog-form" ).dialog( "close" ); }, 1750);
            // htmlMessage = $('#currentCart').html().replace(/"/g, "&quot;");
             // var mine = window.open('','','width=1,height=1,left=0,top=0,scrollbars=no');
             // if(mine) {
             
              // $( this ).dialog( "close" );
             // } else {
                // var popUpsBlocked = true;
                // alert("Please enable popups to continue.");
             // }
             

          },
          error:  function(xhr, textStatus, errorThrown ) {
            if (textStatus == 'timeout') {
              this.tryCount++;
              if (this.tryCount <= this.retryLimit) {
                  //try again
                  $.ajax(this);
                  return;
              }
                endAjaxRequest();
                $.mobile.hidePageLoadingMsg();
                $("#submitCartBtn").removeClass("ui-disabled");
                $("#emptyCartBtn").removeClass("ui-disabled");
                $('#checkoutStatus').html("Have tried to submit your order " + this.retryLimit + " times and it is still not working. We give in. Sorry. Please try again. If issues persist please contact <a href='mailto:webmaster@DOMAIN'>webmaster@DOMAIN</a>.");                      
                return;
              }              
            $('#checkoutStatus').html("Submission failed! Server responded with code: "+xhr.status+". Please try again. If issues persist please contact <a href='mailto:webmaster@DOMAIN'>webmaster@DOMAIN</a>.");
            endAjaxRequest();
            $.mobile.hidePageLoadingMsg();
            $("#submitCartBtn").removeClass("ui-disabled");
            $("#emptyCartBtn").removeClass("ui-disabled");
          }
          
        });
      
    } else {
     alert("wrong password/something else dummy");
     $('.ui-dialog').dialog('close');
    }
  }

  </script>
</head>

<body>

<?php
foreach ($common->bankerList as $banker) {
  outputBankerPage($banker,$common);
}
?>

<div id="dialog-Refresh" data-role="dialog">
    <div data-role="header" data-theme="d">
        <h1>Refesh to update data?</h1>
    </div>
    <div data-role="content" data-theme="c">
        There has been an update to the site's data, please confirm a page reload to ensure everything doesn't break horribly.      
        <a data-role="button" data-rel="back" onClick='document.location.reload(true);'>Refresh</a>
        <a data-role="button" data-rel="back" data-theme="e">Cancel</a>
    </div>
</div>

<div id="purchase" data-role="dialog">
    <div data-role="header" data-theme="d">
        <h1>Add Item</h1>
    </div>
    <div data-role="content" data-theme="c">
        <h1 id='dialogItemName'>Item Name</h1>
        <input type="range" name="itemCountSlider" id="itemCountSlider" data-highlight="true" min="0" max="1" value="1">
        <a id='dialogAddBtn' data-role="button" data-rel="back" onClick='addToCart(-1);'>Add</a>
        <a data-role="button" data-rel="back" data-theme="e">Cancel</a>
    </div>
</div>

<div id="checkout" data-role="dialog" data-close-btn="none">
    <div data-role="header" data-theme="d">
        <h1>Checkout</h1>
    </div>
    <div data-role="content" data-theme="c">
        <label for="text-basic">Name:</label>
        <input type="text" name="name" id="name" value="">
        <label for="text-basic">Password:</label>
        <input type="password" name="password" id="password" value="" autocomplete="off">
        <div id="checkoutStatus" style='display:none;'>
        Submitting order...</br><em>(May take a few moments)</em>
        </div>
        <h3>Cart Contents</h3>
        <div id="currentCart"></div> 
        <br>
        <a id='submitCartBtn' data-role="button" onClick='submitOrder();'>Checkout</a>
        <a id='emptyCartBtn' data-role="button" data-rel="back" data-theme="b" onClick='emptyCart();'>Empty cart</a>
        <a id='checkoutCancelBtn' data-role="button" data-theme="e" data-rel="back">Close</a>
    </div>
</div>

</body>
</html>

<?php
function outputBankerPage($banker,$common) {
  $query = "SELECT lastUpdated from bankitems WHERE banker='$banker' ORDER BY lastupdated DESC LIMIT 1";
	$result = $common->query($query);
  list($lastUpdated) = $result->fetch_row();
  $readableUpdateTxt = date(" F j, Y @ g:i a ", strtotime($lastUpdated));
	// start table
	?>
  <div data-role="page" id="<?php echo $banker;?>_page">

	<div data-role="header">
		<h1><?php echo $banker;?></h1>
            <div data-role="navbar">
            <ul>
                <li><a href="/?forceDesktop=1" data-ajax="false" data-icon="home" data-iconpos="top" onClick="_gaq.push(['_trackEvent', 'Site Display Change', 'Mobile-to-Desktop', 'Bank', 1, true]);">Desktop</a></li>
                <li><a href="javascript:void(0);" data-icon="check" data-iconpos="top" onClick='doCheckout();' >Checkout</a></li>
                <li><a href="/forums/index.php?mobile=mobile" target="_blank" data-ajax="false" data-icon="star" data-iconpos="top"  >Forums</a></li>
                <li><a href="/users_mobile.php" data-ajax="false" data-icon="grid" data-iconpos="top" >Members</a></li>
            </ul>
        </div><!-- /navbar -->
        <?php echo $common->getMotd(true);?>
	</div><!-- /header -->

	<div data-role="content">

    

	<?php
  // <a href="/?forceDesktop=1" >Desktop Site</a>
  // <?php echo "Last updated: $readableUpdateTxt CST";
	$o = "<ul class='bankerList' data-role='listview' data-filter='true' data-filter-placeholder='Search $banker...' >";
  $query = "SELECT * from bankitems ".
    "WHERE banker='$banker' AND ".
    "lastUpdated = '$lastUpdated' ".
    "ORDER BY itemName ASC";
  $result = $common->query($query);
	while(list($id, $loopBanker, $itemName, $itemID, $itemCount, $color, $icon) = $result->fetch_row()) {
    $iconImage = strtolower(str_replace("Interface\\Icons\\","",$icon));
    $o .= "<li id='$itemID' rowID='$id' img='$iconImage'>";
    if ($color == "ffffff") {
      $o .= "<a href='#'><font id='$itemID-name'>$itemName </font>";
    } else {
       $o .= "<a href='#'><font id='$itemID-name' color='#$color'>$itemName </font>";
    }    
    $o .= "<span id='$itemID-count' count='$itemCount' class='ui-li-count'>$itemCount</span>";
    $o .= "</a>";
    $o .= "<a href='javascript:void(0);' class='purchaseLink' id='$itemID-purchase' data-icon='plus' data-rel='dialog'> Purchase item</a>";
    $o .= "</li>";	
	}
	echo $o;
  ?>
  <br><div class="ui-bar ui-bar-b"><h5><?php echo "Last update:".$readableUpdateTxt. "CST";?></h5></div>
	</div><!-- /content -->
<div data-role="footer" data-id="foo1" data-position="fixed">
	<div data-role="navbar">
		<ul>
    <?php
  foreach ($common->bankerList as $navBanker) {
    if ($navBanker == $banker) {
      echo "<li><a href='#".$navBanker."_page' class='ui-btn-active ui-state-persist'>$navBanker</a></li>";
    } else {
      echo "<li><a href='#".$navBanker."_page' >$navBanker</a></li>";
    }
  }
?>
		</ul>
	</div><!-- /navbar -->
</div><!-- /footer -->
<div data-role="panel" id="<?php echo $banker;?>_page_panel" data-position="right" data-position-fixed="true" >
<img class='panelImg' src='/images/icons/404.png'width='64' height='64'>"
<div class="itemInfo"></div>


<div class='ui-bar'>
<a href="<?php echo $banker;?>_page" data-icon="back" data-rel="close" data-theme="e" onclick='closePanel();'>Close</a>
<a class="dbLink" href="javascript:void(0);" target="_blank" data-icon="info" data-icon="info" data-inline="true">DB Site</a>
</div>
    <!-- panel content goes here -->
</div><!-- /panel -->
  </div><!-- /page -->
<?php
}
?>
