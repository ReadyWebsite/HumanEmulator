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

// следующая страница
function next_page(&$crnt_page)
{
      global $anchor, $browser, $app,$cnt_pages;
      // количество поисковых страниц
      $crnt_page=$crnt_page+1;

      if($cnt_pages!=-1)
      {
            // останавливаем скрипт
            if($crnt_page>$cnt_pages)
            { 
              debug_mess("обработали все заданные страницы ".($crnt_page-1));
              return false;
            }
      }
      // перейдём на следующую страницу с результатами
      if(!$anchor->click_by_inner_text($crnt_page,true))
      {
           debug_mess("обработали все страницы ".($crnt_page-1));
           return false;
      }

      debug_mess("обработали страницу ".($crnt_page-1));
      return true;
}

// выдать сообщение в панель отладки
function  debug_mess($mess)
{
   global $dbg,$textfile;
   // отладочные сообщения
   if($dbg)
   {
      echo date("\[ d.m.y H:i:s\] ").$mess."<br>";
   
	// записываем результат в файл
	$textfile->add_string_to_file("dbg.txt", date("\[ d.m.y H:i:s\] ").trim($mess)."\r\n", 60);
       
   }
}

// проверка есть ли такая строка в строке
function str_isexists($str1, $chek_str)
{
    if (strpos($str1, $chek_str) !== false) 
       return true;
    
    return false;
}
?>