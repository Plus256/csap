<?php
//Logout User
require_once("session.php");
session_unset();//remove all session variables
if(session_destroy()){//destroy the session
    header('Location: ../');//return to home page
}
?>