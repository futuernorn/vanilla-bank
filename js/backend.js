var user = "";
var selections = new Array();
var itemCounts = new Array();
var bankerFilterBox = 'undefined';
var ipAddress = "";

var updateCheckTimer = setInterval(function(){updateCheck()},60000);
var lastUpdateDate = new Date();
lastUpdateDate.setFullYear(1970,1,1);

$(document).ready(function() {
	$("#bankers_table").tablesorter({
    cssInfoBlock : "tablesorter-no-sort", 		
		widgets: ['zebra', 'stickyHeaders', 'filter'],
    widgetOptions: {
     // Add select box to 4th column (zero-based index)
      // each option has an associated function that returns a boolean
      // function variables:
      // e = exact text from cell
      // n = normalized value returned by the column parser
      // f = search filter input value
      // i = column index
      stickyHeaders : 'tablesorter-stickyHeader',
      filter_functions : window.filter_functions_list    
    }
  });
    
  $.get( "index.php", { checkUpdate: "true" }, function( data ) {
    var t = data.split(/[- :]/);
    lastUpdateDate = new Date(t[0], t[1]-1, t[2], t[3], t[4], t[5]);    
  });
  
  $.getJSON("http://jsonip.com/",
    function(data){
      ipAddress = data.ip;
    }
  );
	
  
  $( "#dialog-form" ).dialog({
      autoOpen: false,
      height: 600,
      maxHeight: 600,
      resizable: false,
      width: 560,
      modal: true,
      buttons: {
        "Checkout": function() {
          _gaq.push(['_trackEvent', 'Requests', 'Inside Checkout Window', 'Clicked Checkout Button', 1, true]);
          var bValid = true;
          name = $('#name').val();
          bValid = bValid && ((name.length > 1) && (name.length < 13)) ;
          var password = $('#password').val();
          bValid = bValid && ($.md5(password) == '57616387351f6b4eb611bfd2a8d7f13c');
          if ( bValid ) {
            name = $('#name').val();
            $(".ui-dialog-buttonpane button:contains('Checkout')").button("disable");
            $(".ui-dialog-buttonpane button:contains('Empty Cart')").button("disable");
            $(".ui-dialog-buttonpane button:contains('Close')").button("disable");
            $(".ui-dialog-titlebar-close").hide();
            $('#checkoutStatus').html("Submitting order...<img src='/images/ajax-loader.gif'></br><em>(May take a few moments)</em>");
            $('#checkoutStatus').show();
            		$.ajax({			
                url: '/backend/checkout.php',
                type: 'POST',
                data: {"selections[]" :selections, "itemCounts[]":itemCounts, "debug":window.debug, "name":name, "ip":ipAddress},
                timeout : 20000,
                tryCount : 0,
                retryLimit : 3,
                success: function(data) {
                  
                  $('#checkoutStatus').html(data+"<br>Updating table...<img src='http://DOMAIN/images/ajax-loader.gif'>");
                  $.ajax({			
                      url: '/index.php',
                      type: 'POST',
                      data: {"getTable":1},
                      success: function(tableData) {
                        $("#bankers_table > tbody").html("");
                        $(tableData).appendTo("#bankers_table");
                        $("table")
                          .trigger("update")
                          .trigger("appendCache");
                        $('#checkoutStatus').html(data+"<br>Table updated!" );
                        $('tbody tr').click(rowClickHandler); 	
                        $(".ui-dialog-titlebar-close").show();
                      $(".ui-dialog-buttonpane button:contains('Close')").button("enable");
                      endAjaxRequest();
                      resetSelections();
                      $('#currentCart').html("Empty");
                      },
                      error: function(xhr, textStatus, errorThrown ) {
                      endAjaxRequest();
                  resetSelections();
                  $('#currentCart').html("Empty");
                        $('#checkoutStatus').html(data+"<br>Errors!" );
                      }
                    });
                  
 
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
                      $(".ui-dialog-buttonpane button:contains('Checkout')").button("enable");
                      $(".ui-dialog-buttonpane button:contains('Empty Cart')").button("enable");
                      $('#checkoutStatus').html("Have tried to submit your order " + this.retryLimit + " times and it is still not working. We give in. Sorry. Please try again. If issues persist please contact <a href='mailto:webmaster@DOMAIN'>webmaster@DOMAIN</a>.");                      
                      return;
                    }              
                  $('#checkoutStatus').html("Submission failed! Server responded with code: "+xhr.status+". Please try again. If issues persist please contact <a href='mailto:webmaster@DOMAIN'>webmaster@DOMAIN</a>.");
                  endAjaxRequest();
                  $(".ui-dialog-buttonpane button:contains('Checkout')").button("enable");
                  $(".ui-dialog-buttonpane button:contains('Empty Cart')").button("enable");
                }
                
              });
            
            
          } else {
           alert("wrong password/something else dummy");
           $( this ).dialog( "close" );
          }
        },
        "Empty Cart": function() {
          $( this ).dialog( "close" );
          resetSelections();
        },
        "Close": function() {
          $( this ).dialog( "close" );
        }
      },
      close: function() {
      }
    });
 
	$('tbody tr').click(rowClickHandler); 	
});

function updateCheck() {
  $.get( "index.php", { checkUpdate: "true" }, function( data ) {
    var t = data.split(/[- :]/);
    currentUpdateDate = new Date(t[0], t[1]-1, t[2], t[3], t[4], t[5]);
    if (lastUpdateDate.getTime() != currentUpdateDate.getTime()) {
      console.log("match:"+lastUpdateDate.getTime()+"=="+currentUpdateDate.getTime());
      $(function() {
        $( "#dialog-confirm" ).dialog({
          resizable: false,
          height:250,
          modal: true,
          buttons: {
            "Reload": function() {
              document.location.reload(true);
              $( this ).dialog( "close" );
            },
            Cancel: function() {
              $( this ).dialog( "close" );
            }
          }
        });
      });      
    } else {
      console.log("don't match:"+lastUpdateDate.getTime()+"=="+currentUpdateDate.getTime());
    }
  });
}

function endAjaxRequest() {

  $(".ui-dialog-buttonpane button:contains('Close')").button("enable");
  $(".ui-dialog-titlebar-close").show();
  // $("#password").val("");
}


function rowClickHandler(event) {
  _gaq.push(['_trackEvent', 'Requests', 'Row Clicked', 'Any Row', 1, true]);
	// for FF
  // console.log(event.target);
	var clickedClassName = 'undefined';
	if (typeof event.target !== 'undefined') {		
		clickedClassName = event.target.className;
	}
  // console.log("clickedClassName:"+clickedClassName);
	if ((clickedClassName != "itemCountInput") && (clickedClassName != "itemName") && (clickedClassName != "tablesorter-filter")) {
    _gaq.push(['_trackEvent', 'Requests', 'Row Clicked', 'Item Row', 1, true]);
		// console.log("1"+event.target.className);
		//console.debug(event);
		var currentID = $(this).attr('id');
		var myClass = $(this).attr("class");
		var cellID = $(this).children(".itemCount").attr("id");		
		var inputID = 'textBox-'+cellID;
		var itemCount = cellID.split('-')[2];
    var itemName = $(this).find(".itemLink").text();
		//console.debug($(this).children(".itemCount").attr("id").split('-')[2]);
		
		// console.log("1"+myClass);
		if ((typeof myClass === 'undefined') || (myClass.indexOf("hilite") == -1)) {
			// alert("added selection");
			
    if (itemName.indexOf("Green Hills of Stranglethorn") != -1) {
      itemCount = 1;
      console.log(itemName);
    }
		cellHtml = '<input type="text" class="itemCountInput" id="';
		cellHtml += inputID;
		cellHtml += '" value="';
		cellHtml += itemCount;
		cellHtml += '" />';
		$(this).children(".itemCount").html(cellHtml);
			// selections.push($(this).attr('id'));
		} else {
			// alert("removed selection");
			$(this).children(".itemCount").html(itemCount);
			// for (var i = 0; i < selections.length; i++) {
				// if (selections[i] == $(this).attr('id')) {
					// selections.splice(i,1);					
					// break;
				// }
			// }
		}			
		$(this).toggleClass('hilite');
		// console.debug(selections);
	}
}


		
	function doCheckout() {			  
    _gaq.push(['_trackEvent', 'Requests', 'Open Checkout Window', 'Clicked Checkout Link', 1, true]);
		// console.debug("top of doCheckout()");
    selections.splice(0,selections.length);
		itemCounts.splice(0,itemCounts.length);
    $('.hilite').each(function() {
      var rowID = $(this).closest('tr').attr('id');
      
      if (rowID  !== 'undefined') {
        //console.log(itemID);
        // var selectedCount = $('#'+itemID+'-count').html();
        // var rowID = $('#'+itemID).attr('rowID');
        selections.push(rowID);
        // itemCounts.push(selectedCount);
      } else {
        console.log($(this));
      }
    });
		if (selections.length <= 0) {
      alert("You have no items in your cart. Click a table row to make a selection.");
      return;
    }
    _gaq.push(['_trackEvent', 'Requests', 'Open Checkout Window', 'Checkout Dialog Opened', 1, true]);
    $('#checkoutStatus').hide();
    $(".ui-dialog-buttonpane button:contains('Checkout')").button("enable");
    $(".ui-dialog-buttonpane button:contains('Empty Cart')").button("enable");
		$.map(selections, function(item) {
			var itemCount = $("#"+item).children(".itemCount").children(".itemCountInput").val();
			itemCounts.push(itemCount);
		});

		$.ajax({			
		  url: "/backend/checkout.php",
		  type: 'POST',
		  data: {"selections[]" :selections, "itemCounts[]":itemCounts, "review":1, "ip":ipAddress},
      timeout : 20000,
      tryCount : 0,
      retryLimit : 3,
		  success: function(data) {
        $('#currentCart').html(data);
        $( "#dialog-form" ).dialog( "open" );
        $('.ui-dialog').css('height','600px')
		  },
      error: function(xhr, textStatus, errorThrown ) {
        if (textStatus == 'timeout') {
          this.tryCount++;
          if (this.tryCount <= this.retryLimit) {
              //try again
              $.ajax(this);
              return;
          }
            alert("Have tried to pull up your order " + this.retryLimit + " times and it is still not working. We give in. Sorry. Please try again. If issues persist please contact: webmaster@DOMAIN.");                   
            return;
          }              
        alert("Checkout process failed! Server responded with code: "+xhr.status+". Please try again. If issues persist please contact: webmaster@DOMAIN.");

      }
		});
	}
	
	function resetSelections() {
    $('.hilite').each(function() {
      var rowID = $(this).closest('tr').attr('id');
      itemCount = $("#"+rowID).children(".itemCount").children(".itemCountInput").attr("id").split('-')[3];
      $("#"+rowID).children(".itemCount").html(itemCount);
       $(this).removeClass("hilite");
      // if (rowID  !== 'undefined') {
        //console.log(itemID);
        // var selectedCount = $('#'+itemID+'-count').html();
        // var rowID = $('#'+itemID).attr('rowID');
        // selections.push(rowID);
        // itemCounts.push(selectedCount);
      // } else {
        // console.log($(this));
      // }
    });
		// console.debug("top of resetSelections()");
		// $.map(selections, function(item) {		
			// itemCount = $("#"+item).children(".itemCount").children(".itemCountInput").attr("id").split('-')[3];
			 // $("#"+item).removeClass('hilite');
			 // $("#"+item).children(".itemCount").html(itemCount);
		// });
		selections.splice(0,selections.length);
		itemCounts.splice(0,itemCounts.length);
	
	}
  
 
		
