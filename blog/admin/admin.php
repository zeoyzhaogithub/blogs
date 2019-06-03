<?php
include_once("../include.php");

include_once("../loginCheck.php");

//读取admins的数据
$sql = "select ad_id,ad_name from admins";
$sth = $db->prepare($sql);
$sth ->execute(
    array()
);
$userList = $sth ->fetchAll(PDO::FETCH_ASSOC); 

//删除管理员
switch($input->get('do')){
    case "deleteAdmin":
        $ad_id = $input->get('ad_id');

        if($ad_id < 1){
                return ajaxReturn(-1, "参数错误");
        }
        if($user['ad_id'] == $ad_id){
            return ajaxReturn(-2, "不可以删除自己");
        }

        $db -> beginTransaction();

        $sql = "select * from admins where ad_id = ?";
        $sth = $db->prepare($sql);
        $sth -> execute(array($ad_id));
        $adminItem = $sth ->fetch();

        if(!$adminItem){
            return ajaxReturn(-2,"管理员不存在");
        }

        if($adminItem){
            $sql = 'delete from admins where ad_id = ?';
            $sth = $db->prepare($sql);
            $sth ->execute(array($ad_id));
        }

        $db -> commit();
        header("location: admin.php");
    break;    
}



include_once("../view/admin.html");