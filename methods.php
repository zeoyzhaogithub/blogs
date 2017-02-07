<?php
include_once("include.php");

include_once("loginCheck.php");

//删除管理员
function deleteAdmin(){
   
    $input = new input();

    $ad_id = $input->get('ad_id');

    if($ad_id < 1){
         return ajaxReturn(-1, "参数错误");
    }
    if($user['ad_id'] == $ad_id){
        return ajaxReturn(-2, "不可以删除自己");
    }

    $db = conndb();
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

    return ajaxReturn(1, "操作成功");
}

switch($input->get('method')){
    case "deleteAdmin":
        deleteAdmin();
    break; 
    default:
        ajaxReturn(-100, "不支持此操作");
}
