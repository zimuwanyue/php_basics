<?php

interface PerfectMan
{
    function cook();
    function writePhp();
}

class Wife
{
    function cook(){
        echo '我会做满汉全席<br/>';
    }
}

class Man implements PerfectMan
{
    protected $wife;
    //在创建对象的时候保存传递进来的对象
    function __construct($wife){
        $this->wife = $wife;
    }
    function cook(){
        $this->wife->cook();
    }
    function writePhp(){
        echo '我会写php代码<br/>';
    }
}
$li = new Wife();
$ming = new Man($li);
$ming->WritePhp();
$ming->cook();
