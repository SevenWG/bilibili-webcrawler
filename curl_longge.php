<?php
/**
 *
 *龙哥爬虫
 *
 * @see
 * @author weiwei<@weiwei>
 * @license proprietary
 * @copyright Copyright (c) duxze.com
 */

    $curlobj = curl_init();// 初始化
    $this_header = array("content-type: application/x-www-form-urlencoded; charset=UTF-8");
    curl_setopt($curlobj,CURLOPT_HTTPHEADER,$this_header);

    $url ='https://zh.wikipedia.org/zh-hans/ICD-10 ';

    curl_setopt($curlobj, CURLOPT_URL,$url);
    curl_setopt($curlobj, CURLOPT_RETURNTRANSFER, 1);           // 执行之后不直接打印出来

    curl_setopt($curlobj, CURLOPT_HTTPAUTH, CURLAUTH_BASIC );
    curl_setopt($curlobj, CURLOPT_SSL_VERIFYPEER, false);//这个是重点。
    curl_setopt($curlobj, CURLOPT_SSL_VERIFYHOST, false);

    $output = curl_exec($curlobj);  // 执行

/*    $output1 = preg_replace_callback('/\\\\u([0-9a-f]{4})/i',
        'replace_unicode_escape_sequence', $output);*/

    $file = fopen("longge.txt","a+") or die("!!!!");
    fwrite($file, $output);
    fclose($file);


    function replace_unicode_escape_sequence($match) {
        return mb_convert_encoding(pack('H*', $match[1]), 'UTF-8', 'UCS-2BE');
    }