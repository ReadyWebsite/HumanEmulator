<?php
// разобрать результаты
function parse_results()
{
    global $str_res_file,$webpage,$textfile;
    // получить все ряды
    $str_res=$webpage->get_body_inter_prefix_all("<tr","</tr>");
    // разобрать в массив
    $a_res=explode("<br>",$str_res);
    // пройтись по всему массиву
    for($j=0;$j<count($a_res);$j++)
    {
         // echo $a_res[$j]."<br>";
         // если домен свободен
        if(strpos($a_res[$j],"Свободен")!==false)
        {
           // запишем в файл
           $textfile->add_string_to_file($str_res_file,get_string($a_res[$j],"<td>","</td>")."\r\n",60) ;
        }
    }
     
    return true;
}
// dedupe results file 
function dedupe($str_file)
{
	$a = file($str_file);
	$a = array_unique($a);
	
	$h = fopen($str_file, 'w');
	fwrite($h, implode("",$a));
	fclose($h);
  
   return true;
}
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
?>