<?php


  //// use for unicode version only
$xhe_host ="127.0.0.1:7010";
// The following code is required to properly run XWeb Human Emulator
//require("../../Templates/xweb_human_emulator.php");

require("../../Templates/xweb_human_emulator.php");
//simple_html_dom
require("../../Include/simple_html_dom.php");

require("../../Include/phpQuery-onefile.php");



// функции 
require_once("tools/functions.php");

$f_name_items = "out_kaspi_items.xml";
 


 
 
//файл для выгрузки итогового файла
$date_now = date("Y-m-d-H-i-s");
//$result_file = "out/".$date_now."out.xml";








 //файл c заготовкой xml
 
 $shablon_file = "out/shablon_structure.xml";
   
 
 // режим отладки
$dbg=true;



//$marketplace_url = "https://kaspi.kz/shop/";

//все товары альбион
//$marketplace_url = "https://kaspi.kz/shop/c/fashion%20accessories/?q=%3Acategory%3AFashion+accessories%3AallMerchants%3AAlbion";

$arShops[]= "ALBION-TIME-KZ";
$arShops[]= "1A";



//$arMarketplace_url["ALBION-TIME-KZ"] =	  "https://kaspi.kz/shop/c/fashion%20accessories/?q=%3Acategory%3AFashion+accessories%3AallMerchants%3AAlbion";
//$arMarketplace_url["ALBION-TIME-KZ"] =	"https://kaspi.kz/shop/c/fashion%20accessories/brand-aka-deri/?q=%3Acategory%3AFashion+accessories%3AmanufacturerName%3AAQUAMARINE%3AmanufacturerName%3AARMITRON%3AmanufacturerName%3AAdriatica%3AmanufacturerName%3ABoccia+Titanium%3AmanufacturerName%3ADaniel+Klein%3AmanufacturerName%3ADiamant%3AmanufacturerName%3AEssence%3AmanufacturerName%3AFreelook%3AmanufacturerName%3AGO+Girl+Only%3AmanufacturerName%3AINOX+Plus%3AmanufacturerName%3APierre+Ricaud%3AmanufacturerName%3AQ%26Q%3AmanufacturerName%3ARoyal+London%3AmanufacturerName%3ASOKOLOV%3AmanufacturerName%3ASergio+Tacchini%3AmanufacturerName%3ASlazenger%3AmanufacturerName%3AStailer%3AmanufacturerName%3ATeosa%3AmanufacturerName%3AWAINER%3AmanufacturerName%3A%D0%91%D1%80%D0%BE%D0%BD%D0%BD%D0%B8%D1%86%D0%BA%D0%B8%D0%B9+%D0%AE%D0%B2%D0%B5%D0%BB%D0%B8%D1%80%3AmanufacturerName%3A%D0%9A%D0%A0%D0%90%D0%A1%D0%A6%D0%92%D0%95%D0%A2%D0%9C%D0%95%D0%A2%3AmanufacturerName%3A%D0%9A%D1%80%D0%B0%D1%81%D0%BD%D0%B0%D1%8F+%D0%BF%D1%80%D0%B5%D1%81%D0%BD%D1%8F%3AmanufacturerName%3A%D0%9D%D0%98%D0%9A%D0%90%3AmanufacturerName%3A%D0%AE%D0%B2%D0%B5%D0%BB%D0%B8%D1%80%D0%BD%D1%8B%D0%B5+%D1%82%D1%80%D0%B0%D0%B4%D0%B8%D1%86%D0%B8%D0%B8%3AallMerchants%3AAlbion";
//$arMarketplace_url["ALBION-TIME-KZ"] = "https://kaspi.kz/shop/c/fashion%20accessories/brand-aka-deri/?q=%3Acategory%3AFashion+accessories%3AmanufacturerName%3A%D0%9D%D0%98%D0%9A%D0%90%3AmanufacturerName%3A%D0%9D%D0%98%D0%9A%D0%90+%D0%A1%3AallMerchants%3AAlbion";
//$arMarketplace_url["ALBION-TIME-KZ"] = "https://kaspi.kz/shop/c/fashion%20accessories/brand-aka-deri/?q=%3Acategory%3AFashion+accessories%3AmanufacturerName%3AAQUAMARINE%3AmanufacturerName%3AAdriatica%3AmanufacturerName%3ABoccia+Titanium%3AmanufacturerName%3ADiamant%3AmanufacturerName%3ANika%3AmanufacturerName%3APierre+Ricaud%3AmanufacturerName%3AQ%26Q%3AmanufacturerName%3ARoyal+London%3AmanufacturerName%3ASEREBROFF%3AmanufacturerName%3ASOKOLOV%3AmanufacturerName%3A%D0%9C%D0%B0%D0%B3%D0%B8%D1%8F+%D0%B7%D0%BE%D0%BB%D0%BE%D1%82%D0%B0%3AmanufacturerName%3A%D0%9D%D0%98%D0%9A%D0%90%3AmanufacturerName%3A%D0%9D%D0%98%D0%9A%D0%90+%D0%A1%3AmanufacturerName%3A%D0%AE%D0%B2%D0%B5%D0%BB%D0%B8%D1%80%D0%BD%D1%8B%D0%B5+%D1%82%D1%80%D0%B0%D0%B4%D0%B8%D1%86%D0%B8%D0%B8%3AallMerchants%3AAlbion";
//$arMarketplace_url["ALBION-TIME-KZ"] = "https://kaspi.kz/shop/search/?text=&q=%3Acategory%3ACategories%3AmanufacturerName%3AAdriatica%3AmanufacturerName%3AAKA%20DERI%3AmanufacturerName%3ABoccia%20Titanium%3AmanufacturerName%3AFASHION%3AmanufacturerName%3AHumidifier%3AmanufacturerName%3AJT%3AmanufacturerName%3ALED%3AmanufacturerName%3ALongstar%3AmanufacturerName%3ANo%20Name%3AmanufacturerName%3AOEM%3AmanufacturerName%3APierre%20Ricaud%3AmanufacturerName%3ARoyal%20London%3AmanufacturerName%3ASuitu%3AmanufacturerName%3AWEIXIER%3AmanufacturerName%3A%D0%91%D0%B5%D0%B7%20%D0%B1%D1%80%D0%B5%D0%BD%D0%B4%D0%B0%3AmanufacturerName%3A%D0%9A%D0%B8%D1%82%D0%B0%D0%B9%3AallMerchants%3AAlbion&sort=relevance&filteredByCategory=false";
$arMarketplace_url["ALBION-TIME-KZ"] = "https://kaspi.kz/shop/search/?text=albion-time-kz&q=%3Acategory%3ACategories%3AmanufacturerName%3AAdriatica%3AmanufacturerName%3AAKA%20DERI%3AmanufacturerName%3AARMITRON%3AmanufacturerName%3ABANGE%3AmanufacturerName%3ABoccia%20Titanium%3AmanufacturerName%3ABullcaptain%3AmanufacturerName%3ACARDCASE%3AmanufacturerName%3ACASIO%3AmanufacturerName%3ADaniel%20Klein%3AmanufacturerName%3AEssence%3AmanufacturerName%3AESSENCE%3AmanufacturerName%3AFashion%3AmanufacturerName%3AGO%20Girl%20Only%3AmanufacturerName%3AGROVANA%3AmanufacturerName%3AHumidifier%3AmanufacturerName%3AINOX%20Plus%3AmanufacturerName%3AJT%3AmanufacturerName%3AKonka%3AmanufacturerName%3ALED%3AmanufacturerName%3ALongstar%3AmanufacturerName%3ANo%20Name%3AmanufacturerName%3AOEM%3AmanufacturerName%3APierre%20Ricaud%3AmanufacturerName%3AQ%26Q%3AmanufacturerName%3ARoyal%20London%3AmanufacturerName%3ASlazenger%3AmanufacturerName%3AStailer%3AmanufacturerName%3ASuitu%3AmanufacturerName%3AWAINER%3AmanufacturerName%3AWellamart%3AmanufacturerName%3AWIWU%3AmanufacturerName%3A%D0%91%D0%B5%D0%B7%20%D0%B1%D1%80%D0%B5%D0%BD%D0%B4%D0%B0%3AmanufacturerName%3A%D0%9A%D0%B8%D1%82%D0%B0%D0%B9%3AallMerchants%3AAlbion&sort=relevance&filteredByCategory=false";


//$arMarketplace_url["1A"] =   			 "https://kaspi.kz/shop/nur-sultan/c/fashion%20accessories/brand-aka-deri/?q=%3Acategory%3AFashion+accessories%3AmanufacturerName%3AAQUAMARINE%3AmanufacturerName%3AAdriatica%3AmanufacturerName%3ABoccia+Titanium%3AmanufacturerName%3ACASIO%3AmanufacturerName%3ADaniel+Klein%3AmanufacturerName%3ADiamant%3AmanufacturerName%3AEssence%3AmanufacturerName%3AOrient%3AmanufacturerName%3APierre+Ricaud%3AmanufacturerName%3AQ%26Q%3AmanufacturerName%3ARoyal+London%3AmanufacturerName%3ASOKOLOV%3AmanufacturerName%3ASlazenger%3AmanufacturerName%3ATeosa%3AmanufacturerName%3ATesori%3AmanufacturerName%3AWAINER%3AmanufacturerName%3A%D0%9D%D0%B8%D0%BA%D0%B0%3AmanufacturerName%3A%D0%AE%D0%B2%D0%B5%D0%BB%D0%B8%D1%80%D0%BD%D1%8B%D0%B5+%D1%82%D1%80%D0%B0%D0%B4%D0%B8%D1%86%D0%B8%D0%B8%3AallMerchants%3A2425010&at=1"; 
//$arMarketplace_url["1A"] =                 "https://kaspi.kz/shop/c/fashion%20accessories/brand-aquamarine/?q=%3Acategory%3AFashion+accessories%3AmanufacturerName%3AAdriatica%3AmanufacturerName%3ABoccia+Titanium%3AmanufacturerName%3ADaniel+Klein%3AmanufacturerName%3ADiamant%3AmanufacturerName%3AEssence%3AmanufacturerName%3AJACQUES+LEMANS%3AmanufacturerName%3APierre+Ricaud%3AmanufacturerName%3AQ%26Q%3AmanufacturerName%3ARoyal+London%3AmanufacturerName%3ASOKOLOV%3AmanufacturerName%3ASlazenger%3AmanufacturerName%3AWAINER%3AmanufacturerName%3A%D0%94%D0%B8%D0%BD%D0%B0%D1%81%D1%82%D0%B8%D1%8F%3AmanufacturerName%3A%D0%9A%D0%A0%D0%90%D0%A1%D0%A6%D0%92%D0%95%D0%A2%D0%9C%D0%95%D0%A2%3AmanufacturerName%3A%D0%9C%D0%B0%D0%B3%D0%B8%D1%8F+%D0%B7%D0%BE%D0%BB%D0%BE%D1%82%D0%B0%3AmanufacturerName%3A%D0%AE%D0%B2%D0%B5%D0%BB%D0%B8%D1%80%D0%BD%D1%8B%D0%B5+%D1%82%D1%80%D0%B0%D0%B4%D0%B8%D1%86%D0%B8%D0%B8%3AallMerchants%3A2425010";
//$arMarketplace_url["1A"] =					"https://kaspi.kz/shop/c/fashion%20accessories/brand-aka-deri/?q=%3Acategory%3AFashion+accessories%3AmanufacturerName%3AAQUAMARINE%3AmanufacturerName%3AARMITRON%3AmanufacturerName%3AAdriatica%3AmanufacturerName%3ABoccia+Titanium%3AmanufacturerName%3ACASIO%3AmanufacturerName%3ADaniel+Klein%3AmanufacturerName%3ADiamant%3AmanufacturerName%3AEssence%3AmanufacturerName%3AFreelook%3AmanufacturerName%3AGO+Girl+Only%3AmanufacturerName%3AGROVANA%3AmanufacturerName%3AJACQUES+LEMANS%3AmanufacturerName%3ALucente+Silver%3AmanufacturerName%3ANika%3AmanufacturerName%3AOrient%3AmanufacturerName%3APierre+Ricaud%3AmanufacturerName%3AQ%26Q%3AmanufacturerName%3ARoyal+London%3AmanufacturerName%3ASEREBROFF%3AmanufacturerName%3ASOKOLOV%3AmanufacturerName%3ASergio+Tacchini%3AmanufacturerName%3ASlazenger%3AmanufacturerName%3ASwiss+Alpine+Military+by+Grovana%3AmanufacturerName%3ATeosa%3AmanufacturerName%3AWAINER%3AmanufacturerName%3A%D0%91%D1%80%D0%BE%D0%BD%D0%BD%D0%B8%D1%86%D0%BA%D0%B8%D0%B9+%D0%AE%D0%B2%D0%B5%D0%BB%D0%B8%D1%80%3AmanufacturerName%3A%D0%94%D0%B8%D0%BD%D0%B0%D1%81%D1%82%D0%B8%D1%8F%3AmanufacturerName%3A%D0%9A%D0%A0%D0%90%D0%A1%D0%A6%D0%92%D0%95%D0%A2%D0%9C%D0%95%D0%A2%3AmanufacturerName%3A%D0%9A%D1%80%D0%B0%D1%81%D0%BD%D0%B0%D1%8F+%D0%BF%D1%80%D0%B5%D1%81%D0%BD%D1%8F%3AmanufacturerName%3A%D0%9C%D0%B0%D0%B3%D0%B8%D1%8F+%D0%B7%D0%BE%D0%BB%D0%BE%D1%82%D0%B0%3AmanufacturerName%3A%D0%9D%D0%98%D0%9A%D0%90%3AmanufacturerName%3A%D0%9D%D0%98%D0%9A%D0%90+%D0%A1%3AmanufacturerName%3A%D0%AE%D0%B2%D0%B5%D0%BB%D0%B8%D1%80%D0%BD%D1%8B%D0%B5+%D1%82%D1%80%D0%B0%D0%B4%D0%B8%D1%86%D0%B8%D0%B8%3AallMerchants%3A2425010";
// $arMarketplace_url["1A"]   = "https://kaspi.kz/shop/c/fashion%20accessories/brand-aka-deri/?q=%3Acategory%3AFashion+accessories%3AmanufacturerName%3AAQUAMARINE%3AmanufacturerName%3AAdriatica%3AmanufacturerName%3ABoccia+Titanium%3AmanufacturerName%3ADaniel+Klein%3AmanufacturerName%3ADiamant%3AmanufacturerName%3AFreelook%3AmanufacturerName%3ALucente%3AmanufacturerName%3AOrient%3AmanufacturerName%3APierre+Ricaud%3AmanufacturerName%3AQ%26Q%3AmanufacturerName%3ARoyal+London%3AmanufacturerName%3ASOKOLOV%3AmanufacturerName%3ASergio+Tacchini%3AmanufacturerName%3ATeosa%3AmanufacturerName%3AZLATA%3AmanufacturerName%3A%D0%91%D1%80%D0%BE%D0%BD%D0%BD%D0%B8%D1%86%D0%BA%D0%B8%D0%B9+%D0%AE%D0%B2%D0%B5%D0%BB%D0%B8%D1%80%3AmanufacturerName%3A%D0%9A%D0%A0%D0%90%D0%A1%D0%A6%D0%92%D0%95%D0%A2%D0%9C%D0%95%D0%A2%3AmanufacturerName%3A%D0%9A%D1%80%D0%B0%D1%81%D0%BD%D0%B0%D1%8F+%D0%BF%D1%80%D0%B5%D1%81%D0%BD%D1%8F%3AmanufacturerName%3A%D0%9D%D0%98%D0%9A%D0%90%3AmanufacturerName%3A%D0%AE%D0%B2%D0%B5%D0%BB%D0%B8%D1%80%D0%BD%D1%8B%D0%B5+%D1%82%D1%80%D0%B0%D0%B4%D0%B8%D1%86%D0%B8%D0%B8%3AallMerchants%3A2425010";
//$arMarketplace_url["1A"]  = "https://kaspi.kz/shop/c/fashion%20accessories/brand-aka-deri/?q=%3Acategory%3AFashion+accessories%3AmanufacturerName%3AAQUAMARINE%3AmanufacturerName%3AAdriatica%3AmanufacturerName%3ABoccia+Titanium%3AmanufacturerName%3ACASIO%3AmanufacturerName%3ADiamant%3AmanufacturerName%3ALongstar%3AmanufacturerName%3ALucente+Silver%3AmanufacturerName%3ANika%3AmanufacturerName%3APierre+Ricaud%3AmanufacturerName%3AQ%26Q%3AmanufacturerName%3ARoyal+London%3AmanufacturerName%3ASOKOLOV%3AmanufacturerName%3ASergio+Tacchini%3AmanufacturerName%3A%D0%9D%D0%98%D0%9A%D0%90%3AmanufacturerName%3A%D0%9D%D0%98%D0%9A%D0%90+%D0%A1%3AmanufacturerName%3A%D0%AE%D0%B2%D0%B5%D0%BB%D0%B8%D1%80%D0%BD%D1%8B%D0%B5+%D1%82%D1%80%D0%B0%D0%B4%D0%B8%D1%86%D0%B8%D0%B8%3AallMerchants%3A2425010";
//$arMarketplace_url["1A"]   = "https://kaspi.kz/shop/nur-sultan/c/categories/?q=%3AmanufacturerName%3AAKA+DERI%3AmanufacturerName%3AAQUAMARINE%3AmanufacturerName%3AAdriatica%3AmanufacturerName%3ABoccia+Titanium%3AmanufacturerName%3ACASIO%3AmanufacturerName%3ADiamant%3AmanufacturerName%3ALongstar%3AmanufacturerName%3ALucente+Silver%3AmanufacturerName%3ANika%3AmanufacturerName%3APierre+Ricaud%3AmanufacturerName%3AQ%26Q%3AmanufacturerName%3ARoyal+London%3AmanufacturerName%3ASOKOLOV%3AmanufacturerName%3ASergio+Tacchini%3AmanufacturerName%3A%D0%9D%D0%98%D0%9A%D0%90%3AmanufacturerName%3A%D0%9D%D0%98%D0%9A%D0%90+%D0%A1%3AmanufacturerName%3A%D0%AE%D0%B2%D0%B5%D0%BB%D0%B8%D1%80%D0%BD%D1%8B%D0%B5+%D1%82%D1%80%D0%B0%D0%B4%D0%B8%D1%86%D0%B8%D0%B8%3AallMerchants%3A2425010";
//$arMarketplace_url["1A"]  = "https://kaspi.kz/shop/search/?text=&q=%3Acategory%3ACategories%3AmanufacturerName%3AAQUAMARINE%3AmanufacturerName%3ADiamant%3AmanufacturerName%3ANika%3AmanufacturerName%3ASOKOLOV%3AmanufacturerName%3A%D0%9A%D1%80%D0%B0%D1%81%D0%BD%D0%B0%D1%8F%20%D0%BF%D1%80%D0%B5%D1%81%D0%BD%D1%8F%3AmanufacturerName%3A%D0%9C%D0%B0%D0%B3%D0%B8%D1%8F%20%D0%B7%D0%BE%D0%BB%D0%BE%D1%82%D0%B0%3AmanufacturerName%3A%D0%9D%D0%98%D0%9A%D0%90%3AmanufacturerName%3A%D0%9D%D0%98%D0%9A%D0%90%20%D0%A1%3AmanufacturerName%3A%D0%AE%D0%B2%D0%B5%D0%BB%D0%B8%D1%80%D0%BD%D1%8B%D0%B5%20%D1%82%D1%80%D0%B0%D0%B4%D0%B8%D1%86%D0%B8%D0%B8%3AallMerchants%3A2425010&sort=relevance&filteredByCategory=false";
$arMarketplace_url["1A"]  = "https://kaspi.kz/shop/search/?text=&q=%3Acategory%3ACategories%3AmanufacturerName%3AAQUAMARINE%3AmanufacturerName%3ADiamant%3AmanufacturerName%3AKARATOV%3AmanufacturerName%3ANika%3AmanufacturerName%3ANOW%3AmanufacturerName%3ASOKOLOV%3AmanufacturerName%3A%D0%9A%D1%80%D0%B0%D1%81%D0%BD%D0%B0%D1%8F%20%D0%BF%D1%80%D0%B5%D1%81%D0%BD%D1%8F%3AmanufacturerName%3A%D0%9D%D0%98%D0%9A%D0%90%3AmanufacturerName%3A%D0%9D%D0%98%D0%9A%D0%90%20%D0%A1%3AmanufacturerName%3A%D0%AE%D0%B2%D0%B5%D0%BB%D0%B8%D1%80%D0%BD%D1%8B%D0%B5%20%D1%82%D1%80%D0%B0%D0%B4%D0%B8%D1%86%D0%B8%D0%B8%3AallMerchants%3A2425010&sort=relevance&filteredByCategory=false";

$on_page = 12;
$start_page = 1; 

$step_for_save= 10; //каждые N  шагов сохранять данные



//ssh
  $to_server = "185.233.3.20";
  $to_user = "root";
  $to_password = "PbTCJxsP";
  

  
  
 // $to_user = "albiont_import";
 // $to_password = "cU6Xgy7M";
  
 // $to_path = "/next_albion-time/public_html/upload/import/parsing_price_kaspi/";
   $to_path = "/home/bitrix/www/upload/import/parsing_price_kaspi/";
  
  

?>
<?php
    // ///////////////////// script /////////////////////////////////////////////////////////

debug_mess(date("\[ d.m.y H:i:s\] ")." скрипт запустили");



foreach ($arShops as $ind=>$shop_prefix)
{
	$shop_prefix = trim($shop_prefix);
	debug_mess(date("\[ d.m.y H:i:s\] ")." <br>*******************************************************************************");
	debug_mess(date("\[ d.m.y H:i:s\] ")." Магазин ". $shop_prefix);
	
	
	
	
	
		//итоговый файл 
		$result_file_items = "out/".$shop_prefix."_".$f_name_items;
		
		//файл для временной выгрузки 
		$temp_out_file_elements = "out/temp_".$shop_prefix."_".$f_name_items;
		
		//url
		$marketplace_url = $arMarketplace_url[$shop_prefix];

	//удалить результирующие файлы если есть

					$file_os->delete($result_file_items);

					//$file_os->delete($temp_out_file_elements);     // не удаляем, так как будем добавлять туда записи после перезапуска



					$browser->navigate($marketplace_url);
					debug_mess(date("\[ d.m.y H:i:s\] ")." перешли на ". $marketplace_url);
					$browser->wait_for(640,3);
					$browser->wait_js();
					
					$count= $span->get_inner_html_by_attribute("class", "filters__count", false);
					echo "count ". $count;
					
					debug_mess(date("\[ d.m.y H:i:s\] ")." count ". $count);
					$count= preg_replace("/[^0-9]/", '', $count);
					debug_mess(date("\[ d.m.y H:i:s\] ")." count ". $count);
					$count_page = ceil($count/$on_page);
					
					$allpage = ceil ($count_page/$step_for_save) * $step_for_save;

					
					
					
					debug_mess(date("\[ d.m.y H:i:s\] ")." count ". $count);
					debug_mess(date("\[ d.m.y H:i:s\] ")." step_for_save ". $step_for_save);
					debug_mess(date("\[ d.m.y H:i:s\] ")." count_page ". $count_page);
					debug_mess(date("\[ d.m.y H:i:s\] ")." allpage ". $allpage);

					$ELEMENTS_OUT = Array();
					$PREISES_OUT = Array();


					 
					 //
					debug_mess("</br></br>".date("\[ d.m.y H:i:s\] ").  "НАЧИНАЕМ СОБИРАТЬ ЕЛЕМЕНТЫ ");
					$elements_in_section= Array();
					$all_elements = Array();
					
					$time_start = time();

								
							 
								debug_mess(date("\[ d.m.y H:i:s\] ").($debug->get_cur_mem_size()/1024/1024)." Mb до потимизации"); 
								$debug->optimize_memory(); 
								debug_mess(date("\[ d.m.y H:i:s\] ").($debug->get_cur_mem_size()/1024/1024)." Mb"); 
								sleep(1);
							   // $section[$section_id] = read_section($section_url, $marketplace_url);
							   
							  for ($step = $start_page; $step<=$allpage; $step++ ) {
								  
										$elements_in_section = read_section_2($step, $marketplace_url, $shop_prefix);
										
										$all_elements = array_merge_recursive($all_elements, $elements_in_section);
										 //  if (count($all_elements)>5) 
										 //   break; 
										 
										 
										 
										
										  if (($step % $step_for_save) == 0)
											{
											  debug_mess("</br></br>".date("\[ d.m.y H:i:s\] ").  " сохраняем порцию ". count($all_elements) ." товаров во временный файл</br></br>");
												
												$ELEMENTS_OUT = Array();
												foreach ($all_elements as $ind => $val)
													{
								// echo "<pre>val "; print_r($val); echo "</pre>****************************************</br></br></br>";    
									
									$ELEMENTS_OUT['offer'][$ind]["_c"]["my_id"]["_v"] = $val["my_id"];
									$ELEMENTS_OUT['offer'][$ind]["_c"]["my_name"]["_v"] = $val["my_name"];
									$ELEMENTS_OUT['offer'][$ind]["_c"]["my_discount"]["_v"] = $val["my_discount"];
									$ELEMENTS_OUT['offer'][$ind]["_c"]["my_unitprice"]["_v"] = $val["my_unitprice"];
									$ELEMENTS_OUT['offer'][$ind]["_c"]["my_unitsaleprice"]["_v"] = $val["my_unitsaleprice"];
									$ELEMENTS_OUT['offer'][$ind]["_c"]["my_brand"]["_v"] = $val["my_brand"];
									$ELEMENTS_OUT['offer'][$ind]["_c"]["my_count"]["_v"] = $val["my_count"];
									$ELEMENTS_OUT['offer'][$ind]["_c"]["my_full_url"]["_v"] = $val["my_full_url"];
									//$ELEMENTS_OUT['offer'][$ind]["_c"]["own_price"]["_v"] = $val["own_price"];
									$ELEMENTS_OUT['offer'][$ind]["_c"]["own_price"]["_v"] = $val["own_price"];
									
									//foreach ($arShops as $ownshop)
									//		{
									//			$ELEMENTS_OUT['offer'][$ind]["_c"]["own_price_".$ownshop]["_v"] = $val["own_price_".$ownshop];
									//		}
									
									
									
									$ELEMENTS_OUT['offer'][$ind]["_c"]["time"]["_v"] = $val["time"];
									
									$ELEMENTS_OUT['offer'][$ind]["_c"]["count_prices"]["_v"] = count($val["prises"]);
									
									
								//  echo "<pre>prises "; print_r($val["prises"]); echo "</pre><hr>";
									$arPrices = Array();
									foreach ($val["prises"] as $preice_ind =>  $preice_val)  
											{  
										//echo "<pre>prises "; print_r($preice_val); echo "</pre><hr>"; 
											if (in_array($preice_val["name"], $arShops))
											{
												$ELEMENTS_OUT['offer'][$ind]["_c"]["own_price_".$preice_val["name"]]["_v"] = $preice_val["price"];
											}
											//else
												
												
												{
												//собрать все цена в один массив, нужно найти лучшую цену конкурентов
												$arPrices[]= $preice_val["price"]; 	
												}
											
											
											
											
											//echo "<pre> preice_val"; print_r(preice_val); echo "</pre>"; 
												foreach ($preice_val as $pr_ind => $pr_val)
													{
														// echo "<pre> pr_val"; print_r($pr_val); echo "</pre>"; 
														
														$preice_cout ++;
														$ELEMENTS_OUT['offer'][$ind]["_c"]["prises"]["_c"]["sku".$preice_ind]["_c"][$pr_ind]["_v"] =  $pr_val;
														//$ELEMENTS_OUT['offer'][$ind]["_c"]["prises"]["_a"][$pr_ind]["_v"] =  1;
														//$ELEMENTS_OUT['offer'][$ind]["_c"]["prises"][]["_a"][$pr_ind]["_v"] =  2;
													}
													
											}  
									//echo "<pre>"; print_r($arPrices); echo "</pre>";
									sort($arPrices);
									//echo "<pre>цены "; print_r($arPrices); echo "</pre>";
									
									//оставить уникальные цены
									$arPrices_2 = array_unique($arPrices);
									//echo "<pre>цены уникальные 1 "; print_r($arPrices_2); echo "</pre>";
									sort($arPrices_2);
									//echo "<pre>цены уникальные sort"; print_r($arPrices_2); echo "</pre>";
									//echo "second price = ". $arPrices_2[1];
									
									//$ELEMENTS_OUT['offer'][$ind]["_c"]["second_price"]["_v"] = $arPrices[1]; 
									$ELEMENTS_OUT['offer'][$ind]["_c"]["second_price"]["_v"] = $arPrices_2[1];
									
									
											//собрать в отдельный файл цены
											//foreach ($val["prises"] as $price_ind => $preice_val)
											//	{
											//		$preice_cout ++;
											//		$PREISES_OUT['preice'][$preice_cout]["_c"]["id_product"]["_v"] = $preice_val["id_product"];
											//		$PREISES_OUT['preice'] [$preice_cout]        ["_c"]["my_id"]     ["_v"] = $val["my_id"];
											//		$PREISES_OUT['preice'][$preice_cout]["_c"]["name"]["_v"] = $preice_val["name"];
											//		$PREISES_OUT['preice'][$preice_cout]["_c"]["price"]["_v"] = $preice_val["price"];
											//	}
								} 
												
												
												  //  echo "<pre>result "; print_r($ELEMENTS_OUT); echo "</pre>****************************************</br></br></br>";  
												
												 $xmlStr_2 = ary2xml($ELEMENTS_OUT);
						  
												  //преобразование тегов
												 $xmlStr_2 = preg_replace("!<sku(.*?)>!si","<sku>",$xmlStr_2);
												 $xmlStr_2 =  preg_replace("!</sku(.*?)>!si","</sku>",$xmlStr_2);
												 
												 file_put_contents($temp_out_file_elements, $xmlStr_2, FILE_APPEND | LOCK_EX);
												 
												  $element_cout +=  count($all_elements);
												 
												 $all_elements = Array(); 
												 
												
												 $debug->optimize_memory(); 
												 
												 
												 
												 
												 ////////////////////////////
												  //собрать промежуточный файл для отправки
													  debug_mess("</br></br>".date("\[ d.m.y H:i:s\] ").  "НАЧИНАЕМ СОБИРАТЬ промежуточный ФФайл");
														//
														$shablon_str=file_get_contents($shablon_file);
														$elements_str=  file_get_contents($temp_out_file_elements);
														
														
														$result_file_str = str_replace("#ITEMS#", $elements_str, $shablon_str);
													//	file_put_contents($result_file_items, $result_file_str, FILE_APPEND | LOCK_EX); 
														file_put_contents($result_file_items, $result_file_str); 
												 
												 
												 
												 
												 //////////////////////////////
												 
												 
												 
												 
												 
												 ////SFT /////////////////////////////
												 ///отправляем временный файл на сервер
												 {
													$local_file = $result_file_items;
													$server_file = $to_path.$shop_prefix."_".$f_name_items;
													
													debug_mess(date("\[ d.m.y H:i:s\] ")." SFTP отправляем временный файл на сервер");
													$connection = ssh2_connect($to_server, 22);
													 if ( ssh2_auth_password($connection, $to_user, $to_password))
																 {
																	 if ( ssh2_scp_send($connection, $local_file, $server_file, 0644))
																			{
																				
																				debug_mess(date("\[ d.m.y H:i:s\] ")." connection ". $connection . "");
																				debug_mess(date("\[ d.m.y H:i:s\] ")." local_file ". $local_file . "  ");
																				debug_mess(date("\[ d.m.y H:i:s\] ")." server_file ". $server_file . " ");
																				
																				//удалить временный файл	
																				//$file_os->delete($temp_out_file_elements);
																				//debug_mess(date("\[ d.m.y H:i:s\] ")." file ". $temp_out_file_elements . " удален ");
																				
																					debug_mess(date("\[ d.m.y H:i:s\] ")." file ". $f_name_items . " отправлен на портал ");
																			} 
																			else
																				{
																						debug_mess(date("\[ d.m.y H:i:s\] ")."  ssh2_scp_send ". $ssh2_scp_send . "  no send");
																				}
																 }
																	else
																	{
																			debug_mess(date("\[ d.m.y H:i:s\] ")."  ssh2_auth_password ". $ssh2_auth_password . "  no password");
																	}
													
												 }
												 
												 
												 
												 
												 
												 
											}
										 //	else 
										 //		echo  debug_mess("".date("\[ d.m.y H:i:s\] ").  $step . " ". $step % $step_for_save);
								  
								  
							  }
							   
								
								
								 
						 
						  
						  
							
								  
						  //собрать итоговый файл
						  
						  debug_mess("</br></br>".date("\[ d.m.y H:i:s\] ").  " удаляем файл ".$result_file_items. " ");
						  $file_os->delete($result_file_items);
						  
						  debug_mess("</br></br>".date("\[ d.m.y H:i:s\] ").  "НАЧИНАЕМ СОБИРАТЬ ИТОГОВЫЙ ФФайл");
							//
							$shablon_str=file_get_contents($shablon_file);
							$elements_str=  file_get_contents($temp_out_file_elements);
							
							
							$result_file_str = str_replace("#ITEMS#", $elements_str, $shablon_str);
						//	file_put_contents($result_file_items, $result_file_str, FILE_APPEND | LOCK_EX);
							file_put_contents($result_file_items, $result_file_str);
							
							
							debug_mess("</br></br>".date("\[ d.m.y H:i:s\] ").  "товаров: ". $element_cout. ""); 
						
						
						/*
						//////////////////////////////FTP//////////////////////////////////
						{
							
						$local_file = $result_file_items;
						$server_file = $to_path.$shop_prefix."_".$f_name_items;
						$ftp_user_name="username";
						$ftp_user_pass="password";

						$conn_id = ftp_connect($to_server);

						// login with username and password
						$login_result = ftp_login($conn_id, $to_user, $to_password);

						// upload a file
							 if (ftp_put($conn_id, $server_file, $local_file, FTP_ASCII)) {
								 debug_mess(date("\[ d.m.y H:i:s\] ")." successfully uploaded ". $local_file . "  ");
							   
							   // exit;
							 } else {
							  
								debug_mess(date("\[ d.m.y H:i:s\] ")." There was a problem while uploading ". $local_file . "  ");
							  //  exit;
								}
							 // close the connection
							 ftp_close($conn_id);	
						}
							///////////////////////////////////////////////////////////////////
						*/
						


						{
						///SFTP  ////////////////////////////////////////////////
							
						debug_mess(date("\[ d.m.y H:i:s\] ")." SFTP ");
								
								
							
						 $connection = ssh2_connect($to_server, 22);
						// debug_mess(date("\[ d.m.y H:i:s\] ")." connection ". $connection . " ");
						
						

						$local_file = $result_file_items;
						$server_file = $to_path.$shop_prefix."_".$f_name_items;
						//debug_mess(date("\[ d.m.y H:i:s\] ")." local_file ". $local_file . "  ");
						//debug_mess(date("\[ d.m.y H:i:s\] ")." server_file ". $server_file . " ");
						 
						
						
						

						
						
												 if ( ssh2_auth_password($connection, $to_user, $to_password))
												 {
													 if ( ssh2_scp_send($connection, $local_file, $server_file, 0644))
															{
																
																debug_mess(date("\[ d.m.y H:i:s\] ")." connection ". $connection . "");
																debug_mess(date("\[ d.m.y H:i:s\] ")." local_file ". $local_file . "  ");
																debug_mess(date("\[ d.m.y H:i:s\] ")." server_file ". $server_file . " ");
																
																//удалить временный файл	
																$file_os->delete($temp_out_file_elements);
																debug_mess(date("\[ d.m.y H:i:s\] ")." file ". $temp_out_file_elements . " удален ");
																
																	debug_mess(date("\[ d.m.y H:i:s\] ")." file ". $f_name_items . " отправлен на портал ");
															} 
															else
																{
																		debug_mess(date("\[ d.m.y H:i:s\] ")."  ssh2_scp_send ". $ssh2_scp_send . "  no send");
																}
												 }
													else
													{
															debug_mess(date("\[ d.m.y H:i:s\] ")."  ssh2_auth_password ". $ssh2_auth_password . "  no password");
													}
												 
							
					      
							}
											
													 
						 /////////////////////////////////////////////////////////////////////
						
						$time_end = time();
						
						debug_mess("</br></br>".date("\[ d.m.y H:i:s\] ").  "time_start : ".$time_start. " "); 
						debug_mess("".date("\[ d.m.y H:i:s\] ").  "time_end : ".$time_end. " "); 
						debug_mess("".date("\[ d.m.y H:i:s\] ").  "продолжительность, сек : ".$time_end-$time_start. " "); 
						debug_mess("".date("\[ d.m.y H:i:s\] ").  "товаров : ".$element_cout. " "); 
						debug_mess("".date("\[ d.m.y H:i:s\] ").  "на 1 товар : ". ($time_end-$time_start)/$element_cout. " секунд"); 

}


debug_mess(date("\[ d.m.y H:i:s\] ")." endd<br>");      

// Quit
$app->quit();