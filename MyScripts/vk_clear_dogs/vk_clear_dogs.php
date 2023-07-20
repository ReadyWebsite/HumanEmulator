<?php

$xhe_host = "127.0.0.1:7010";

// The following code is required to properly run XWeb Human Emulator
require("../../Templates/xweb_human_emulator.php");

// ////////////////////////////// настройки 
// логин
$vk_login = "";
// пароль
$vk_pwd ="";
// группа для чистки
$vk_group_id="";

$mic_pause=300000;

// //////////////////////////////// отладка кода
$debug_file = "/res/dbg_clear_dogs".date("_d.m.y").".txt";
$dbg = true;
// ///////////////////////////////////////////////

debug_mess("ЗАПУСКАЕМ СКРИПТ!!!");
// перешли
$browser->navigate("https://vk.com/");
sleep(3);

//  /////////////////////// логинимся
if($input->is_exist_by_name("email"))
{
$input->set_focus_by_attribute("id","index_email");
$input->send_keyboard_input_by_name("email",$vk_login);
usleep($mic_pause);
$input->set_focus_by_attribute("id","index_pass");
$input->send_keyboard_input_by_name("pass",$vk_pwd);
$btn->click_by_name("index_login_button");
}
// ////////////////////////////  переходим в нужную группу
usleep($mic_pause);
debug_mess("переходим в группу");
$browser->navigate("https://vk.com/".$vk_group_id);

//while()
$span->click_by_inner_html("&nbsp;");

$anchor->click_by_inner_html("Управление сообществом");

$anchor->click_by_name("ui_rmenu_members");

 // получить подгрузившиеся акки
 $arr_rows=$div->get_all_inner_htmls_by_attribute("class","group_l_row");

 $old_count=-1;
 $cur_count=count($arr_rows);
while($old_count!=$cur_count)
{
$div->click_by_name("page_body");  
$div->set_focus_by_name("page_body");
usleep($mic_pause);
$div->click_by_name("page_body");  
usleep($mic_pause);
$anchor->set_focus_by_inner_text("Показать ещё");
$anchor->click_by_inner_text("Показать ещё");
usleep($mic_pause);
$keyboard->send_key(35,true);
usleep($mic_pause);
echo "old:".$old_count=$cur_count;
echo "<br>";
$arr_rows=$div->get_all_inner_htmls_by_attribute("class","group_l_row");

foreach ($arr_rows as $row)
{
   if(strpos($row, "deactivated_100.png"))
   {
       $str_id=get_string($row, "GroupsEdit.uAction(this,",",");
       
if($anchor->get_inner_text_by_attribute("onclick",$str_id,false)!="Восстановить")
{  
       debug_mess("удаляем id:".$str_id);
       $anchor->click_by_attribute("onclick",$str_id,false);
}
   }
  
}
  $cur_count=count($arr_rows);
}

debug_mess("скрипт закончил работу.");

// ////////////////////////////////////// доп функции ///////////////////////
// получить строку по префиксам
function get_string($str1, $pr1, $pr2)
{
     // //echo $str1."<br>";
    $ind1 = strpos ($str1,$pr1);
    // echo "инедкс 1 ".$ind1."<br>";
    if($ind1===false)
      return "";
     
     $ind2 = strpos ($str1,$pr2,$ind1+strlen($pr1));
    //echo "инедкс 2 ".$ind2."<br>";
     if($ind2===false)
        return "";

     $sres = substr($str1,$ind1+strlen($pr1), $ind2-$ind1-strlen($pr1));
     //echo $sres; 

    return trim($sres); 
}
// выдать сообщение в панель отладки и в debug file
function debug_mess($mess)
{
   global $dbg, $textfile, $debug_file;
   // отладочные сообщения
   if ($dbg)
   {
      echo date("\[ d.m.y H:i:s\] ") . $mess . "<br>";
   }
	if (isset($debug_file))
	{
		// создаем сообщение для записи в файл отладки
		$str = date("\[ d.m.y H:i:s\] ") . $mess."\r\n";
		// записываем сообщение
      $textfile->add_string_to_file($debug_file, $str);
	}
}


// Quit
$app->quit();
?>