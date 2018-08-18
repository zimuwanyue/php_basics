<?php
    header("Content-type:text/html;charset=utf-8"); 
    require "fileupload.class.php";

    $up = new FileUpload();     //加载文件上传类

    /*可以通过set方法设置上传的属性，可以设置多个属性，set()方法可以单独调用，也可以连贯操作一起调用多个*/
    $up->set('path','./Images')
        ->set('size',1000000)
        ->set('allowtype',array('jpg','gif','png'))
        ->set('israndname',true);

    /*调用$up对象的upload()方法上传文件，myfile是表单名称，成功返回true，失败返回false*/
    if($up->upload('myfile')){
        //上传多个文件时，下面的方法返回的数组，存放所有上传后的文件名，单个文件上传则直接返回文件名称
        print_r($up->getFileName());
    }else{
        //上传多个文件时，下面的方法返回的是数组，存放多条出错信息，单个文件上传出错则直接返回一条错误报告
        print_r($up->getErrorMsg());
    }
