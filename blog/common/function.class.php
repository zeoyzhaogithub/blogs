<?php
//输入类
class input{
//默认过滤提交数据中的标签
    function post($key,$filter=true){
        if(isset($_POST[$key])){
            $value = $_POST[$key];
        }else{
            $value = null;
        }
        if($filter){
            $execValue = strip_tags($value);
        }else{
            $execValue = $value;
        }
        return $execValue;
    }

    function get($key){
        if(isset($_GET[$key])){
            $value = $_GET[$key];
        }else{
            $value = null;
        }
        $execValue = strip_tags($value);
        return $execValue;
    }

    function session($key){
        if(isset($_SESSION[$key])){
            $value = $_SESSION[$key];
        }else{
            $value = null;
        }
        $execValue = strip_tags($value);
        return $execValue;
    }

    function cookie($key){
        if(isset($_COOKIE[$key])){
            $value = $_COOKIE[$key];
        }else{
            $value = null;
        }
        $execValue = strip_tags($value);
        return $execValue;
    }
}

//分页类
class page{
    
    //存放最大页
    public $maxPage;
    //$p当前页
    function __construct($dataTotal,$pageTotal,$p,$file){
        $this->maxPage = ceil($dataTotal / $pageTotal);
        $this->p = $p;
        $this->file = $file;
    }

    function showPage(){
        //保存生成的分页代码
        $html = '';
        for($i = 1; $i <= $this->maxPage; $i++){
            if($this -> p == $i){
                $html .="<li><a href='{$this->file}?p=$i'style='color:red;'>$i</a></li>";
            }else{
                $html .="<li><a href='{$this->file}?p=$i'>$i</a></li>";
            }   
        }
        return $html;
    }
}