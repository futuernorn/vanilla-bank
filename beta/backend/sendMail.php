<?php
$to = $_POST['to'];
$subject = $_POST['subject'];
$body = $_POST['body'];
$headers = $_POST['headers'];
mail($to, $subject, $body ,$headers);
?>
