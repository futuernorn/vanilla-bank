<?php
$docRoot = "/home/SOME_PATH/www/";
include_once($docRoot."backend/common.php");
$common = new Common();
define('IN_PHPBB', true);
$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : '../forums/';
$phpbb_admin_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : '../forums/';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);
include($phpbb_root_path . 'includes/functions_posting.' . $phpEx);
include($phpbb_root_path . 'includes/functions_display.' . $phpEx);
include($phpbb_root_path . 'includes/functions_user.' . $phpEx);
include($phpbb_root_path . 'includes/message_parser.' . $phpEx);

$user->session_begin();
// Keep this, as we now overwrite this with the user of our choice
if (!group_memberships(8,$user->data['user_id'], true) && !group_memberships(9,$user->data['user_id'], true) && !group_memberships(11,$user->data['user_id'], true)) {
  echo "<br>ERROR ERROR UNABLE TO SET DATAS>>> ERRORS<br>Sup goon! Why don't you come back once you like eating cats?<br>";
  exit;
}
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
$orders = $_POST['orders'];
// echo "<pre>";
// print_r($orders);
// echo "</pre>";

// update DB with recieved data
$postIDs = array();
if (count($orders) > 0) {
foreach ($orders as $order) {
  $lineData = json_decode($order);
  // $name = $common->real_escape_string($name);
  $note =  $common->real_escape_string($lineData->{'note'});
  $id = $lineData->{'id'};
  $status = $lineData->{'status'};
  $postID = $lineData->{'postID'};
  $query = "UPDATE orders SET note = '$note', isDone=$status WHERE id = $id";
  $result = $common->query($query);
  if (!in_array($postID, $postIDs)) {
    $postIDs[] = $postID;
  }
}
} else {
 echo "No data recieveded.....ERROR EROROR>>>>><br>";
}
// echo
foreach ($postIDs as $post_id) {
  $query = "SELECT * from orders ".
    "WHERE post_id=$post_id AND isDone=1 ".
    "ORDER BY banker ASC";
  $result = $common->query($query);
  if (mysqli_num_rows($result) <= 0) {
    continue;
  }
  // $name = "-";
  $result = $common->query($query);
  // echo $postID;
  $cart = array();
  $bankerNotes = "";
  $query = "SELECT * from orders ".
    "WHERE post_id=$post_id ".
    "ORDER BY banker ASC";
  $name = "-";
  $result = $common->query($query);
  while(list($id, $postID, $requester, $itemID, $itemName, $icon, $color, $count, $banker, $location, $isDone, $note) = $result->fetch_row()) {
    if (!is_array($cart[$banker])) {
      $cart[$banker] = array();
    }
    $cart[$banker][] = array('itemName'=>$itemName,'count'=>$count,'itemID'=>$itemID,'color'=>$color,'location'=>$location,'isDone'=>$isDone);
    if ($note != "") {
      if ($bankerNotes == "") {
        $bankerNotes = "\r\n\r\n[b]Banker Note:[/b]\r\n";
      }
      $bankerNotes .= $itemName." - ".$note."\r\n";
    }
    $name = $requester;
  }
  ksort($cart);
  $currentBanker = "";
  $isFirstLine = true;
  

  $bbcodeMsg = "";
  foreach ($cart as $banker => $requests) {
    if (!$isFirstLine) {
      $bbcodeMsg .= "\r\n\r\n";
    } else {
      $isFirstLine = false;
    }
    $bbcodeMsg .= "From: $banker\r\n";
  
    foreach ($requests as $request) {
      if ($request['isDone'] == 1) {
        $bbcodeMsg .= "[strike]";
      }
      $bbcodeMsg .= $request['count']." [b]x[/b] [URL=".AOWOWURL.'?item='.$request['itemID']."]".$request['itemName']."[/URL] - ".$request['location']."\r\n"; 
      if ($request['isDone'] == 1) {
        $bbcodeMsg .= "[/strike]\r\n";
      }
    }
  }
  
  $bbcodeMsg .= "Done!";
  // if ($bankerNotes != "\r\n[b]Banker Note:[/b]\r\n") {
    $bbcodeMsg .= $bankerNotes;
  // }
  



  // $tmsg = request_var('tmsg', ''); // getting data from the submitted HTML form (name of the feild should be tmsg)
  // $name = $_POST['name'];



  $message = "[b]Request by:[/b] $name\r\n".$bbcodeMsg;//"test";

  $rawsubject = "Bank Request - $name"; // subject of the newly made thread

  $forum = 12; //change to your forum id here
  $topic = 11;

  $time = time();

  $my_subject   = utf8_normalize_nfc($rawsubject, '', true);
  $my_text   = utf8_normalize_nfc($message, '', true);

  // variables to hold the parameters for submit_post
  $poll = $uid = $bitfield = $options = '';

  generate_text_for_storage($my_subject, $uid, $bitfield, $options, false, false, false);
  generate_text_for_storage($my_text, $uid, $bitfield, $options, true, true, true);
           // $data['poster_id'] = $poster_id;
            // $data['post_edit_user'] = 1; //Usernumber of an admin.
            // $data['post_edit_reason'] = ''; // Not setting to prevent notification in post (not wanted for conversion...)
            // $data['topic_replies_real'] = '';
            // $data['post_edit_count'] = 0; //Conversion, no edit, no count!
  $data = array(
         'forum_id'      => $forum,
         'post_id'      => $post_id,
         'poster_id'    => 2,
         'post_edit_user' => 2,
         'post_edit_reason' => 'Updated by: '.$_POST['name']." from admin page.",
         'topic_replies_real' => 1,
         'post_edit_count' => 1,
         'icon_id'      => false,
         'topic_id' => $topic,

         'enable_bbcode'      => true,
         'enable_smilies'   => true,
         'enable_urls'      => true,
         'enable_sig'      => true,
         'topic_approved' => true,
         'post_approved' => true,

         'message'      => $my_text,
         'message_md5'   => md5($my_text),
                  
         'bbcode_bitfield'   => $bitfield,
         'bbcode_uid'      => $uid,

         'post_edit_locked'   => 0,
         'topic_title'      => "Guild Bank Request Thread",
         'post_subject'     => $my_subject,
         'notify_set'      => false,
         'notify'         => false,
         'post_time'       => 0,//mktime(12, 0, 0, 12, 31, 2012),
         'forum_name'      => '',
         'enable_indexing'   => true,
         'updatePostTime' => false,
  );
  // $returnData = "";
  // if (!$debug) {
    // $returnData =  submit_post('edit', $my_subject, 'WeirdoAdmin', POST_NORMAL, $poll, $data);
  // }
  // $aUnused= array();
  // submit_post( 'post', $newdata['topic_title'], $user-> data['username'], $newdata['topic_type'], $aUnused, $newdata, TRUE, FALSE );
  // echo "<pre>";
  // print_r($returnData);
  // print_r($data);
  // echo "</pre>";
  // $postID = $data['post_id'];
// $data['post_subject'] = $my_subject;
// $data['topic_title'] = 'Title of first post (and therefore topic title)';
// $currentPostID = $postID;
// $data['post_id'] = $post_id;
// $data['edit_post_id'] = $postID;
// $data['post_username'] = 'WeirdoAdmin';
// $data['topic_id'] = $topic;
// $data['forum_id'] = $forum;
// $data['icon_id'] = false;
// $data['message'] = $my_text;
// $data['message_md5'] = md5($my_text);
// $data['poster_id'] = 2; //ID of Author Beta
// $data['post_edit_user'] = 2; //Usernumber of an admin.
// $data['post_edit_reason'] = 'Bank Admin Page'; // Not setting to prevent notification in post (not wanted for conversion...)
// $data['topic_replies_real'] = 1;
// $data['topic_first_post_id'] = 24;
// $data['topic_last_post_id'] = 9999999;
// $data['post_edit_count'] = 1; //Conversion, no edit, no count!
// $data['topic_approved'] = true;
// $data['topic_title'] = $my_subject;
// $data['post_approved'] = true;
// echo  "post ID:".$data['post_id'];
  submit_post( 'edit', $my_subject, "WeirdoAdmin", POST_STICKY, $poll, $data, true ); 
  // Revert data from logged on user

  
    echo "Submission successful! ".$name."'s request post updated: <a href='/forums/viewtopic.php?f=2&t=11&p=$post_id#p$post_id'>link</a>.<br>";
// echo  "post ID:".$data['post_id'];
}
  $user-> data= $realuserdata;
  $auth->acl($user->data);
  $user->setup('common');
/*
$itemCounts = $_POST['itemCounts'];
$index = 0;
$cart = array();
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
	$cart[$banker][] = array('itemName'=>$itemName,'count'=>$itemCounts[$index],'itemID'=>$itemID,'color'=>$color,'location'=>$location);
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
      if (!isset($_POST['mobile'])) {
        $htmlMsg .=   $request['count'].' x <a href="'.AOWOWURL.'?item='.$request['itemID'].'" class="itemLink"><font class="itemName" color=#'.$request['color'].'>'.$request['itemName'].'</a></font> - '.$request['location'].'<br>';
      } else {
        $htmlMsg .= $request['count'].' x '.$request['itemName'].' - '.$request['location'].'<br>';
      }
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
  if (isset($_POST['debug'])) {
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

  if (!$debug) {
   $to = "jeff.hogan1@gmail.com,cscoles@gmail.com";
  } else {
   $to = "jeff.hogan1@gmail.com";
  }
   $headers  = 'MIME-Version: 1.0' . "\r\n";
  $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
   $headers .= 'From: WeirdoAdmin@DOMAIN' . "\r\n" .
      'Reply-To: WeirdoAdmin@DOMAIN' . "\r\n" .
      'X-Mailer: PHP/' . phpversion();
   $mailMessage = "<html><body><table border='0' cellpadding='2' cellspacing='2' width='95%' bgcolor='#000000'><tr><td bgcolor='#000000'><span style='color: #FFFFFF;'>".$htmlMsg."</span></td></tr></table></body></html>";
  mail($to, $rawsubject, $mailMessage ,$headers);


  $forum = 2; //change to your forum id here
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
         'post_time'       => 0,
         'forum_name'      => '',
         'enable_indexing'   => true,
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
  $icon = $common->real_escape_string($icon);
  $currentCount = $itemCounts[$index];
  $query = "INSERT into orders (id, post_id, requester, item_id, item_name, item_icon, color, count, banker, location) VALUES ".
    "(NULL, $postID, '$name', $itemID, '$itemName', '$icon', '$color', $currentCount, '$banker', '$location')";
  $result = $common->query($query);   
  $index++;  
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
*/
?>
