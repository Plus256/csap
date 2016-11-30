<?php
require_once("includes/session.php");
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
    $stmt=$conn->prepare("SELECT id FROM user WHERE token=?");
    $stmt->execute([$user_access_token]);
    $exists=$stmt->fetchColumn();//returns array with ID. false if empty.
    
    if(!$exists){//New User
        //connect with access token
        $connection=new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);
        $user=$connection->get("account/verify_credentials");
        $user_name=$user->name;
        $user_screen_name=$user->screen_name;
        $user_profile_image_url=$user->profile_image_url;
        $user_access_token_secret=$access_token['oauth_token_secret'];
        //add data to DB
        $stmt=$conn->prepare("INSERT INTO user(token, tokensecret, name, screenname, profileimageurl) VALUES (:token, :token_secret, :name, :screen_name, :profile_image_url)");
        $stmt->execute(["token"=>$user_access_token, "token_secret"=>$user_access_token_secret, "name"=>$user_name, "screen_name"=>$user_screen_name, "profile_image_url"=>$user_profile_image_url]);
        $inserted=$stmt->rowCount();//returns number of affected rows
        if($inserted>0){//record created
            //grant user access with a session based on last_insert_id
            $user_id=$conn->lastInsertId();//user id
            require("includes/login.php");
        }
    }
    else{//User Exists
       $user_id=$exists;//user id
       require("includes/login.php");
    }
}
?>