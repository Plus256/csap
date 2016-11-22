<?php
//Database Connection
$db_name="";
$db_user="";
$db_user_pwd="";//these values have been purposely left out
$host="127.0.0.1";
$charset="utf8";
$port=3306;
$dsn="mysql:host=$host;dbname=$db_name;charset=$charset;port=$port";
$pdo_opt=[
    PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES=>false
];
try{
    $conn=new PDO($dsn, $db_user, $db_user_pwd);
}
catch(PDOException $e){
    echo "Database Connection Failed: ".$e->getMessage();
}
?>