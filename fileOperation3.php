<?php
/**
 *
 *
 *
 * @see
 * @author weiwei<@weiwei>
 * @license proprietary
 * @copyright Copyright (c) duxze.com
 */

    $file = fopen("bilibiliAllData.txt","r") or die("!!!");
    $file1 = fopen("newBilibiliAllData.txt","a+")or die("!!!!");

    $op = "\r\n";

    while(!feof($file)){
        $str = fgets($file);

        if ($str == ""){
            fwrite($file1,$op);
        }

        else{
            $loc = strpos($str,"description:");
            $loc1 = strpos($str,"pubdate:");

            $length = $loc1 -$loc;

            $substr = substr($str,$loc,$length);
            $substr_new = str_replace(",","， ",$substr).',';


            $str_new = substr_replace($str,$substr_new,$loc,$length);
            fwrite($file1,$str_new);
        }


    }

    fclose($file);
    fclose($file1);