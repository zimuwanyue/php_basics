<?php

//定义一个接口
interface Skill
{
    function family();
    function buy();
}
//Person类，继承了Skill接口并实现了全部方法
class Person implements Skill
{
    function family(){
        echo '这是Person类的family方法<br/>';
    }
    function buy(){
        echo '这是Person类的buy方法<br/>';
    }
}
//JingLing类，继承了Skill接口并实现了全部方法
class JingLing implements Skill
{
    function family(){
        echo '这是JingLing类的family方法<br/>';
    }
    function buy(){
        echo '这是JingLing类的buy方法<br/>';
    }
}
//工厂模式
class Factory
{
    static function createHero($type)
    {
        switch($type){
            case 'person':
                return new Person();
                break;
            case 'jingling':
                return new JingLing();
                break;
        }
    }
}
//工厂类类名调用静态方法，根据传入参数得到不同的对象
$person = Factory::createHero('person');
$jing = Factory::createHero('jingling');
