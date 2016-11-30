<?php
//to solve the problem of creating new session ID with each request in some browsers
//we created this file to configure the runtime session parameters
//to avoid conflicts in the root directory
session_set_cookie_params(0, "/csap", ".plus256.com");//set session cookie parameters
session_save_path("/home/ourfc/public_html/csap/sess");//set directory of this app's session data
session_start();
?>