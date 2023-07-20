<?php

/* ** 
//  Наш сайт http://x-scripts.com
//  Скрипт проверки доменов check_domens.
//  по любым вопросам касающимся скрипта 
//  можно написать нам на мыло order@x-scripts.com
** */

$xhe_host ="127.0.0.1:7010";

// The following code is required to properly run XWeb Human Emulator
require("../../Templates/xweb_human_emulator.php");

// //////////////////////// настройки скрипта /////////////////////////
// файл с доменами для проверки 
$a_dmns = file("data/dmns.txt");
// файл с результатами
$str_res_file="res/res.txt";

// скрипт работает в режим отладки
$dbg = true;

// //////////////////////// дополнительные модули ///////////////
// функции 
require_once("tools/functions.php");

// /////////////////////// скрипт ///////////////////////////////////////////
debug_mess(date("\[ d.m.y H:i:s\] ")." скрипт запустили");
// удаляем файл с предыдущими результатами
$file_os->delete($str_res_file);
// строка с доменами которую будем вводить на сайт
$str_dmns="";
// пройтись по всем доменам
for($i=0;$i<count($a_dmns);$i++)
{
     // если $i кратно 30 или равно последнему элементу массива
     // то вводим строку с доменами
     if(($i!=0&&$i%30==0) || $i==(count($a_dmns)-1))
     {
        // переходим на проверку доменов
        $browser->navigate("http://www.cy-pr.com/tools/masswhois/");
       
        // если зашли в последний раз то добавим последний домен
        if($i==(count($a_dmns)-1))
          $str_dmns.=$a_dmns[$i];

        // задать домены в поле
        $textarea->set_value_by_name("doms",trim($str_dmns));
        $button->click_by_inner_text("Проверить");
        // ожидаем пока появится результат
        sleep(1);
        // разбираем результат и свободные пишем в заданный файл
        parse_results();
        // чистим строку с доменами
        $str_dmns="";     
     }
     // добавить домен в строку
     $str_dmns.=$a_dmns[$i];
     //echo $a_dmns[$i];
}
debug_mess(date("\[ d.m.y H:i:s\] ")." скрипт закончил работу");

// Quit
$app->quit();
?>