<?php
//引入配置文件
//require_once(dirname(__FILE__)."/conf.php");
require_once(dirname(__FILE__)."/debug.php");

function conndb(){
    global $config;
    $dsn = "mysql:dbname={$config["database"]};host={$config["host"]};port={$config["port"]};charset={$config["charset"]}";
    $user = $config["username"];
    $password = $config["password"];

    try{
        $conn = new PDO($dsn,$user,$password);
    }catch(PDOException $e){
        echo ('Connection failed:'.$e->getMessage());
    }
    return $conn;
}
