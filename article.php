<?php
include_once("include.php");

$b_id = (int)$input->get('b_id');
if($b_id <1){
    exit('无效的参数');
}
$sql = 'select * from blog_files where b_id = ?';
$sth = $db->prepare($sql);
$sth ->execute(
    array($b_id)
    );
$article = $sth ->fetch(PDO::FETCH_ASSOC);
if(!$article){
    exit("不存在的数据");
}


include_once("./view/article.html");