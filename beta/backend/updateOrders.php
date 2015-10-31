<?php
$docRoot = "/home/SOME_PATH/www/";
include_once($docRoot."backend/common.php");
$common = new Common();
if (!$common->isLoggedIn()) {
  $data = array('success'=>-1,'msg'=>'Please log in to submit an order...');
  die(json_encode($data));
}
if (!isForumAdmin()) {
  $data = array('success'=>-2,'msg'=>"<br>ERROR ERROR UNABLE TO SET DATAS>>> ERRORS<br>Sup goon! Why don't you come back once you like eating cats?<br>");
  die(json_encode($data));
}
$common->loginForumsAdmin();
$data = array('success'=>true,'msg'=>'');
$orders = $_POST['orders'];

// update DB with recieved data
$postIDs = array();
if (count($orders) > 0) {
  foreach ($orders as $order) {
    $lineData = json_decode($order);
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
 $data['msg'] .= "No data recieveded.....ERROR EROROR>>>>><br>";
 die(json_encode($data));
}

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
      $bbcodeMsg .= $request['count']." [b]x[/b] [URL=".$common::aowowURL.'?item='.$request['itemID']."]".$request['itemName']."[/URL] - ".$request['location']."\r\n"; 
      if ($request['isDone'] == 1) {
        $bbcodeMsg .= "[/strike]\r\n";
      }
    }
  }
  
  $bbcodeMsg .= "Done!";
  $bbcodeMsg .= $bankerNotes;

  $message = "[b]Request by:[/b] $name\r\n".$bbcodeMsg;//"test";
  $rawsubject = "Bank Request - $name"; // subject of the newly made thread

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
   'post_time'       => 0,
   'forum_name'      => '',
   'enable_indexing'   => true,
  );
 
  submit_post( 'edit', $my_subject, "WeirdoAdmin", POST_STICKY, $poll, $data, true ); 

  $data['msg'] .= "Submission successful! ".$name."'s request post updated: <a href='/forums/viewtopic.php?f=2&t=11&p=$post_id#p$post_id'>link</a>.<br>";
}

echo json_encode($data);
$common->revertForumsUser();
?>
