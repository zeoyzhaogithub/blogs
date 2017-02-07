<?php
include_once("../include.php");

include_once("../loginCheck.php");

$sql     = "select * from settings order by s_id asc";
$sth     = $db -> prepare($sql);
$sth     -> execute();
$configs = $sth -> fetchAll(PDO::FETCH_ASSOC);

if($input->get('do') == 'save'){

    $v = $input ->post('v',false);

    foreach($v as $key=>$val){

       $sql = "update settings set v=? where k=?";
       $sth = $db -> prepare($sql);
       $sth -> execute(
           array($val,$key)
       );

    }

    header("location: settings.php");
    exit;
}

include("../view/settings.html");