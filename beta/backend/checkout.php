<?php
$docRoot = "/home/SOME_PATH/www/beta/";
include_once($docRoot."backend/common.php");
$common = new Common();

$selectedItems = json_decode($_POST['selectedItems']);
// echo "<pre>";
// print_r($selectedItems);
// echo "</pre>";
// exit;
if (!$common->isLoggedIn()) {
  $data = array('success'=>-1,'msg'=>'Please log in to submit an order...');
  die(json_encode($data));
}
$data = array('success'=>true,'msg'=>'');
$index = 0;
$cart = array();
foreach ($selectedItems as $selection) {
  $itemName = $selection->itemName;
  $itemCount = $selection->itemCount;
  $itemID = $selection->itemID;
  $color = $selection->color;
  $location = $selection->location;
  $banker = $selection->banker;
  $query = "SELECT * from bankitems ".
      "WHERE id=".$selection->dbID;
  $result = $common->query($query);
  if ($result->num_rows == 1) {
    // list($id, $banker, $itemName, $itemID, $itemCount, $color, $icon, $lastUpdate, $location) = $result->fetch_row();
  } 
	if (!is_array($cart[$banker])) {
		$cart[$banker] = array();
	}
  if ($location == "") {
    
  }
	$cart[$banker][] = array('itemName'=>$itemName,'count'=>$itemCount,'itemID'=>$itemID,'color'=>$color,'location'=>$location);
  $index++;  
}
ksort($cart);
$currentBanker = "";
$isFirstLine = true;

if ((isset($_POST['review'])) || (!isset($_POST['name']))) {
  foreach ($cart as $banker => $requests) {
    if (!$isFirstLine) {
      $data['msg'] .= "<br><br>";
    } else {
      $isFirstLine = false;
    }
    $data['msg'] .= "From: $banker<br>";
    foreach ($requests as $request) {    
      if (!isset($_POST['mobile'])) {
        $data['msg'] .= $request['count'].' x <a href="'.$common::aowowURL.'?item='.$request['itemID'].'" class="itemLink"><font class="itemName" color=#'.$request['color'].'>'.$request['itemName'].'</a></font><br>';
      } else {
        $data['msg'] .= $request['count'].' x '.$request['itemName'].'<br>';
      }
    }
  } 
} else {

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
        $htmlMsg .=   $request['count'].' x <a href="'.$common::aowowURL.'?item='.$request['itemID'].'" class="itemLink"><font class="itemName" color=#'.$request['color'].'>'.$request['itemName'].'</a></font> - '.$request['location'].'<br>';
      // } else {
        // $htmlMsg .= $request['count'].' x '.$request['itemName'].' - '.$request['location'].'<br>';
      // }
      $bbcodeMsg .= $request['count']." [b]x[/b] [URL=".$common::aowowURL.'?item='.$request['itemID']."]".$request['itemName']."[/URL] - ".$request['location']."\r\n";      
    }
  }
  
  
  $common->loginForumsAdmin();


  // $tmsg = request_var('tmsg', ''); // getting data from the submitted HTML form (name of the feild should be tmsg)
  $name = $_POST['name'];

  $debug = false;
  if (isset($_POST['debug']) && ($_POST['debug'] == "true")) {
	$data['msg'] .= "checkout debug: ".var_dump($_POST['debug']);
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
  $to = "jeff.hogan1@gmail.com,cscoles@gmail.com";
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
  curl_post_async("http://DOMAIN/backend/sendMail.php", $sendMailParams);

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
  $returnData =  submit_post('reply', $my_subject, 'WeirdoAdmin', POST_NORMAL, $poll, $data);
  $postID = $data['post_id'];

$index = 0;
foreach ($selectedItems as $selection) {
  $icon = $selection->icon;
  $itemCount = $selection->itemCount;
  $itemID = $selection->itemID;
  $color = $selection->color;
  $location = $selection->location;
  $banker = $selection->banker;
  $itemName = $common->real_escape_string($selection->itemName);
  $name = $common->real_escape_string($name);
  $icon = $common->real_escape_string($icon);
  $query = "INSERT into orders (id, post_id, requester, item_id, item_name, item_icon, color, count, banker, location) VALUES ".
    "(NULL, $postID, '$name', $itemID, '$itemName', '$icon', '$color', $itemCount, '$banker', '$location')";
  $result = $common->query($query);   
  $index++;  
}

      
  // Revert data from logged on user
  $common->revertForumsUser();
  if (!$mobile) {
    $data['msg'] .= "Submission successful! Your request is located in this post: <a href='/forums/viewtopic.php?f=2&t=11&p=$postID#p$postID'>link</a>.<br>";
  } else {
    $data['msg'] .= "Submission successful! Your request is located in this post: <a href='/forums/viewtopic.php?mobile=mobile&f=2&t=11&p=$postID#p$postID'>link</a>.<br>";
  }

}

echo json_encode($data);

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
?>
