<?php
    header("Content-type:text/html;charset=utf-8");
    /**
     * 自定义一个函数dirSize()用来统计目录大小
     */
    function dirSize($directory){
        $dir_size = 0;      //用于累加各个文件大小

        if($dir_handle = @opendir($directory)){          //打开目录，并判断是否可以成功打开
            while($filename = readdir($dir_handle)){     //循环目录下的所有文件
                if($filename != '.' && $filename != '..'){  //一定要排除这两个文件
                    $subFile = $directory.'/'.$filename; //将目录下的子文件和当前目录连接
                    if(is_dir($subFile)){       //如果是目录
                        $dir_size += dirSize($subFile);   //递归调用自身函数，求子目录的大小
                    }
                    if(is_file($subFile)){      //如果是文件
                        $dir_size += filesize($subFile);   //求子文件的大小
                    }
                }
            }
            closedir($dir_handle);  //关闭文件资源
            return $dir_size;       //返回目录总大小
        }
    }
    $dir_size = dirSize("phpmyadmin");  //调用该函数计算目录大小
    echo round($dir_size/pow(1024,1),2)."KB";  //字节数转换成"KB"单位并输出
