
$(document).ready(function() {

  
    
  $( "#login-form" ).dialog({
      autoOpen: false,
      height: 375,
      maxHeight: 600,
      resizable: false,
      width: 560,
      modal: true,
      buttons: {
        "Login": function() {
          _gaq.push(['_trackEvent', 'Requests', 'Inside Login Window', 'Clicked Login Button', 1, true]);
          var bValid = true;
          name = $('#forumName').val();
          var password = $('#password').val();
          if ( bValid ) {
            $(".ui-dialog-buttonpane button:contains('Login')").button("disable");
            $(".ui-dialog-buttonpane button:contains('Close')").button("disable");
            $(".ui-dialog-titlebar-close").hide();
            $('#loginStatus').html("Logging you in...<img src='/images/ajax-loader.gif'></br>");
            $('#loginStatus').show();    
            		$.ajax({			
                url: '/forums/ucp.php?mode=login',
                type: 'POST',
                data: {username:name,password:password,login:'Login',sid:'',redirect:'index.php'},
                timeout : 20000,
                tryCount : 0,
                retryLimit : 3,
                success: function(data) {
                  var dumpData = $(data).find(".error").text(); 
                  if (dumpData != '') { 
                    $("#loginStatus").text(dumpData);
                    $(".ui-dialog-buttonpane button:contains('Login')").button("enable");
                    $(".ui-dialog-buttonpane button:contains('Close')").button("enable");
                    $(".ui-dialog-titlebar-close").show();
                  } else if (dumpData == '') { 
                     
                     $(".ui-dialog-buttonpane button:contains('Login')").button("enable");
                      endAjaxRequest();
                     window.loggedIn = true;
                      $.ajax({			
                    url: './backend/getUserData.php',
                    type: 'GET',
                    timeout : 20000,
                    tryCount : 0,
                    retryLimit : 3,
                    dataType: "json",
                    success: function(data) {
                      window.wowName = data.wowName;
                      window.SID = data.SID;
                      $('#forumName').html(data.username);
                      $('#userNameHeading').show();
                      $('#loginLink').attr('onClick','doLogout();');
                      $('#loginLink').html('Logout');
                    }
                    });
                    statusMessage = "Logged in successfully!"
                    if (loginCallback = 'doCheckout') {
                      statusMessage += "<br>Opening checkout dialog in a moment...<img src='/images/ajax-loader.gif'>"
                    } else if (loginCallback = 'updateMotd'){
                      statusMessage += "<br>Opening MOTD dialog in a moment...<img src='/images/ajax-loader.gif'>";
                    } else if (loginCallback = 'saveChanges'){
                      statusMessage += "<br>Saving changes in a moment...<img src='/images/ajax-loader.gif'>";
                    } else {
                      statusMessage += "<br>Closing dialog in a moment...<img src='/images/ajax-loader.gif'>";
                    }
                     $("#loginStatus").html(statusMessage);
                     setTimeout(function(){
                      $('#login-form').dialog('close');
                      if (loginCallback = 'doCheckout') {
                        doCheckout();
                        loginCallback = "";
                      } else if (loginCallback = 'saveChanges') {
                        saveChanges();
                        loginCallback = "";
                      } else if (loginCallback = 'updateMotd') {
                        updateMotd();
                        loginCallback = "";
                      }
                      },3000);
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

                      $(".ui-dialog-buttonpane button:contains('Login')").button("enable");
                      endAjaxRequest();
                      $('#loginStatus').html("Have tried to log you in " + this.retryLimit + " times and it is still not working. We give in. Sorry. Please try again. If issues persist please contact <a href='mailto:webmaster@DOMAIN'>webmaster@DOMAIN</a>.");                      
                      return;
                    }              
                  $('#loginStatus').html("Submission failed! Server responded with code: "+xhr.status+". Please try again. If issues persist please contact <a href='mailto:webmaster@DOMAIN'>webmaster@DOMAIN</a>.");

                  $(".ui-dialog-buttonpane button:contains('Login')").button("enable");
                 endAjaxRequest();
                }
                
              });
            
            
          } else {
           alert("wrong password/something else dummy");
           $( this ).dialog( "close" );
          }
        },
        "Close": function() {
          $( this ).dialog( "close" );
        }
      }
    });
 
});

function endAjaxRequest() {

  $(".ui-dialog-buttonpane button:contains('Close')").button("enable");
  $(".ui-dialog-titlebar-close").show();
  // $("#password").val("");
}

	
  function openLoginForm() {
    $(".ui-dialog-buttonpane button:contains('Login')").button("enable");
    $(".ui-dialog-buttonpane button:contains('Close')").button("enable");
    $(".ui-dialog-titlebar-close").show();
    $('#loginStatus').hide();
    $( "#login-form" ).dialog( "open" );
  }
	
  
  function doLogout() {
    var logoutURL = "http://DOMAIN/forums/ucp.php?mode=logout&sid="+window.SID;
  	$.ajax({			
      url: logoutURL,
      type: 'POST',
      timeout : 20000,
      tryCount : 0,
      retryLimit : 3,
      success: function(data) {
        var dumpData = $(data).find(".error").text(); 
        if (dumpData != '') { 
          alert(dumpData)
        } else if (dumpData == '') { 
           window.loggedIn = false;
            window.wowName = '';
            window.SID = '';
            $('#forumName').html('');
            $('#userNameHeading').hide();
            $('#loginLink').attr('onClick','openLoginForm();');
            $('#loginLink').html('Log in');
          
          alert("Logged out successfully!");
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

            alert("Have tried to log you out " + this.retryLimit + " times and it is still not working. We give in. Sorry. Please try again. If issues persist please contact <a href='mailto:webmaster@DOMAIN'>webmaster@DOMAIN</a>.");                      
            return;
          }              
        alert("Submission failed! Server responded with code: "+xhr.status+". Please try again. If issues persist please contact <a href='mailto:webmaster@DOMAIN'>webmaster@DOMAIN</a>.");

      }
      
    });
  }
		
