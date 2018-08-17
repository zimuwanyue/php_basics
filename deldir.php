<?php
    /**
     * 自定义一个函数delDir()递归的删除整个目录
     */
    function delDir($directory){
        if($dir_handle = @opendir($directory)){          //如果不存在rmdir()会出错
            while($filename = readdir($dir_handle)){     //循环目录下的所有文件
                if($filename != '.' && $filename != '..'){  //一定要排除这两个特殊文件
                    $subFile = $directory.'/'.$filename; //将目录下的子文件和当前目录连接
                    if(is_dir($subFile)){       //如果是目录
                        delDir($subFile);   //递归调用自身函数，删除子目录
                    }
                    if(is_file($subFile)){      //如果是文件
                        unlink($subFile);   //直接删除这个文件
                    }
                }
            }
            closedir($dir_handle);  //关闭文件资源
            rmdir($directory);    //删除空目录
        }
    }
    delDir("phpmyadmin");  //删除空目录

