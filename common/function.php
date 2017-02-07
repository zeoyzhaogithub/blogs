<?php
function ajaxReturn($code, $msg, $data = null){
    echo json_encode(array("status" => $code, "message" => $msg, "data" => $data));
}

/**
*读取系统配置
*/
function con($key){
    global $db;
    $sql = "select * from settings where k=?";
    $sth = $db -> prepare($sql);
    $sth -> execute(array($key));
    $row = $sth ->fetch(PDO::FETCH_ASSOC);

    if($row){
        return $row['v'];
    }
    return false;
}




