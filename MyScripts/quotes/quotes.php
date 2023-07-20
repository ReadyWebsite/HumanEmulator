<?php
/* ** 
//  Наш сайт http://x-scripts.com
//  Скрипт сбора данных из таблиц.
//  по любым вопросам касающимся скрипта 
//  можно написать нам на мыло order@x-scripts.com
** */
$xhe_host = "127.0.0.1:7010";

// The following code is required to properly run XWeb Human Emulator
require("../../Templates/xweb_human_emulator.php");

// ////////// настройки скрипта///////////////////
$quotes=file("data/quotes.txt");
// режим отладки
$dbg=true;
// путь к файлу с результатами
$res_file_name = "res/".date("mdy_His").".csv";
// /////////////////// дополнительные модули /////////////////////
// функции 
require_once("functions.php");

// ///////////////////// script /////////////////////////////////////////////////////////
debug_mess(date("\[ d.m.y H:i:s\] ")." скрипт запустили");

// по всем котировкам
for($i=0;$i<count($quotes);$i++)
{
	// перейти на заданную страницу
	$browser->navigate("http://finance.yahoo.com/q?s=".trim($quotes[$i])."&ql=1");
	
	// получить данные в формате
	//symbol;Prev Close;Open;High;Low;Close;Volume;CHANGE	
	$str=trim($quotes[$i]).";";
	// закрытие
	$str_close=$span->get_inner_text_by_attribute("data-reactid",'price.0', false);
   // изменение
	$str_change=$span->get_inner_text_by_attribute("data-reactid",'price.1', false);
   // prev close
	$str_prev=$td->get_inner_text_by_attribute("data-test","PREV_CLOSE", false);
   // открытие
	$str_open=$td->get_inner_text_by_attribute("data-test","OPEN", false);
	// получаем дневной низ и верх
	$str_day_range=$td->get_inner_text_by_attribute("data-test","DAYS_RANGE", false);
   $str_day_range=explode("-", $str_day_range);
	$str_low=trim($str_day_range[0]);
	$str_high=trim($str_day_range[1]);
   // volume
	$str_volume=$td->get_inner_text_by_attribute("data-test","TD_VOLUME", false);
	// результирующая строка
	$str.=$str_prev.";". $str_open.";".$str_high.";".$str_low.";".$str_close.";".$str_volume.";".$str_change."\n";

	// записываем в файл
	$textfile->add_string_to_file($res_file_name,$str,60) ;

    echo $str;
}

debug_mess(date("\[ d.m.y H:i:s\] ")." скрипт закончил работу<br>");

// Quit
$app->quit();
?>