<?php

$xhe_host ="127.0.0.1:7010";

// The following code is required to properly run XWeb Human Emulator
require("../../Templates/xweb_human_emulator.php");

// //////////////////////// настройки скрипта /////////////////////////
// файл с данными для скрипта
$keys = file("data/keys.txt");
// папка с результатами
$path_to_res = $debug->get_cur_script_folder().'res\\';

// глубина прохода в поисковые результаты
$cnt_pages = 10;
// текущая страница
$crnt_page =1; 

// скрипт работает в режим отладки
$dbg = true;

// //////////////////////// дополнительные модули ///////////////
// функции 
require_once("functions.php");

// /////////////////////// скрипт //////////////////////////////////////////

debug_mess ("скрипт запустили");

// кол-во
for($ii=0;$ii<count($keys);$ii++)
{
	// получить запрос
	$ks = trim($keys[$ii]);
     // текущая страница
     $crnt_page =1; 

   // перейти на yandex	
   $browser->navigate("yandex.ru");

	// зададим запрос
	//$input->set_value_by_name("text",$ks);
   $input->set_value_by_name("text",$ks);

	// найти
   $button->click_by_inner_text("Найти");
   $span->click_by_inner_text("Найти");


	// ждём
	sleep(1);
	
   while(true)
   {
		// получить по префиксам все ссылки в виде одной строки разделённой <br> 
		$sites = $webpage->get_body_inter_prefix_all("path__item","</a>",true);
		// разделить на массив, используя для разделения <br>
		$sites = explode("<br>",$sites);
		debug_mess("count: ".count($sites));
		// пройдёмся по всем полученным 
		for($rw=0;$rw<count($sites);$rw++)
		{
			if(trim($sites[$rw])=="")
				continue; 
		       // вывести ссылку в панель отладки 
		       $site_link = get_string($sites[$rw],"href=\"","\" ");
                       debug_mess("ссылка на сайт ".trim($site_link));
                       
//                       debug_mess("путь к файлу : ".$path_to_res.$ks.".txt");

                       // записываем результат в файл
	               $textfile->add_string_to_file($path_to_res.$ks.".txt", trim($site_link)."\r\n", 60);
                     
		}

		// не перешли на следующую страницу 
		if(!next_page($crnt_page)) 
		  break;
   }
}


debug_mess ("скрипт закончил свою работу");

// Quit
$app->quit();
?>