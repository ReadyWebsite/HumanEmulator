<?php
/*  производитель: x-scripts                                     
**  тип продукта: скрипт под Xweb Human Emulator  
**  сайт программы: https://xn--80awbbeioodeq4h3a.xn--p1ai                  
**  наш сайт: x-scripts.com                                     
**  по всем вопросам обращайтесь:                       
**  email: order@x-scripts.com                                
**  icq: 625657402                               
**  skype: igor_sev2                             
*/
// получить ключи с сайта
function get_meta_kw($url_site,$kwd)
{
	global  $webpage, $textfile,$path_to_res,$file_os;
	// получаем контент по данному url
	$content = $webpage->load_web_page($url_site);
	// получаем ключевые слова
	$result_kws = get_string($content, '<meta name="keywords"', '>');
	// подчищаем их
	$result_kws = trim(str_replace("content", "", $result_kws));
	$result_kws = trim(str_replace("=", "", $result_kws));
	$result_kws = trim(str_replace('"', "", $result_kws));
	$result_kws = trim(str_replace("/", ",", $result_kws));
	$result_kws = trim(str_replace(".", ",", $result_kws));
	$result_kws = trim(str_replace("|", ",", $result_kws));
	$result_kws = trim(str_replace(", ", "\r\n", $result_kws));
	$result_kws = trim(str_replace(" , ", "\r\n", $result_kws));
	$result_kws = trim(str_replace(",", "\r\n", $result_kws));
	$result_kws = trim(str_replace(" ,", "\r\n", $result_kws));
	

       debug_mess("ключи : ".$result_kws);
	// получаем кодировку сайта
	$meta_info = get_string($content, '<head', '</head>');
	
	// если кодировка windows-1251 - пытаемся её преобразовать в utf-8 
	if (strpos($meta_info, "windows-1251") != false)
	{
		// если сайт в кодировке UTF-8 - пытаемся преобразовать
		$result_kws = iconv('windows-1251', 'UTF-8', $result_kws);


		$result_kws = charset_x_win($result_kws);
	} 
	
	if ($result_kws == "" or $result_kws == "\r\n")
	{
		return false;
	}

   if(!$file_os->is_exist($path_to_res.$kwd.".txt"))
   {
     debug_mess("файла нет : ".$path_to_res.$kwd.".txt");
     $textfile->write_file($path_to_res.$kwd.".txt", trim($result_kws)."\r\n");
   }
   else
   { 
   debug_mess("файл есть : ".$path_to_res.$kwd.".txt");
	// записываем результат в файл
	$textfile->add_string_to_file($path_to_res.$kwd.".txt", trim($result_kws)."\r\n", 60);
   }

   return true;
}
// получить строку по префиксам
function get_string($str1, $pr1, $pr2, &$ind_st = 0)
{
	//получаем стартовый индекс
	$ind1 = strpos($str1, $pr1, $ind_st);
	if($ind1 === false)
	{
		return "";
	}
	$ind1_1 = $ind1 + strlen($pr1);
	//получаем финишный индекс
	$ind2 = strpos($str1, $pr2, $ind1_1);
	if ($ind2 === false)
	{
		return "";
	}
	// получим результат
	$sres = substr($str1, $ind1 + strlen($pr1), $ind2 - $ind1_1);
	return trim($sres); 
}

// следующая страница
function next_page(&$crnt_page)
{
      global $anchor, $browser, $app,$cnt_pages;
      // количество поисковых страниц
      $crnt_page = $crnt_page + 1;
		// если $cnt_pages == -1, значит скрипт будет искать все страницы до конца поиска
      if ($cnt_pages != -1)
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
           debug_mess("обработали все доступные страницы ".($crnt_page-1));
           return false;
      }

      debug_mess("обработали страницу ".($crnt_page-1));
      return true;
}

// выдать сообщение в панель отладки
function  debug_mess($mess)
{
   global $dbg,$textfile,$file_os;
   // отладочные сообщения
   if($dbg)
   {
      echo $mess."<br>";

   if(!$file_os->is_exist("dbg.txt"))
   {
     $textfile->write_file("dbg.txt", trim($mess)."\r\n");
   }
   else
   { 
   
	// записываем результат в файл
	$textfile->add_string_to_file("dbg.txt", trim($mess)."\r\n", 60);
   }
       
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