<?php
include_once("../include.php");

include_once("../loginCheck.php");

$b_id = $input->get('b_id');

$blog_filesItem = array(
        'b_id' => 0,
       'title' => '',
       'author'=> $user['ad_name'],
       'type'  => '',
     'content' => ''
);

if($b_id > 0){
    $sql = "select * from blog_files where b_id = ?";
    $sth = $db->prepare($sql);
    $sth ->execute(
        array($b_id)
    );
 
    $blog_filesItem = $sth ->fetch(PDO::FETCH_ASSOC);

    if(!$blog_filesItem){
        exit("没有找到对应的日志");
    }   
}

if($input->get('do') == 'save'){

    $b_id      = (int) $input -> post('b_id');
    $title     = trim($input -> post('title'));
    $author    = trim($input -> post('author'));
    $type      = trim($input -> post('type'));
    $content = trim($input ->post('content',false));
    //$content   = htmlspecialchars(trim($input ->post('content',false)));
    $nowTime   = time();

    if(empty($title) || empty($author) || empty($content) ){
        exit("请完整填写内容");
    }
        
    if($b_id > 0){

        $sql = "update blog_files set title=?,author=?,type=?,content=?,uptime=? where b_id = ?";
        $array = array($title,$author,$type,$content,$nowTime,$b_id);

    }else{

        $sql = "insert into blog_files(title,author,type,content,intime,uptime)values(?,?,?,?,?,?)";
        $array = array($title,$author,$type,$content,$nowTime,$nowTime);

    }

    $sth = $db->prepare($sql);
    $sth ->execute($array);
    header("location: blogs.php");
    exit(); 
}    
include("../view/writeBlog.html");