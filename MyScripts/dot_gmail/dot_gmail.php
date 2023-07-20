<?php

$xhe_host ="127.0.0.1:7010";

// The following code is required to properly run XWeb Human Emulator
require("../../Templates/xweb_human_emulator.php");

// массив с почтовыми ящиками
$emails=array();
$emails[]="testtestmail@gmail.com"; 

// скрипт работает в режим отладки
$dbg = true;

// //////////////////////// дополнительные модули ///////////////
// функции 
require_once("functions.php");

// /////////////////////// скрипт ///////////////////////////////////////////

debug_mess(date("\[ d.m.y H:i:s\] ")." скрипт запустили");

// расставить точки в gmail акке 
gen_dot($emails[0],$emails);

// общее количество мыл 
debug_mess("всего получилось ".count($emails)." почтовых ящиков");

// сделать регистрацию для всех аккаунтов
for($j=0;$j<count($emails);$j++)
{
   // показать полученные ящики
   debug_mess($emails[$j]);

   /* что то делаем с полученными email адресами*/
}


debug_mess(date("\[ d.m.y H:i:s\] ")." скрипт закончил работу<br>");

// Quit
$app->quit();
?>