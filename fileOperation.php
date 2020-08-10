<?php
/**
 *
 *去掉爬下来的数据中的双引号
 *
 * @see
 * @author weiwei<@weiwei>
 * @license proprietary
 * @copyright Copyright (c) duxze.com
 */

    $file = fopen("bilibili1.txt","r") or die ("!!!");
    $file1 = fopen("bilibili1_new.txt","a+") or die("!!!!");
    while(!feof($file)){
        $str = fgets($file);
        $str = str_replace('"', '', $str);
        fwrite($file1,$str);
    }

    fclose($file);
    fclose($file1);


    $file2 = fopen("bilibili3.txt","r") or die ("!!!");
    $file3 = fopen("bilibili3_new.txt","a+") or die("!!!!");
    while(!feof($file2)){
        $str = fgets($file2);
        $str = str_replace('"', '', $str);
        fwrite($file3,$str);
    }

    fclose($file2);
    fclose($file3);


