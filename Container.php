<?php

//轮胎类==》汽车类
class LunTai
{
    function roll(){
        echo '轮胎在滚动<br/>';
    }
}
//汽车类
class BMW
{
    protected $luntai;
    //注入方式
    function __construct($luntai){
        $this->luntai = $luntai;
    }
    function run(){
        $this->luntai->roll();
        echo '开着宝马吃烤串';
    }
}
//容器
class Container
{
    //存放所绑定的类
    static $register = array();
    //绑定函数
    static function bind($name,Closure $col){
        self::$register[$name] = $col;
    }
    //创建对象函数
    static function make($name){
        $col = self::$register[$name];
        return $col();
    }
}
//绑定轮胎类对象
Container::bind('luntai',function(){
    return new LunTai();
});
//绑定汽车类对象
Container::bind('bmw',function(){
    return new BMW(Container::make('luntai'));
});
//创建汽车类对象
$bmw = Container::make('bmw');
//调用汽车类中的run方法，输出'轮胎在滚动 开着宝马吃烤串'
$bmw->run();
