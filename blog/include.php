<?php
date_default_timezone_set('PRC');

//当前文件路径
$dir = dirname(__FILE__);

//定义目录分隔符
define("DS", DIRECTORY_SEPARATOR );

//前端网址路径
define("URL_PATH",'http://blog.com');

//前端硬盘路径
define("APP_PATH",$dir);

//后台的网址路径前缀
//define("ADM_URL_PATH",'htpp://blog.com/admin');
define("ADM_URL_PATH",'localhost/blog/admin');


//后台的硬盘路径前缀
define("ADM_PATH",APP_PATH.'/admin');


//引入书库操作文件
require_once($dir.DS."common".DS."db.php");
$db = conndb();

require_once($dir.DS."common".DS."function.php");

require_once($dir.DS."common".DS."function.class.php");
$input = new input();
