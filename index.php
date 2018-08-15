<?php
    header("Content-type:text/html;charset=utf-8"); 
    //声明一个计算机脚本运行时间的类
    class Timer{
        private $startTime = 0;     //保存脚本开始执行时的时间(以微秒的形式保存)
        private $stopTime = 0;      //保存脚本结束执行时的时间(以微秒的形式保存)

        //在脚本开始处调用获取脚本开始时间的微秒值
        function start(){
            $this->startTime = microtime(true); //将获取的时间赋给成员属性$startTime
        }

        //在脚本结束处调用获取脚本结束时间的微秒值
        function stop(){
            $this->stopTime = microtime(true);  //将获取的时间戳赋给成员属性$stopTime
        }

        //返回同一脚本中两次获取时间的差值
        function spent(){
            return round(($this->stopTime - $this->startTime),4);
        }
    }
        $timer = new Timer();//创建Timer类的对象

        $timer->start();
        usleep(1000);
        $timer->stop();

        echo "执行该脚本用时<b>".$timer->spent()."</b>秒";
