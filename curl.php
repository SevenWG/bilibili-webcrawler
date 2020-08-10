<?php
/*
 * 爬取B站MMD分区3月19-4月21日的所有视频信息
 *
 * */
    $curlobj = curl_init();// 初始化
    $this_header = array("content-type: application/x-www-form-urlencoded; charset=UTF-8");
    curl_setopt($curlobj,CURLOPT_HTTPHEADER,$this_header);

    for($i = 0; $i <72 ; $i++){
        $j = $i+1+500;
        $rand = rand(1524290000000,1524299999999);
        $url = "https://s.search.bilibili.com/cate/search?callback=jqueryCallback_bili_".$i.
            "&main_ver=v3&search_type=video&view_type=hot_rank&order=click&copy_right=-1&cate_id=25&page=".$j.
            "&pagesize=20&jsonp=jsonp&time_from=20180319&time_to=20180421&_=".$rand;

        curl_setopt($curlobj, CURLOPT_URL,$url);
        curl_setopt($curlobj, CURLOPT_RETURNTRANSFER, 1);           // 执行之后不直接打印出来

        curl_setopt($curlobj, CURLOPT_HTTPAUTH, CURLAUTH_BASIC );
        curl_setopt($curlobj, CURLOPT_SSL_VERIFYPEER, false);//这个是重点。
        curl_setopt($curlobj, CURLOPT_SSL_VERIFYHOST, false);

        $output = curl_exec($curlobj);  // 执行
        $file = fopen("bilibili2.txt","a+") or die("!!!!");
        fwrite($file, $output);
        fclose($file);


        $output1 = preg_replace_callback('/\\\\u([0-9a-f]{4})/i', 'replace_unicode_escape_sequence', $output);
        $file1 = fopen("bilibili3.txt","a+") or die("!!!!");
        fwrite($file1, $output1);
        fclose($file1);
    }

    $str = ' "str" ';


    function replace_unicode_escape_sequence($match) {
        return mb_convert_encoding(pack('H*', $match[1]), 'UTF-8', 'UCS-2BE');
    }
?>