<?php
//观察者模式涉及到两个类
//男人类和女朋友类
//男人类小明  女朋友类小花和小丽
class Man
{
    //用来存放观察者
    protected $observers = array();
    //添加观察者方法
    function addObserver($observer){
        $this->observers[] = $observer;
    }
    //花钱方法
    function buy(){
        //当被观察者做出这个行为的时候，让观察者得到通知，并且做出一定的反应
        foreach($this->observers as $girl){
            $girl->dongjie();
        }
    }
    function delObserver($observer){
        //查找对应值在数组中的键
        $key = array_search($observer,$this->observers);
        //根据键删除值，并且数组重新索引
        array_splice($this->observers,$key,1);
    }
}

class GirlFriend
{
    function dongjie(){
        echo '你的男朋友正在花钱，马上冻结他的银行卡<br/>';
    }
}
//创建对象
$xiaoming = new Man();
$xiaohua = new GirlFriend();
$xiaoli = new GirlFriend();

//添加观察者
$xiaoming->addObserver($xiaohua);
$xiaoming->addObserver($xiaoli);
//删除观察者
$xiaoming->delObserver($xiaohua);
//当小明花钱时，观察者对象小花和小丽调用dongjie方法
$xiaoming->buy();
