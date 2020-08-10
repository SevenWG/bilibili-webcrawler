<?php
/**
 *
 *将tag里的英文逗号转换为中文逗号，方便csv格式浏览
 *
 * @see
 * @author weiwei<@weiwei>
 * @license proprietary
 * @copyright Copyright (c) duxze.com
 */

    $file = fopen("newBilibiliAllData.txt","r") or die("!!!");
    $file1 = fopen("newBilibiliAllData2.txt","a+")or die("!!!!");

    $op = "\r\n";

    while(!feof($file)){
        $str = fgets($file);

        if ($str == ""){
            fwrite($file1,$op);
        }

        else{
            $loc = strpos($str,"tag:");
            $loc1 = strpos($str,"video_review:");

            $length = $loc1 -$loc;

            $substr = substr($str,$loc,$length);
            $substr_new = str_replace(",","， ",$substr).',';


            $str_new = substr_replace($str,$substr_new,$loc,$length);
            fwrite($file1,$str_new);
        }


    }

    fclose($file);
    fclose($file1);