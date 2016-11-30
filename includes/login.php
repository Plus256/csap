<?php
$_SESSION["logged"]=$user_id;//our UNIQUE IDENTIFIER
//we track session then redirect user
$stmt=$conn->prepare("INSERT INTO session (user) VALUES (?)");
$stmt->execute([$user_id]);
$inserted=$stmt->rowCount();
if($inserted>0){//record created
    $session_track_id=$conn->lastInsertId();//session id in DB.
    //NOT to be confused with server (REAL/TRUE) session ID
    $_SESSION["sesstrackid"]=$session_track_id;
    header('Location: ./');
}
?>