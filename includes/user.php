<?php
require_once("includes/db.php");
//get user data from DB
$stmt=$conn->prepare("SELECT * FROM user WHERE id=?");
$stmt->execute([$user_id]);
?>