var user = "";
var bankerFilterBox = 'undefined';
var loginCallback = '';
var selectedItems = []; //declare object
$(document).ready(function() {
	$("#bankers_table").tablesorter({
    cssInfoBlock : "tablesorter-no-sort", 		
		widgets: ['zebra', 'stickyHeaders', 'filter'],
    widgetOptions: {
      filter_functions : window.filter_functions_list
    }
	});
  
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
          // var password = $('#password').val();
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
                data: {"selectedItems": JSON.stringify(selectedItems), "debug":window.debug, "name":name},
                timeout : 20000,
                tryCount : 0,
                retryLimit : 3,
                dataType: "json",
                success: function(data) {
                  if (data.status == -1) {
                    window.loggedIn = false;
                    alert(data.msg);
                    console.log("window.loggedIn: "+window.loggedIn);
                    loginCallback = 'doCheckout';
                    openLoginForm();
                  } else {
                    endAjaxRequest();
                    resetSelections();
                    $('#currentCart').html("Empty");
                    $('#checkoutStatus').html(data.msg);    
                  }
 
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
      }
    });
 
	$('tbody tr').click(rowClickHandler); 	
});

function endAjaxRequest() {

  $(".ui-dialog-buttonpane button:contains('Close')").button("enable");
  $(".ui-dialog-titlebar-close").show();
  // $("#password").val("");
}


function rowClickHandler(event) {
  _gaq.push(['_trackEvent', 'Requests', 'Row Clicked', 'Any Row', 1, true]);
	var clickedClassName = 'undefined';
	if (typeof event.target !== 'undefined') {		
		clickedClassName = event.target.className;
	}
	if ((clickedClassName != "itemCountInput") && (clickedClassName != "itemName") && (clickedClassName != "tablesorter-filter")) {
    _gaq.push(['_trackEvent', 'Requests', 'Row Clicked', 'Item Row', 1, true]);
		var myClass = $(this).attr("class");
		var cellID = $(this).children(".itemCount").attr("id");		
		var inputID = 'textBox-'+cellID;
		var itemCount = cellID.split('-')[2];		
		if ((typeof myClass === 'undefined') || (myClass.indexOf("hilite") == -1)) {
      cellHtml = '<input type="text" class="itemCountInput" id="';
      cellHtml += inputID;
      cellHtml += '" value="';
      cellHtml += itemCount;
      cellHtml += '" />';
      $(this).children(".itemCount").html(cellHtml);
		} else {
			$(this).children(".itemCount").html(itemCount);
		}			
		$(this).toggleClass('hilite');
	}
}


		
	function doCheckout() {			  
    _gaq.push(['_trackEvent', 'Requests', 'Open Checkout Window', 'Clicked Checkout Link', 1, true]);
    selectedItems.splice(0,selectedItems.length);
    $('.hilite').each(function() {
      var dbID = $(this).closest('tr').attr('id');
      if (dbID  !== 'undefined') {
        var itemID = $("#"+dbID).attr('itemID');
        var icon = $("#"+dbID).attr('icon');
        var itemCount = $("#"+dbID).children(".itemCount").children(".itemCountInput").val();
        var itemName = $("#"+dbID).find(".itemLink").text();
        var banker = $("#"+dbID).find(".itemBanker").text();
        var location = $("#"+dbID).find(".itemBanker").attr('title');
        var color = $("#"+dbID).find(".itemColor").attr('color').substring(1);
        
        selectedItems.push({dbID: dbID, itemID: itemID, itemCount: itemCount, itemName: itemName, banker: banker, location:location, color:color, icon:icon});
        
      } else {
        console.log("errors: "+$(this));
      }
    });
    // console.log();
    // return;
		if (selectedItems.length <= 0) {
      alert("You have no items in your cart. Click a table row to make a selection.");
      return;
    }
    if (!window.loggedIn) {
      alert("You're currently not logged in, please log in now.");
      console.log("window.loggedIn: "+window.loggedIn);
      loginCallback = 'doCheckout';
      openLoginForm();
      return;
    } else {
      // console.log("window.loggedIn: "+window.loggedIn);
    }

    _gaq.push(['_trackEvent', 'Requests', 'Open Checkout Window', 'Checkout Dialog Opened', 1, true]);
    if (window.wowName == "") {
      $('#name').val($('#forumName').text());
    } else {
      $('#name').val(window.wowName);
    }
    
    $('#checkoutStatus').hide();
    $(".ui-dialog-buttonpane button:contains('Checkout')").button("enable");
    $(".ui-dialog-buttonpane button:contains('Empty Cart')").button("enable");

		$.ajax({			
		  url: "/beta/backend/checkout.php",
		  type: 'POST',
		  data: {"selectedItems": JSON.stringify(selectedItems), "review":1},
      timeout : 20000,
      tryCount : 0,
      retryLimit : 3,
      dataType: "json",
		  success: function(data) {
        if (data.status == -1) {
          window.loggedIn = false;
          alert(data.msg);
          console.log("window.loggedIn: "+window.loggedIn);
          loginCallback = 'doCheckout';
          openLoginForm();
        } else {
          $('#currentCart').html(data.msg);
          $( "#dialog-form" ).dialog( "open" );
          $('.ui-dialog').css('height','600px')
        }
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
    });	
    selectedItems.splice(0,selectedItems.length);
	}
  
