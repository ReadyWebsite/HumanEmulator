<?php
// получить строку по префиксам
function get_string($str1, $pr1, $pr2)
{
     //echo $str1."<br>";
     $ind1 = strpos ($str1,$pr1);
    // echo "инедкс 1 ".$ind1."<br>";
    if($ind1===false)
      return "";
     
     $ind2 = strpos ($str1,$pr2,$ind1);
    //echo "инедкс 2 ".$ind2."<br>";
     if($ind2===false)
        return "";

     $sres = substr($str1,$ind1+strlen($pr1), $ind2-$ind1-strlen($pr1));
     //echo $sres; 

    return trim($sres); 
}

// выдать сообщение в панель отладки
function  debug_mess($mess)
{
   global $dbg;
   // отладочные сообщения
   if($dbg)
      echo $mess."<br>";
}

// проверка есть ли такая строка в строке
function str_isexists($str1, $chek_str)
{
    if (strpos($str1, $chek_str) !== false) 
       return true;
    
    return false;
}

// размноживатель gmail
function gen_dot($email,&$emails) 
{ 
    list($name,$serv)=explode("@",$email); 
    $sdvig=strlen($name)-1; 
    $dec= ((1<<$sdvig)-1); 
    for($q=1;$q<=$dec;$q++)
    { 
        $names=$name; 
        $bin=sprintf("%".$sdvig."d",decbin($q)); 
        $lenbin=$sdvig-1; 
        for($w=$lenbin;$w>=0;$w--)
        { 
            if($bin[$w]==1) 
                $names=substr($names, 0, $w+1).'.'.substr($names, $w+1); 
        } 
        $emails[]=$names."@".$serv; 
    } 
    return true;  
}  

?>