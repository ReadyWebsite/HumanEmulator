<?php
//скрипт чи45jyтатает структура каталога маркетплейс
//в каждом разделе находит решения и сохраняет в массив и xml
//запускается периодически для полного обновления структуры с целью правильной привязки элементов к разным 
//разделам каалга (множественное значение привязки к разделам)

//20180714
//изменена страктура итогового XML
//Добавлено name
//Ссылка на источник перенесена в свойство
//shablon_structure_catalog_3 

  //// use for unicode version only
$xhe_host = "127.0.0.1:7010";
// The following code is required to properly run XWeb Human Emulator
//require("../../Templates/xweb_human_emulator.php");

require("../../Templates/xweb_human_emulator.php");
//simple_html_dom
require("../../Include/simple_html_dom.php");

// функции 
require_once("tools/functions.php");

$f_name = "test.xml"; 


 
 $shablon_file = "out/shablon_structure.xml";
     
 
 // режим отладки
$dbg=true;

$marketplace_url = "http://marketplace.1c-bitrix.ru";


  //ssh
  $to_server = "ready.kz";
  $to_user = "bitrix";
  $to_password = "6ctED-vZX4K-U314k-Y5QZ4"; 
  $to_path = "/home/bitrix/www/upload/import/";

?>
<?php
    // ///////////////////// script /////////////////////////////////////////////////////////

debug_mess(date("\[ d.m.y H:i:s\] ")." скрипт запустили");





    
 
 

 


$connection = ssh2_connect($to_server, 22);
 ssh2_auth_password($connection, $to_user, $to_password);

 if ( ssh2_scp_send($connection, $shablon_file, $to_path.$f_name, 0644))
			debug_mess(date("\[ d.m.y H:i:s\] ")." file ". $f_name . " отправлен на портал ");




debug_mess(date("\[ d.m.y H:i:s\] ")." endd<br>");      

// Quit
$app->quit();