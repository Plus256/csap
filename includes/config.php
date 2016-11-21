<?php
//configuration

/**
  *CsChat
  * MUK CS Advanced Programming Assignment Nov2016.
  * An Online Chat Application.
  *
  *@author Collins Wagaba
  *@copyright 2016 Plus256 Network, Ltd
  *@version 1.0
*/

//Sessions and Output Buffering
ob_start();
session_start();

//Database Connection
$host="127.0.0.1";
$db_name="cschat";
$db_user="";
$db_user_pwd="";
$charset="utf8";
$port=3306;
$dsn="mysql:host=$host;dbname=$db_name;charset=$charset;port=$port";
try{
    $conn=new PDO($dsn, $db_user, $db_user_pwd);
    $conn->setAttribute(PDO::ATTR_ERRMODE,  PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
    echo "Database Connection Failed: ".$e->getMessage();
}

//Global Variables
$app_name="CsChat";
$app_description="Online Chat Application";
?>