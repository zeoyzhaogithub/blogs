<?php
include_once("include.php");


//分页

//当前页
$p = (int) $input->get('p');
if($p < 1){
    $p = 1;
} 

//每页显示数(从系统配置中读取)
$articleNum = con('article_page');

//应该跳过的页数
$offNum = $articleNum * ($p-1);

//获取博文总数
$sql = 'select count(*) as total from blog_files';
$sth = $db->prepare($sql);
$sth ->execute(array());
$articleCount = $sth ->fetchColumn(0);

//分页的文件名
$file = "index.php";

//实例化分页类
$pages = new page($articleCount,$articleNum,$p,$file);

//读取blog_files的数据
$sql = "select * from blog_files order by uptime desc limit {$offNum},{$articleNum}";
$articles = $db->query($sql);


include_once("./view/index.html");