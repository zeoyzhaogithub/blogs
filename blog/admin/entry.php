<?php
include_once("../include.php");

define("NOT_LOGIN",1); //该页面不需要进行登陆校验

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
    $admin = $sth -> fetch(PDO::FETCH_ASSOC);
    if(!$admin){
       exit("用户名或者密码错误");
    }else{
        $_SESSION['ad_id'] = $admin['ad_id'];
        
        header("location: main.php");
    }
}

//退出登录
if($input->get('do') == 'out'){
    $_SESSION['ad_id'] = 0;
}

include("../view/entry.html");