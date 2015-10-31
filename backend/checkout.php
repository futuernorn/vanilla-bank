<?php
$docRoot = "/home/SOME_PATH/www/";
include_once($docRoot."backend/common.php");
$common = new Common();

$selections = $_POST['selections'];
$itemCounts = $_POST['itemCounts'];
$ipAddress = $_POST['ip'];
$index = 0;
$cart = array();
$isOutdated = false;
foreach ($selections as $selection) {
  $query = "SELECT * from bankitems ".
      "WHERE id='$selection'";
  $result = $common->query($query);
  list($id, $banker, $itemName, $itemID, $itemCount, $color, $icon, $lastUpdate, $location) = $result->fetch_row();
	if (!is_array($cart[$banker])) {
		$cart[$banker] = array();
	}
  if ($location == "") {
    $location = "ItsAMystery";
  }
	$cart[$banker][] = array('itemName'=>$itemName,'count'=>$itemCounts[$index],'itemID'=>$itemID,'color'=>$color,'location'=>$location,'id'=>$id,'originalCount'=>$itemCount);
  $index++;  
}
ksort($cart);
$currentBanker = "";
$isFirstLine = true;

if ((isset($_POST['review'])) || (!isset($_POST['name']))) {
  foreach ($cart as $banker => $requests) {
    if (!$isFirstLine) {
      echo "<br><br>";
    } else {
      $isFirstLine = false;
    }
    echo "From: $banker<br>";
    foreach ($requests as $request) {    
      if (!isset($_POST['mobile'])) {
        echo $request['count'].' x <a href="'.AOWOWURL.'?item='.$request['itemID'].'" class="itemLink"><font class="itemName" color=#'.$request['color'].'>'.$request['itemName'].'</a></font><br>';
      } else {
        echo $request['count'].' x '.$request['itemName'].'<br>';
      }
    }
  } 
} else {
  define('IN_PHPBB', true);
  $phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : '../forums/';
  $phpbb_admin_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : '../forums/';
  $phpEx = substr(strrchr(__FILE__, '.'), 1);
  include($phpbb_root_path . 'common.' . $phpEx);
  include($phpbb_root_path . 'includes/functions_posting.' . $phpEx);
  include($phpbb_root_path . 'includes/functions_display.' . $phpEx);
  include($phpbb_root_path . 'includes/message_parser.' . $phpEx);
  $htmlMsg = "";
  $bbcodeMsg = "";
  foreach ($cart as $banker => $requests) {
    if (!$isFirstLine) {
      $htmlMsg .= "<br><br>";
      $bbcodeMsg .= "\r\n\r\n";
    } else {
      $isFirstLine = false;
    }
    $htmlMsg .=  "From: $banker<br>";
    $bbcodeMsg .= "From: $banker\r\n";
  
    foreach ($requests as $request) {
      // if (!isset($_POST['mobile'])) {
        $htmlMsg .=   $request['count'].' x <a href="'.AOWOWURL.'?item='.$request['itemID'].'" class="itemLink"><font class="itemName" color=#'.$request['color'].'>'.$request['itemName'].'</a></font> - '.$request['location'].'<br>';
      // } else {
        // $htmlMsg .= $request['count'].' x '.$request['itemName'].' - '.$request['location'].'<br>';
      // }
      $bbcodeMsg .= $request['count']." [b]x[/b] [URL=".AOWOWURL.'?item='.$request['itemID']."]".$request['itemName']."[/URL] - ".$request['location']."\r\n";   

    }
  }
  
  
  $user->session_begin();
  // Keep this, as we now overwrite this with the user of our choice
  $realuserdata= $user-> data;

  $sql= 'SELECT u.* FROM '. USERS_TABLE. ' u WHERE u.user_id= 2';  // Your account of choice
  $result= $db-> sql_query( $sql );
  if( $row= $db-> sql_fetchrow( $result ) ) {
      // Only overwrite Keys which actually exist, no other ones
      foreach( $row as $k1=> $v1 ) if( isset( $user-> data[$k1] ) ) $user-> data[$k1]= $v1;
  };
  $db-> sql_freeresult( $result );
  $auth-> acl( $user->data );  // Also take permissions of the new account


  // Start session management

  // $auth->acl($user->data);
  $user->setup('common');


  // $tmsg = request_var('tmsg', ''); // getting data from the submitted HTML form (name of the feild should be tmsg)
  $name = $_POST['name'];

  $debug = false;
  if (isset($_POST['debug']) && ($_POST['debug'] == "true")) {
	echo "checkout debug: ".var_dump($_POST['debug']);
    $debug = true;
  }
  if ($name == 'test-ignore') {
    $debug = true;
  }
  $mobile = false;
  if (isset($_POST['mobile'])) {
    $mobile = true;
  }

  $message = "[b]Request by:[/b] $name\r\n".$bbcodeMsg;//"test";
  if ($mobile) {
    $message .= "\r\n\r\n sent from my iPhone";
  }
  $rawsubject = "Bank Request - $name"; // subject of the newly made thread
  $to = "jeff.hogan1@gmail.com";//,cscoles@gmail.com";
  if ($debug) {
   $to = "jeff.hogan1@gmail.com";
  } 
   $headers  = 'MIME-Version: 1.0' . "\r\n";
  $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
   $headers .= 'From: WeirdoAdmin@DOMAIN' . "\r\n" .
      'Reply-To: WeirdoAdmin@DOMAIN' . "\r\n" .
      'X-Mailer: PHP/' . phpversion();
   $mailMessage = "<html><body><table border='0' cellpadding='2' cellspacing='2' width='95%' bgcolor='#000000'><tr><td bgcolor='#000000'><span style='color: #FFFFFF;'>".$htmlMsg."</span></td></tr></table></body></html>";
  $sendMailParams = array('to'=>$to,'subject'=>$rawsubject,'body'=>$mailMessage,'headers'=>$headers);
  // curl_post_async("http://DOMAIN/backend/sendMail.php", $sendMailParams);

  $forum = 12; //change to your forum id here
  $topic = 11;

  $time = time();

  $my_subject   = utf8_normalize_nfc($rawsubject, '', true);
  $my_text   = utf8_normalize_nfc($message, '', true);

  // variables to hold the parameters for submit_post
  $poll = $uid = $bitfield = $options = '';

  generate_text_for_storage($my_subject, $uid, $bitfield, $options, false, false, false);
  generate_text_for_storage($my_text, $uid, $bitfield, $options, true, true, true);

  $data = array(
         'forum_id'      => $forum,
         'topic_id'     => $topic,
         'icon_id'      => false,

         'enable_bbcode'      => true,
         'enable_smilies'   => true,
         'enable_urls'      => true,
         'enable_sig'      => true,

         'message'      => $my_text,
         'message_md5'   => md5($my_text),
                  
         'bbcode_bitfield'   => $bitfield,
         'bbcode_uid'      => $uid,

         'post_edit_locked'   => 0,
         'topic_title'      => $my_subject,
         'notify_set'      => false,
         'notify'         => false,
         'post_time'       => 0,//mktime(12, 0, 0, 12, 31, 2012),
         'forum_name'      => '',
         'enable_indexing'   => true,
         'updatePostTime' => false,
  );
  $returnData = "";
  // if (!$debug) {
    $returnData =  submit_post('reply', $my_subject, 'WeirdoAdmin', POST_NORMAL, $poll, $data);
  // }
  // $aUnused= array();
  // submit_post( 'post', $newdata['topic_title'], $user-> data['username'], $newdata['topic_type'], $aUnused, $newdata, TRUE, FALSE );
  // echo "<pre>";
  // print_r($returnData);
  // print_r($data);
  // echo "</pre>";
  $postID = $data['post_id'];

$index = 0;
foreach ($selections as $selection) {
  $query = "SELECT banker, itemID, itemName, icon, color, location from bankitems ".
    "WHERE id='$selection'";
  $result = $common->query($query);
  list($banker, $itemID, $itemName, $icon, $color, $location) = $result->fetch_row();
  $itemName = $common->real_escape_string($itemName);
  $name = $common->real_escape_string($name);
  $icon = $common->real_escape_string($icon);
  $currentCount = $itemCounts[$index];
  $query = "INSERT into orders (id, post_id, requester, item_id, item_name, item_icon, color, count, banker, location, ip) VALUES ".
    "(NULL, $postID, '$name', $itemID, '$itemName', '$icon', '$color', $currentCount, '$banker', '$location', '$ipAddress')";
  $result = $common->query($query);   
  $index++;  
    $query = "";
  if ($request['count'] >= $request['originalCount']) {
    $query = "DELETE FROM bankitems WHERE id=".$request['id'];
    // echo $request['itemName'].$query;
  } else {
    $query = "UPDATE bankitems SET itemCount =".($request['originalCount']-$request['count'])." WHERE id=".$request['id'];
    // echo $request['itemName'].$query;
  }
  $result = $common->query($query);
}

      
  // Revert data from logged on user
  $user-> data= $realuserdata;
  $auth->acl($user->data);
  $user->setup('common');
  if (!$mobile) {
    echo "Submission successful! Your request is located in this post: <a href='/forums/viewtopic.php?f=2&t=11&p=$postID#p$postID'>link</a>.<br>";
  } else {
    echo "Submission successful! Your request is located in this post: <a href='/forums/viewtopic.php?mobile=mobile&f=2&t=11&p=$postID#p$postID'>link</a>.<br>";
  }

}

function curl_post_async($url, $params) {
    foreach ($params as $key => &$val) {
      if (is_array($val)) $val = implode(',', $val);
        $post_params[] = $key.'='.urlencode($val);
    }
    $post_string = implode('&', $post_params);

    $parts=parse_url($url);

    $fp = fsockopen($parts['host'],
        isset($parts['port'])?$parts['port']:80,
        $errno, $errstr, 30);

    $out = "POST ".$parts['path']." HTTP/1.1\r\n";
    $out.= "Host: ".$parts['host']."\r\n";
    $out.= "Content-Type: application/x-www-form-urlencoded\r\n";
    $out.= "Content-Length: ".strlen($post_string)."\r\n";
    $out.= "Connection: Close\r\n\r\n";
    if (isset($post_string)) $out.= $post_string;

    fwrite($fp, $out);
    fclose($fp);
}

// function getLastUpdated($banker, $common) {
 // $query = "SELECT lastUpdated from bankitems WHERE banker='$banker' ORDER BY lastupdated DESC LIMIT 1";
	// $result = $common->query($query);
  // list($lastUpdated) = $result->fetch_row();
  // return $lastUpdated;
// }
?>
