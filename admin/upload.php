<?php
include_once("../include.php");

include_once("../loginCheck.php");

include_once("../common/upload.class.php");
/**
*上传文件
*/
$u = new upload();
$result = $u ->up('file1');

// {  编辑器需要的信息
//   "success": true/false,
//   "msg": "error message", # optional
//   "file_path": "[real file path]"
// }

//拼接编辑器需要的json数组
$arr = array();
if($result['error'] == 0){
      $arr['success'] = true;
    $arr['file_path'] = $result['full_filename'];
}else{
          $arr['msg'] = "错误代码".$result['error'];
}
echo json_encode($arr);






