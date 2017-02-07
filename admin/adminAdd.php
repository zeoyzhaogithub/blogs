<?php
include_once("../include.php");

include_once("../loginCheck.php");

$ad_id = (int) $input -> get('ad_id');
$userItem = array(
        'ad_id' => 0,
      'ad_name' => '',
     'password' => ''
);
if($ad_id > 0){

    $sql = "select * from admins where ad_id = ?";
    $sth = $db ->prepare($sql);
    $sth ->execute(
        array($ad_id)
    );

    $userItem = $sth->fetch(PDO::FETCH_ASSOC);

    if(!$userItem){
        return ajaxReturn(-100,"没有找到对应的用户");
    }
}

if($input->get('do') == 'save'){

    $ad_id = (int) $input -> post('ad_id');
    $ad_name = trim($input -> post('username'));
    $password = trim($input ->post('password'));

    //添加用户时，验证该过程
    if($ad_id < 1){
        if(empty($password || empty($ad_name))){
            exit("账户或密码不能为空");
        }
        $sql = "select * from admins where ad_name = ?";
        $sth = $db->prepare($sql);
        $sth ->execute(
            array($ad_name)
        );
        $userchecked = $sth ->fetch(PDO::FETCH_ASSOC);
        if(is_array($userchecked)){
            exit("账户名已经存在");
        }
    }

    //根据需求，更新数据库内容
    if($ad_id < 1){
        $password = md5($password);
        $sql = "insert into admins(ad_name,password)values(?,?)";
        $array = array($ad_name,$password);
    }else{
        //如果密码为空，则只修改用户名
        if(empty($password)){
            $sql = "update admins set ad_name = ? where ad_id = ?";
            $array = array($ad_name,$ad_id);
        }else{
            $password = md5($password);
            $sql = "update admins set ad_name = ?,password = ? where ad_id = ?";
            $array = array($ad_name,$password,$ad_id);
        }
    }

    $sth = $db->prepare($sql);
    $sth ->execute(
        $array
    );
    header("location: admin.php");
    exit; 
}

include_once("../view/adminAdd.html");