<?php
    header("Content-type:text/html;charset=utf-8");   //防止乱码问题
    $num = 0;                    //用来统计子目录和文件的个数
    $dirname = 'phpmyadmin';     //保存当前目录下用来遍历的一个目录名
    $dir_handle = opendir($dirname);    //用opendir()函数打开目录

    //将遍历的目录和文件名使用表格格式输出
    echo '<table border="0" align="center" width="600">';
    echo '<caption><h2>目录'.$dirname.'下面的内容</h2></caption>';
    echo '<tr align="left" bgcolor="#ccc">';
    echo '<th>文件名</th><th>文件大小</th><th>文件类型</th><th>修改时间</th></tr>';

    //使用readdir循环读取目录里的内容
    while($file = readdir($dir_handle)){
        //将目录下的文件和当前目录连接起来，才能在程序中使用
        $dirFile = $dirname."/".$file;

        $bgcolor = $num++%2 == 0 ? '#fff' : '#ccc'; //隔行换一种颜色
        echo '<tr bgcolor='.$bgcolor.'>';
        echo '<td>'.$file.'</td>';                   //显示文件名
        echo '<td>'.filesize($dirFile).'</td>';      //显示文件大小
        echo '<td>'.filetype($dirFile).'</td>';      //显示文件类型
        echo '<td>'.date('Y/n/t',filemtime($dirFile)).'</td>'; //显示文件修改时间
    }
    echo '</table>';
    closedir($dir_handle); //关闭文件操作句柄

    echo '在<b>'.$dirname.'</b>目录下的子目录和文件夹共有<b>'.$num.'</b>个';
