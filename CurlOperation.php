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

class CurlOperation
{
    private $curlobj;
    private $Header;
    private $url;
    private $firstPage;
    private $lastPage;
    private $beginDate;
    private $endDate;

    public function replace_unicode_escape_sequence($match)
    {
        return mb_convert_encoding(pack('H*', $match[1]), 'UTF-8', 'UCS-2BE');
    }

    public function execute()
    {
/*        $this->getRawData();
       $this->fileOperation();*/
/*        $this->fileOperation1();*/
        $this->fileOperation2();
    }

    public function curlInit()
    {
        $this->curlobj = curl_init();
        $this->Header = array("content-type: application/x-www-form-urlencoded; charset=UTF-8");
        curl_setopt($this->curlobj,CURLOPT_HTTPHEADER,$this->Header);

    }

    public function getRawData()
    {
        $this->curlInit();

        $this->firstPage = 1;
        $this->lastPage = 572;

        $this->beginDate = "20180319";
        $this->endDate = "20180421";

        $file = fopen("bilibiliRawData.txt","a+") or die("!!!!");

        for($i = $this->firstPage-1 ; $i < $this->lastPage; $i++){
            $currentPage = $i+1;
            $rand = rand(1524290000000,1524299999999);

            $this->url = "https://s.search.bilibili.com/cate/search?callback=jqueryCallback_bili_".$i.
                "&main_ver=v3&search_type=video&view_type=hot_rank&order=click&copy_right=-1&cate_id=25&page=".$currentPage.
                "&pagesize=20&jsonp=jsonp&time_from=".$this->beginDate."&time_to=".$this->endDate."&_=".$rand;

            curl_setopt($this->curlobj , CURLOPT_URL,$this->url);
            curl_setopt($this->curlobj , CURLOPT_RETURNTRANSFER, 1);           // 执行之后不直接打印出来

            curl_setopt($this->curlobj , CURLOPT_HTTPAUTH, CURLAUTH_BASIC );
            curl_setopt($this->curlobj , CURLOPT_SSL_VERIFYPEER, false);//这个是重点。
            curl_setopt($this->curlobj , CURLOPT_SSL_VERIFYHOST, false);

            $output = curl_exec($this->curlobj);  // 执行
            $output1 = preg_replace_callback('/\\\\u([0-9a-f]{4})/i', create_function('$matches', 'return iconv("UCS-2BE","UTF-8",pack("H*", $matches[1]));'), $output);
            fwrite($file,$output1);
        }
        fclose($file);
    }

    public function fileOperation()
    {
        $file = fopen("bilibiliRawData.txt","r") or die("!!!");
        $file1 = fopen("ProcessedData.txt","a+") or die("!!!!");

        while(!feof($file)){
            $str = fgets($file);
            $str = str_replace('"', '', $str);
            $str = str_replace("\\", '', $str);
            fwrite($file1,$str);
        }

        fclose($file);
        fclose($file1);
    }

    public function fileOperation1()
    {
        $file = fopen("ProcessedData.txt","r") or die("!!!!");
        $file1 = fopen("ModifiedData.txt","w") or die("!!!!");

        $op = "\r\n";
        $str = "";

        while(!feof($file)){
            $ch = fgetc($file);
            $str = $str.$ch;

            if($ch == '[' && fgetc($file) == '{'){
/*                fwrite($file1,$op);*/
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
    }

    public function fileOperation2()
    {
        $file = fopen("ModifiedData.txt","r") or die("!!!!");
        $file1 = fopen("SubmittedData.txt","w") or die("!!!!");

        $op = "\r\n";

        while(!feof($file)){
            $str = fgets($file);

            if ($str == ""){
                fwrite($file1,$op);
            }

            else{
                $newStr = $this->strOperation("description:","pubdate:",$str);
                $newStr1 = $this->strOperation("tag:","video_review:",$newStr);
                fwrite($file1,$newStr1);
            }
        }

        fclose($file);
        fclose($file1);
    }

    public function strOperation($beginNeedle,$endNeedle,$str)
    {

        $beginLoc = strpos($str, $beginNeedle);
        $endLoc = strpos($str,$endNeedle);
        $length = $endLoc-$beginLoc;

        $subStr = substr($str,$beginLoc,$length);
        $newSubStr = str_replace(",","， ",$subStr).',';
        $newStr = substr_replace($str,$newSubStr,$beginLoc,$length);
        return $newStr;
    }

}