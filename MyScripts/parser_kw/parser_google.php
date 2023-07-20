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

$xhe_host ="127.0.0.1:7010";

// The following code is required to properly run XWeb Human Emulator
require("../../Templates/xweb_human_emulator.php");

// //////////////////////// настройки скрипта /////////////////////////
// путь к  с файлу ключевых слов
$path_to_data = "data/keywords.txt";
// папка с результатами
$path_to_res = "res/";

// глубина прохода в поисковые результаты
$cnt_pages = 10;
// текущая страница
$crnt_page = 1; 
// массив ключевых слов
$arr_of_kwds = array();
// скрипт работает в режим отладки
$dbg = true;
$bUTF8Ver=true;
// //////////////////////// дополнительные модули ///////////////
// функции 
require_once("tools/functions.php");
require_once("tools/a.charset.php");

// /////////////////////// скрипт ///////////////////////////////////////////
debug_mess(date("\[ d.m.y H:i:s\] ")." скрипт запустили");

// получаем массив с ключевыми словами
$arr_of_kwds = file($path_to_data);

// пробежимся по всем ключевым словам
foreach($arr_of_kwds as $key=>$kwd)
{
	$kwd = trim($kwd);
	if ($kwd == "")
	{
		continue;
	}
   // перейти на гугль	
   $browser->navigate("google.com");
	sleep(2);
	
	// задаём слово в поиск
   $input->set_value_by_name("q", $kwd);
   $input->click_by_name("q");
   // нажмём пробел для отключения всплывшей подсказки
   $keyboard->send_key(32, false);
	// нажать enter
   $keyboard->send_key(13,false);
	sleep(3);
 
   // обнулим перед следующим проходом
	$crnt_page = 1;

	// работаем с ключевым словом на заданную длинну
	while (true)
   {
		// получим все ссылки на сайты заключённые в префиксах
		$sites = $webpage->get_body_inter_prefix_all('<div class="r">', '<h3');
		$sites = explode("<br>", $sites);
			
        //print_r($sites);
		// пройдёмся по всем полученным ссылкам
		for($i = 0; $i < count($sites); $i++)
		 {        
			// получить ссылку на сайт
			$pr1 = 'href="';
			$pr2 = '"';
			$site = get_string($sites[$i], $pr1, $pr2);
			if ($site == "")
				continue;

			// вывод в панель отладки
			debug_mess("ссылка на сайт : ".$site);
  
         // записать найденные ключи в файл			
         get_meta_kw($site,$kwd);

			sleep(2);
		}
		
		 // организация перехода на следующую страницу
		if(!next_page($crnt_page))
		{
			// убираем строки-дубликаты из файла
			$textfile->dedupe($path_to_res.$kwd.".txt", $path_to_res.$kwd.".txt", 60);	
			sleep(3);
			break;
		}
	}
	
}
debug_mess(date("\[ d.m.y H:i:s\] ")." скрипт закончил работу<br>");
// Quit
$app->quit();
?>