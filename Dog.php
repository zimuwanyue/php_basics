<?php

class Dog
{
    //将构造函数私有化
    private function __construct(){}
    //定义私有静态属性，用于保存唯一对象
    static private $instance;
    //公开的静态私有方法，属于类而不是对象，可用类名直接调用
    static public function getInstance()
    {
        /*判断静态属性$instance是否为空，如果为空就new一个对象
        如果不为空就直接返回*/
        if(!self::$instance){
            self::$instance = new self();
        }
        return self::$instance;
    }
}
$Dog1 = Dog::getInstance();
$Dog2 = Dog::getInstance();
//测试
if($Dog1 === $Dog2){
    echo '这是同一个对象';
}else{
    echo '这不是同一个对象';
}
