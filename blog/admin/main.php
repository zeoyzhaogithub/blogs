<?php

include_once("../include.php");

include_once("../loginCheck.php");

if($input->get('do') == 'checkuser'){
    //获取传入的值
    $ad_name = $input->post('username');
    $password = md5($input->post('password'));
    $sql = "select * from admins where ad_name = ? and password = ?";
    $sth = $db->prepare($sql);
    $sth ->execute(
        array($ad_name,$password)
    );
    $adminList = $sth -> fetch(PDO::FETCH_ASSOC);
    if(!$adminList){
        echo "";
    }else{
        echo "success";
        header("location: index.php");
    }
}
include("../view/main.html");