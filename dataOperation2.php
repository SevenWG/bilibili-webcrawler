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

    $file = fopen("SubmittedData.txt","r")or die("!!!!");

    $authors = array();

    while(!feof($file)) {
        $str = fgets($file);

        if($str != "") {
            $loc = strpos($str,"author:");
            $loc1 = strpos($str,"favorites:");

            $length = $loc1-$loc;

            $subStr = (string)substr($str,$loc+7,$length-8);

            if(array_key_exists($subStr,$authors)){
                $authors[$subStr] = $authors[$subStr]+1;
            }else{
                $authors[$subStr] = 1;
            }
        }
    }

    arsort($authors);

    $file1 = fopen("AuthorsDataTest.txt","w")or die("!!!!!");
    $op = "\r\n";
    foreach ($authors as $key => $value) {
        $str = "作者：".$key.","."作品数：".$value.$op;
        fwrite($file1,$str);
    }



