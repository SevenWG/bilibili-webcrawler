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

    $file = fopen("newBilibiliAllData2.txt","r")or die("!!!!");

    $countDance = 0;
    $countStory = 0;
    $countProducer = 0;
    $countAI = 0;
    $countOriginal = 0;
    $countTouhou = 0;
    $countVO = 0;
    $countMiku = 0;
    $countLuoTianyi = 0;
    $count = 0;
    while(!feof($file)){


       $str = fgets($file);

       if($str == ""){

       }
       else{
           $count++;
           if(strstr($str,"剧情MMD") != false) {
               $countStory++;
           }

           if(strstr($str,"舞蹈MMD") != false){
               $countDance++;
           }

           if(strstr($str,"恋与制作人") != false){
               $countProducer++;
           }

           if(strstr($str,"原创模型") != false){
               $countOriginal++;
           }

           if(strstr($str,"东方MMD") != false || strstr($str,"东方project") != false || strstr($str,"东方Project") != false || strstr($str,"东方PROJECT") != false){
                $countTouhou++;
           }

           if(strstr($str,"VOCALOID") != false || strstr($str,"V家")){
               $countVO++;
           }

           if(strstr($str,"初音") != false){
                $countMiku++;
           }

           if(strstr($str,"洛天依") != false){
                $countLuoTianyi++;
           }
       }

    }

    echo "Dance:".$countDance."\n";
    echo "Story:".$countStory."\n";
    echo "Producer:".$countProducer."\n";
    echo "Original:".$countOriginal."\n";
    echo "Touhou:".$countTouhou."\n";
    echo "VOCALOID:".$countVO."\n";
    echo "Miku:".$countMiku."\n";
    echo "LuoTianyi:".$countLuoTianyi."\n";
