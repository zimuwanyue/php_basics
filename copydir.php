<?php
    /**
     * 自定义一个函数递归地复制带有多级子目录的目录
     * $dirSrc  源目录名称字符串
     * $dirTo   目标目录名称字符串
     */
    function copyDir($dirSrc,$dirTo){
        if(is_file($dirTo)){                //如果目标不是目录则退出
            echo '目标不是目录不能创建';
            return;
        }
        if(!file_exists($dirTo)){           //如果目标目录不存在则创建
            mkdir($dirTo);                  //创建目录
        }

        if($dir_handle = @opendir($dirSrc)){    //打开目录并判断是否成功
            while($filename = readdir($dir_handle)){ //循环遍历目录
                if($filename != '.' && $filename != '..'){   //排除这两个特殊文件
                    $subSrcFile = $dirSrc."/".$filename;    //将源目录的多级子目录连接
                    $subToFile = $dirTo."/".$filename;      //将目标目录的多级子目录连接

                    if(is_dir($subSrcFile)){                //如果是一个目录
                        copyDir($subSrcFile,$subToFile);    //递归调用自己复制子目录
                    }
                    if(is_file($subSrcFile)){               //如果源文件是一个普通文件
                        copy($subSrcFile,$subToFile);       //直接复制到目标位置
                    }
                }
            }
            closedir($dir_handle);      //关闭目录资源
        }
    }
    //测试函数，将目录"phpmyadmin"复制到"D:/admin"
    copyDir("phpmyadmin","D:/admin");
