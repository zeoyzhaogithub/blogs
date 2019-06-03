<?php
include_once("../include.php");

include_once("../loginCheck.php");


//删除博文
switch($input->get('do')){
    case "deleteBlog":
        $b_id = $input->get('b_id');

        if($b_id < 1){
            exit("参数错误");
        }

        $db -> beginTransaction();

        $sql = "select * from blog_files where b_id = ?";
        $sth = $db->prepare($sql);
        $sth -> execute(array($b_id));
        $blogItem = $sth ->fetch();

        if(!$blogItem){
            exit("博文不存在");
        }

        if($blogItem){
            $sql = 'delete from blog_files where b_id = ?';
            $sth = $db->prepare($sql);
            $sth ->execute(array($b_id));
        }

        $db -> commit();
        header("location: blogs.php");
    break; 
}

//分页

//当前页
$p = (int) $input->get('p');
if($p < 1){
    $p = 1;
} 

//每页显示数(从系统配置中读取)
$blogNum = con('adm_blog_page');

//应该跳过的页数
$offNum = $blogNum * ($p-1);

//获取博文总数
$sql = 'select count(*) as total from blog_files';
$sth = $db->prepare($sql);
$sth ->execute(array());
$blogCount = $sth ->fetchColumn(0);

//分页的文件名
$file = "blogs.php";

//实例化分页类
$pages = new page($blogCount,$blogNum,$p,$file);

//读取blog_files的数据

// $sql = 'select * from blog_files order by b_id desc limit ?,?';
// $sth = $db->prepare($sql);
// $sth ->execute(
//     array($offNum,$blogNum)
// );
// $blogList = $sth -> fetchAll(PDO::FETCH_ASSOC);

$sql = "select * from blog_files order by b_id desc limit {$offNum},{$blogNum}";
$blogList = $db->query($sql);

//var_dump($blogList);
//die;

include_once("../view/blogs.html");