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
    
    //the point at which user data is added to DB
    require_once("includes/db.php");
    
    //we need to check if user data already exists with reference to the generated ACCESS TOKEN
    $user_access_token=$access_token['oauth_token'];
    $stmt=$conn->prepare("SELECT 1 FROM user WHERE token=?");//returns True or False when executed
    $stmt->execute([$user_access_token]);
    $count=stmt->fetchColumn();
    
    //User Exists
    if($count==1){
        //grant user access with a session based on the access token
        $_SESSION["logged"]=$access_token;//our UNIQUE IDENTIFIER
        header('Location: ./');
    }
    else{//New User
        $user=$connection->get("account/verify_credentials");
        $user_name=$user->name;
        $user_screen_name=$user->screen_name;
        $user_profile_image_url=$user->profile_image_url;
        $user_access_token_secret=$access_token['oauth_token_secret'];
        //add data to DB
        $stmt=$conn->prepare("INSERT INTO user(token, tokensecret, name, screenname, profile_image_url) VALUES (:token, :token_secret, :name, :screen_name, :profile_image_url)");
        $stmt->execute(["token"=>$user_access_token, "token_secret"=>$user_access_token_secret, "name"=>$user_name, "screen_name"=>$user_screen_name, "profile_image_url"=>$user_profile_image_url]);
        $stmt->rowCount();
        if($stmt>0){//record created
            //grant user access with a session based on the access token
            $_SESSION["logged"]=$access_token;//our UNIQUE IDENTIFIER
            header('Location: ./');
        }
    }
}
?>