<?php
session_start();

//验证是否登录
$session_ad_id = (int)$input ->session('ad_id');

$sql = "select * from admins where ad_id = ?";
$sth = $db->prepare($sql);
$sth -> execute(
    array($session_ad_id)
);
$user = $sth ->fetch(PDO::FETCH_ASSOC);

if(($session_ad_id < 1 || !is_array($user)) && (defined('NOT_LOGIN') ==false)){
    header("location: admin/entry.php");
    exit();
}