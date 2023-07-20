<?php

$xhe_host ="127.0.0.1:7010";

// The following code is required to properly run XWeb Human Emulator
require("../../Templates/xweb_human_emulator.php");

// //////////////////////// настройки скрипта /////////////////////////
// логин и пароль для входа в ВК(необходимо заполнить)
$login = "";   // необходимо ввести логин для ВК
$pass = "";   // необходимо ввести пароль для ВК
// время ожидания
$wt = 5;
$wt_long = 8;

// /////////////////////// скрипт ///////////////////////////////////////////
echo "Скрипт запустили<br>";

echo "Переходим на сайт ВК<br>";
$browser->navigate("http://m.vk.com/");
sleep($wt_long);

echo "Авторизируемся<br>";
$input->set_focus_by_name("email");
$input->set_value_by_name("email", "$login");
sleep($wt);
$input->set_focus_by_name("pass");
$input->set_value_by_name("pass", $pass);
sleep($wt);
echo "нажимаем кнопку Войти<br>";
$button->click_by_number(0);
sleep($wt_long);

echo "Скрипт закончил работу";
// Quit
$app->quit();
?>