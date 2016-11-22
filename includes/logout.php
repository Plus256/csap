<?php
//Logout User
session_start();
session_unset();//remove all session variables
if(session_destroy(){//destroy the session
    header('Location: ../index.php');//return to home page
}
?>