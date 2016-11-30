<?php
//Logout User
require_once("session.php");
$user_id=$_SESSION["logged"];//capture user ID before variable is unset
$session_track_id=$_SESSION["sesstrackid"];//session ID in DB
//delete the session from the DB then unset and destroy
require_once("db.php");
$stmt=$conn->prepare("DELETE FROM session WHERE user=? AND id=?");
//if user has multiple sessions, only the logged out device session is destroyed
//and the user appears online as long as they are logged into other devices
$stmt->execute([$user_id, $session_track_id]);
$deleted=$stmt->rowCount();
if($deleted>0){//session deleted
    session_unset();//remove all session variables
    if(session_destroy()){//destroy the session
        header('Location: ../');//return to home page
    }
}
?>