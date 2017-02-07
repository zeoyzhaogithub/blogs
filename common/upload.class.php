<?php
class upload{

    function getFullFileName($filename){
        //存放上传文件的文件夹
        return $filedir = '../public/files/'.$filename;
    }

    function up($form_name){

        //获取上传文件名的信息
        $file1 = $_FILES[$form_name];
        //设置默认信息
        $result = array();
        $result['error'] = 0;
        $result['path'] = '';

        //判断文件是否上传成功
        if($file1['error'] >0){
            $result['error'] = $file1['error'];
            return $result;
        }

        //获取上传文件名的后缀，并转化为小写
        $ext = strtolower(pathinfo($file1['name'],PATHINFO_EXTENSION));

        //限制上传文件类型
        // if($ext == 'png' || $ext == 'jpg'){
        //     echo "上传文件";
        // }

        //拼接生成文件存储名称
        $filename = (int) microtime(true).".".$ext;
        //文件名
        $result['filename'] = $filename;
        //网站路径
        $result['full_filename'] = $this->getFullFileName($filename);
        //硬盘路径（域名）
        //$result['disk_filename'] = APP_PATH.$result['full_filename'];

        //将上传文件移动到指定的位置
        $isTrue = move_uploaded_file($file1['tmp_name'],$result['full_filename']);
        if(!$isTrue){
            return -1;
        }
        return $result;
    }
}