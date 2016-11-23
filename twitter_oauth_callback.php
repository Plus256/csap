<?php
session_start();
require_once("twitter_oauth_credentials.php");

require("twitteroauth/autoload.php");
use Abraham\TwitterOAuth\TwitterOAuth;

$request_token=[];
$request_token['oauth_token']=$_SESSION["oauth_token"];
$request_token['oauth_token_secret']=$_SESSION["oauth_token_secret"];

if (isset($_REQUEST["oauth_token"]) && $request_token['oauth_token'] !== $_REQUEST["oauth_token"]) {
    // Abort! Something is wrong.
}
else{
    $connection=new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $request_token['oauth_token'], $request_token['oauth_token_secret']);
    $access_token=$connection->oauth("oauth/access_token", ["oauth_verifier"=>$_REQUEST["oauth_verifier"]]);
    
    //grant user access with a session based on the access token
    $_SESSION["logged"]=$access_token;
    header('Location: ./');
}
?>