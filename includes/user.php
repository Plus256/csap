<?php
require_once("includes/db.php");
//get user data from DB
$stmt=$conn->prepare("SELECT * FROM user WHERE id=?");
$stmt->execute([$user_id]);//$user_id is taken from wrapper that extracts ID from session
$user=$stmt->fetch();//default fetch is an associative array - was set at connection time
$user_name=$user["name"];
$user_screen_name=$user["screenname"];
$user_profile_image_url=$user["profileimageurl"];
?>