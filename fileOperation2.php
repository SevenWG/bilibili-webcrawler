<?php
/**
 *
 *将爬取到的数据按一行一个视频信息进行输出
 *
 * @see
 * @author weiwei<@weiwei>
 * @license proprietary
 * @copyright Copyright (c) duxze.com
 */

/*    $file = fopen("bilibili1_new.txt","r") or die("!!!!");
    $file1 = fopen("bilibili1_newOutput.txt","a+") or die("!!!!");
    $op = "\r\n";
    $str = "";

    while(!feof($file)){
        $ch = fgetc($file);
        $str = $str.$ch;

        if($ch == '}' && fgetc($file) == ','){
            fwrite($file1,$str);
            fwrite($file1,$op);
            $str = "";
        }

    }

    fclose($file);
    fclose($file1);*/

    $file = fopen("bilibili1_new.txt","r") or die("!!!!");
    $file1 = fopen("bilibili1_newTest.txt","a+") or die("!!!!");
    $op = "\r\n";
    $str = "";

    while(!feof($file)){
        $ch = fgetc($file);
        $str = $str.$ch;

        if($ch == '[' && fgetc($file) == '{'){
            fwrite($file1,$op);
            $str = '{';
        }

        if($ch == '}' && fgetc($file) == ','){
            fwrite($file1,$str);
            fwrite($file1,$op);
            $str = "";
        }

    }

    fclose($file);
    fclose($file1);