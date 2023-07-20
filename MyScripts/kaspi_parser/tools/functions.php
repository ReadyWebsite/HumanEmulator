<?php
// выдать сообщение в панель отладки
function  debug_mess($mess)
{
   global $dbg;
   // отладочные сообщения
   if($dbg)
      echo $mess."<br/>";
}

function read_section($page, $site, $own_shop)
    {
        //global $browser;
         global $body, $browser, $anchor, $element, $webpage, $div, $mouse, $image, $span, $debug;
		 global $allpage;
       //  global read_element();
         
        $fool_link = $site."&page=".$page;
        
          $Item_Array = Array();
		
		
		//$browser->set_count(2);
		//$browser->set_active_browser(1);
		//$browser->recreate();
	//	sleep(1);
		
		
        $browser->navigate($fool_link);
        debug_mess(date("\[ d.m.y H:i:s\] ")." перешли на страницу ". $page. " из ". $allpage);
       // $browser->refresh();
         $browser->wait_for(640,3); 
         $browser->wait_js();
         sleep(1);
        
     $content =  $body->get_inner_html_by_number(0);
     //echo "111".$content;
     
     {
		   // Удаляем со страницы всё, от начала до "var listing=", затем удаляем всё до '"items":['
    $content = strstr($content, 'var listing =', false); 
    $content = strstr($content, '"items": [', false); 
    $content = preg_replace('/\"items\"\:\[/', '', $content);

    // Удаляем со страницы всё, от '<script>BACKEND.API=' до конца, а затем дочищаем '</script>
   // $content = strstr($content, '<script>BACKEND.API = ', true);
    $content = strstr($content, 'BACKEND.API = ', true);
	$content = strstr($content, '<script>', true);
    $content = strstr($content, '</script>', true);
    // После этой операции переменная $content содержит чистый JavaScript c Kaspi, который можно парсить 
  //echo "111".$content;
    // Преобразуем нашу переменную $content в массив $arr с разделением через { }
    preg_match_all('|{(.+)}|isU', $content, $arr); 
    
     //echo "<pre>"; print_r($arr); echo "</pre>";
     
       try {

        for ($i = 0; $i<=11; $i++ ) {
            $mystring = explode(",", $arr[0][$i]);
//$browser->navigate("https://kaspi.kz/shop/search/?text=albion-time-kz&q=%3Acategory%3ACategories%3AmanufacturerName%3AAdriatica%3AmanufacturerName%3AAKA%20DERI%3AmanufacturerName%3AARMITRON%3AmanufacturerName%3ABANGE%3AmanufacturerName%3ABoccia%20Titanium%3AmanufacturerName%3ABullcaptain%3AmanufacturerName%3ACARDCASE%3AmanufacturerName%3ACASIO%3AmanufacturerName%3ADaniel%20Klein%3AmanufacturerName%3AEssence%3AmanufacturerName%3AESSENCE%3AmanufacturerName%3AFashion%3AmanufacturerName%3AGO%20Girl%20Only%3AmanufacturerName%3AGROVANA%3AmanufacturerName%3AHumidifier%3AmanufacturerName%3AINOX%20Plus%3AmanufacturerName%3AJT%3AmanufacturerName%3AKonka%3AmanufacturerName%3ALED%3AmanufacturerName%3ALongstar%3AmanufacturerName%3ANo%20Name%3AmanufacturerName%3AOEM%3AmanufacturerName%3APierre%20Ricaud%3AmanufacturerName%3AQ%26Q%3AmanufacturerName%3ARoyal%20London%3AmanufacturerName%3ASlazenger%3AmanufacturerName%3AStailer%3AmanufacturerName%3ASuitu%3AmanufacturerName%3AWAINER%3AmanufacturerName%3AWellamart%3AmanufacturerName%3AWIWU%3AmanufacturerName%3A%D0%91%D0%B5%D0%B7%20%D0%B1%D1%80%D0%B5%D0%BD%D0%B4%D0%B0%3AmanufacturerName%3A%D0%9A%D0%B8%D1%82%D0%B0%D0%B9%3AallMerchants%3AAlbion&sort=relevance&filteredByCategory=false&page=120");

            
          // echo "<pre>mystring"; print_r($mystring); echo "</pre>";
           
           foreach ($mystring as $a=>$b)
           		{
				//	echo "<br>-- ". $a . " - ". $b . "<br>";
					
					$b= str_replace('"',"", $b);
					$row = explode (":", $b);
					
				//	echo "sehe ich ". $row[0]. " - " . $row[1];
				
					if(stripos($row[0], 'id') !== false )
							{
								//echo "<br>id смотрим ";
								 //echo "<br>row[0] ". $row[0] ;
								    $data_id = preg_replace ("/\"/", "", $row[1]); //Значение цифры постоянное, не изменять!
            						$data_id = preg_replace ("/\{/", "", $data_id);
            					//	$my_id = explode(":", $data_id);
            					// echo "<pre>ID  "; print_r($data_id); echo "</pre>";
            					    if ($row[0] =="{id")
            					 	   $my_id =   $data_id;
            					  
								
							}
					else if(stripos($row[0], 'name') !== false)
							{
								//echo "<br>name  смотрим ";
								
								 $data_name = preg_replace ("/\"/", "", $row[1]); //Значение цифры постоянное, не изменять!
            					 $data_name = preg_replace ("/\&amp;/", "&", $data_name);
           						  //$my_name = explode(":", $data_name);
            						
            						$my_name = $data_name;
							}
							
				    else if(stripos($row[0], 'discount') !== false)
							{
							//	echo "<br>discount смотрим ";
								
									 $data_discount = preg_replace ("/\"/", "",$row[1]); //Значение цифры постоянное, не изменять!
            						// $my_discount = explode(":", $data_discount);
            						
            					 	$my_discount =   $data_discount;
							}
							
					else if(stripos($b, 'unitPrice') !== false)
							{
								//echo "<br>---uunitPrice смотрим "; 
									 $data_unitprice = preg_replace ("/\"/", "", $row[1]); //Значение цифры постоянное, не изменять!
            						// $my_unitprice = explode(":", $data_unitprice);
            					$my_unitprice =    $data_unitprice;
							}
							
					else if(stripos($b,'unitsaleprice') !== false)
							{
								//echo "<br>unitsaleprice  смотрим ";
									 $data_unitsaleprice = preg_replace ("/\"/", "", $row[1]); //Значение цифры постоянное, не изменять!
            						 //$my_unitsaleprice = explode(":", $data_unitsaleprice);
            						 
            						 $my_unitsaleprice =   $data_unitsaleprice;
							}
							
					else if(stripos($b, 'brand') !== false)
							{
								//echo "<br>brand  смотрим ";
									 $data_brand = preg_replace ("/\"/", "", $row[1]); //Значение цифры постоянное, не изменять!
            						 $data_brand = preg_replace ("/\&amp;/", "&", $data_brand);
            						// $my_brand = explode(":", $data_brand);
            						$my_brand =  $data_brand;
							}
							
					else if(stripos($b, 'reviewCount') !== false)
							{
								//echo "<br>stock смотрим ";
								//echo "<pre>STOCK "; print_r($row); echo "</pre>";
									  $data_count = preg_replace ("/\"/", "",  $row[1]); //Значение цифры постоянное, не изменять!
            						  $data_count = preg_replace ("/\}/", "", $data_count);
            						 // $my_count = explode(":", $data_count);
            						 $my_count =  $data_count;
							}
							
					else if(stripos($b, 'url') !== false)
							{
								//echo "<br>url смотрим ";
							//	echo "<pre>URL"; print_r($row); echo "</pre>";
									 $data_url = preg_replace ("/\"/", "", $row[1]); //Значение цифры постоянное, не изменять!
            						 //$my_url = explode(":", $data_url);
            						// $my_full_url = $my_url[1].":".$my_url[2];
            					   if ($row[0]=="url")
            						$my_full_url =  $row[1].":".$row[2];
							}
							
						//	else 
						//		echo "<br>NEEEEE" ;
					
           		}
           
           
           
           
           
            /*

            $data_id = preg_replace ("/\"/", "", $mystring[0]); //Значение цифры постоянное, не изменять!
            $data_id = preg_replace ("/\{/", "", $data_id);
            $my_id = explode(":", $data_id);

            $data_name = preg_replace ("/\"/", "", $mystring[1]); //Значение цифры постоянное, не изменять!
            $data_name = preg_replace ("/\&amp;/", "&", $data_name);
            $my_name = explode(":", $data_name);

            $data_discount = preg_replace ("/\"/", "", $mystring[6]); //Значение цифры постоянное, не изменять!
            $my_discount = explode(":", $data_discount);

            $data_unitprice = preg_replace ("/\"/", "", $mystring[7]); //Значение цифры постоянное, не изменять!
            $my_unitprice = explode(":", $data_unitprice);

            $data_unitsaleprice = preg_replace ("/\"/", "", $mystring[8]); //Значение цифры постоянное, не изменять!
            $my_unitsaleprice = explode(":", $data_unitsaleprice);

            $data_brand = preg_replace ("/\"/", "", $mystring[16]); //Значение цифры постоянное, не изменять!
            $data_brand = preg_replace ("/\&amp;/", "&", $data_brand);
            $my_brand = explode(":", $data_brand);

            $data_count = preg_replace ("/\"/", "", $mystring[20]); //Значение цифры постоянное, не изменять!
            $data_count = preg_replace ("/\}/", "", $data_count);
            $my_count = explode(":", $data_count);

            $data_url = preg_replace ("/\"/", "", $mystring[15]); //Значение цифры постоянное, не изменять!
            $my_url = explode(":", $data_url);
            $my_full_url = $my_url[1].":".$my_url[2];

             */
            if ($my_name <> "") {

           // 	echo   "<hr><br>". $my_name ;
           // 	echo   "<br>my_id ". $my_id;
           // 	echo   "<br>my_discount ". $my_discount;
           // 	echo   "<br>my_unitprice ". $my_unitprice ;
           // 	echo   "<br>my_unitsaleprice ". $my_unitsaleprice;
           // 	echo   "<br>my_brand ". $my_brand;
           //  	echo   "<br>my_count ". $my_count;
           // 	echo   "<br>my_full_url ". $my_full_url;
            // 	 echo "<hr>";
            	
            	
            	  $Item_Array[$my_id]["my_id"] =  $my_id;
            	  $Item_Array[$my_id]["my_name"] =  $my_name;
            	  $Item_Array[$my_id]["my_discount"] =  $my_discount;
            	  $Item_Array[$my_id]["my_unitprice"] =  $my_unitprice;
            	  $Item_Array[$my_id]["my_unitsaleprice"] =  $my_unitsaleprice;
            	  $Item_Array[$my_id]["my_brand"] =  $my_brand;
            	  $Item_Array[$my_id]["my_count"] =  @$my_count;
            	  $Item_Array[$my_id]["my_full_url"] =  $my_full_url;
				  $Item_Array[$my_id]["time"] =  date("Y-m-d H:i:s");
            	  
            	  
            	  
            	//   debug_mess(date("\[ d.m.y H:i:s\] ")." пойдем смотреть ". $my_full_url);
            	     //читаем детальную страницу
			            if (1)
            				{
								$Price_Array =   read_element_2($my_full_url, $my_id, $own_shop);
							//	echo "<pre> ";  print_r($Price_Array); echo "</pre> ";
								
								$Item_Array[$my_id]["own_price"] =  $Price_Array["own_prise"];
								unset ($Price_Array["own_prise"]);
								
								$Item_Array[$my_id]["prises"] =     $Price_Array;
								
								
            				}
            	  
            	  
            	  
            	//   echo "<pre> ";  print_r($Item_Array); echo "</pre> ";
            	
                //echo "INSERT INTO sdc_kaspishop (`id_caspi`, `name`, `discount`, `unitprice`, `unitsaleprice`, `brand`, `countviews`, `caspi_url`, `category`) VALUES ('$my_id[1]', '$my_name[1]', '$my_discount[1]', '$my_unitprice[1]', '$my_unitsaleprice[1]', '$my_brand[1]', '$my_count[1]', '$my_full_url', '$category');<br>";
              //  mysqli_query($link, "INSERT INTO sdc_kaspishop (`id_caspi`, `name`, `discount`, `unitprice`, `unitsaleprice`, `brand`, `countviews`, `caspi_url`, `category`) VALUES ('$my_id[1]', '$my_name[1]', '$my_discount[1]', '$my_unitprice[1]', '$my_unitsaleprice[1]', '$my_brand[1]', '$my_count[1]', '$my_full_url', '$category');");

              
              /*
              //товар
              $el = new CIBlockElement;
			  
			  $PROP = array();
			  $PROP [$PROP_TO["id"]["ID"]] =$my_id[1]; 
			  $PROP [$PROP_TO["discount"]["ID"]] =$my_discount[1];
			  $PROP [$PROP_TO["unitprice"]["ID"]] =$my_unitprice[1];
			  $PROP [$PROP_TO["unitsaleprice"]["ID"]] =$my_unitsaleprice[1];
			  $PROP [$PROP_TO["brand"]["ID"]] =$my_brand[1];
			  $PROP [$PROP_TO["count"]["ID"]] =$my_count[1];
			  $PROP [$PROP_TO["full_url"]["ID"]] =$my_full_url;
			 
			  $arLoadProductArray = Array(
			  "MODIFIED_BY"    => $USER->GetID(), // элемент изменен текущим пользователем
			  "IBLOCK_SECTION_ID" => false,          // элемент лежит в корне раздела
			  "IBLOCK_ID"      => $BID,
			//  "PROPERTY_VALUES"=> $PROP,
			  "NAME"           => $my_name[1],
			  "ACTIVE"         => "Y",            // активен
			  
			  );
              
           
             if($write_log)
            	   			 file_put_contents ($out_log, date("Y-m-d H:i:s")."|".$my_name[1]."|".$my_unitsaleprice[1]."|".my_full_url.PHP_EOL, FILE_APPEND); 
       					
              
              
              
          
          	//есть такой товар?
          	$arFilter = Array(
          					"IBLOCK_ID"=>$BID,  
          					"ACTIVE"=>"Y", 
          					"=NAME" => $my_name[1]
          					);
          	
          
          	
          	$res = CIBlockElement::GetList(false, $arFilter, false, false, Array("ID", "IBLOCK_ID", "NAME"));
			
			$cnt = $res->SelectedRowsCount();
		
          	
          	if ($cnt)
          			{
						//обновить
						
						//echo "<br> обновить ". $my_name[1];
						if($write_log)
            	   			 file_put_contents ($out_log, date("Y-m-d H:i:s")."|обновить".PHP_EOL, FILE_APPEND); 
						
						
						while($ar_fields = $res->GetNext())
								{
								//echo "<pre>"; print_r($ar_fields); echo "</pre>";
								
								$PRODUCT_ID =  $ar_fields['ID'];
								
								}
						
					$res_update = $el->Update($PRODUCT_ID, $arLoadProductArray);	
					CIBlockElement::SetPropertyValuesEx($PRODUCT_ID, $BID, $PROP);	
						
          			}
          			else
          				
              				//новый элемент
              				{
							if($write_log)
            	   			 file_put_contents ($out_log, date("Y-m-d H:i:s")."|новый элемент".PHP_EOL, FILE_APPEND);	

								if($PRODUCT_ID = $el->Add($arLoadProductArray))
								  	{
										//echo "<br>New ID: ".$PRODUCT_ID;
										//CIBlockElement::SetPropertyValuesEx($PRODUCT_ID, $BID, $PROP);
								  	}
								else
								  	{
										//echo "Error: ".$el->LAST_ERROR;
								  	}
				             }
          				
              ///парсим цены конкурентов
				   if ($PRODUCT_ID)
					{
						//	 parse_item($my_full_url, $PRODUCT_ID);  
						//	sleep($sleep_time);
					}   
            
              
			*/
              
            }
            			else
            				{
								  if($write_log)   
								 			file_put_contents ($out_log, date("Y-m-d H:i:s")."|ошибка, товар не спарсился ".PHP_EOL, FILE_APPEND);
            				}
        }

    } catch (Exception $e) {
        //echo 'Выброшено исключение: ',  $e->getMessage(), "\n";
    }

     }
        
         
       
		
		 $debug->optimize_memory(); 
            debug_mess(date("\[ d.m.y H:i:s\] ").($debug->get_cur_mem_size()/1024/1024)." Mb");
            
            
            
         
		
		
         return $Item_Array;
    }


function read_section_2($page, $site, $own_shop)
    {
        //global $browser;
         global $body, $browser, $anchor, $element, $webpage, $div, $mouse, $image, $span, $debug;
		 global $allpage;
       //  global read_element();
         
        $fool_link = $site."&page=".$page;
        
          $Item_Array = Array();
		
		
		//$browser->set_count(2);
		//$browser->set_active_browser(1);
		//$browser->recreate();
	//	sleep(1);
		
		
        $browser->navigate($fool_link);
        debug_mess(date("\[ d.m.y H:i:s\] ")." перешли на страницу ". $page. " из ". $allpage);
        $browser->refresh();
         $browser->wait_for(640,3); 
         $browser->wait_js();
         sleep(1);
        
     $content =  $body->get_inner_html_by_number(0);
     //echo "111".$content;
	 
	 
	 
	 
	 $debug->optimize_memory(); 
     debug_mess(date("\[ d.m.y H:i:s\] ").($debug->get_cur_mem_size()/1024/1024)." Mb");
            

     return $Item_Array;
    }

    
function read_element($link, $id_product, $own_shop)
{
			 global $body, $browser, $anchor, $element, $webpage, $div, $mouse, $image, $span, $debug;
			 
			// global $arShops;
       
      //  $link= "https://kaspi.kz/shop/p/nika-0446-2-1-45h-korichnevyi-102181753/?c=710000000";
	//	$link = "https://kaspi.kz/shop/p/casio-mtp-vd01l-2bvudf-sinii-100085799/?c=710000000";
        
        $browser->navigate($link);
        debug_mess(date("\[ d.m.y H:i:s\] ")." перешли на страницу". $link);
         $browser->wait_for(640,3); 
         //sleep(1);
        
        $Item_Array = Array();
        $content = "";
        
         $content =  $body->get_inner_html_by_number(0);
         
         {
			  // Удаляем со страницы всё, от начала до "<script type="application/ld+json">"
    $content = strstr($content, '<script type="application/ld+json">', false); 
    $content = preg_replace('/<script type=\"application\/ld\+json\">/', '', $content);
    $content = preg_replace('/\\n/', '', $content);
    
     
 //  if (strstr($content, '<div class="mount-reviews', true))
 //    	echo "YES";
 //    	else echo "NO";
   
   
    // Удаляем со страницы всё, от '<div class=mount-reviews></div>' до конца, а затем дочищаем '</script>
    $content = strstr($content, '<div class="mount-reviews', true);   
    $content = strstr($content, '</script>', true);

//echo $content ."<hr>";
    // После этой операции переменная $content содержит чистый JSON c Kaspi, который можно парсить 
    
   

    $json = json_decode($content,true);
	
	//echo "<pre>"; print_r($json); echo "</pre>";

    for ($z = 0; $z <= 20; $z++) { //Проверяем, будет ли 20 поставщиков
        
        $price = trim($json['offers']['offers'][$z]['price']); 
        $name = trim($json['offers']['offers'][$z]['name']);

        $price = preg_replace('/ /', '', $price);
        $price = preg_replace('/₸/', '', $price);

       // echo "<br>price: ". $price;
      //  
         
        if ($name <> "") {
        
			               $Item_Array[$z]["id_product"] =  $id_product; 
			               $Item_Array[$z]["name"] =  $name; 
			               $Item_Array[$z]["price"] =  $price; 
						   
						 
						
						 
						
						  
						
			           
			         
			         
			           ////Если поставщик Albion-time то у этого товара в каталоге поставить метку///////////////////////////////////
			            if ($name == $own_shop)
            					{ 
            						$Item_Array["own_prise"] =  $price; 
									
            					}
								//else echo $name ." - ". $own_shop."<br>";
								
								
						//if (in_array($name, $arShops))
						//{
						//	$Item_Array["own_prise_".$name] =  $price;
						//}
			            
			            ////////////////////////////////////////////////////////////////////////////////////////////////////////////   
			            
			         
			         }
         
        
        
        } 
    }
    
    
		      echo "<pre> цены ";  print_r($Item_Array); echo "</pre> ";
		
		 return $Item_Array;
}

function read_element_2($link, $id_product, $own_shop)
{
			 global $body, $browser, $anchor, $element, $webpage, $div, $mouse, $image, $span, $debug;
			 
			// global $arShops;
       
      //  $link= "https://kaspi.kz/shop/p/nika-0446-2-1-45h-korichnevyi-102181753/?c=710000000";
	//	$link = "https://kaspi.kz/shop/p/casio-mtp-vd01l-2bvudf-sinii-100085799/?c=710000000";
        
        $browser->navigate($link);
        debug_mess(date("\[ d.m.y H:i:s\] ")." перешли на страницу". $link);
         $browser->wait_for(640,3); 
         //sleep(1);
        
		$id_product = ($element -> get_inner_html_by_attribute("class", "item__sku"));
		$id_product = preg_replace('/[^0-9]/', '', $id_product);  
		
		//echo "id ". $id_product . "<br>";
		
        $Item_Array = Array();
        $content = "";
        
       //  $content =  $body->get_inner_html_by_number(0);
          $content= $element -> get_inner_html_by_attribute ("class", "sellers-table__self");
		 // echo $content ."<hr>";
		 
		
		$pq = phpQuery::newDocument($content);
		 
		$entry = $pq->find('tr');
		foreach ($entry as $ind=> $row) {
			$row = pq($row);
			$name = $row->find('td:eq(0)')->find('a:eq(0)') ->text();
			$price =  preg_replace('/[^0-9]/', '', $row->find('td:eq(3)')->text());
			$data['table'][$name] = $value;
			
			
			  if ($name <> "") {
        
			               $Item_Array[$ind]["id_product"] =  $id_product; 
			               $Item_Array[$ind]["name"] =  $name; 
			               $Item_Array[$ind]["price"] =  $price; 
						   
						 
						
						 
						
						  
						
			           
			         
			         
			           ////Если поставщик Albion-time то у этого товара в каталоге поставить метку///////////////////////////////////
			            if ($name == $own_shop)
            					{ 
            						$Item_Array["own_prise"] =  $price; 
									
            					}
								//else echo $name ." - ". $own_shop."<br>";
								
								
						//if (in_array($name, $arShops))
						//{
						//	$Item_Array["own_prise_".$name] =  $price;
						//}
			            
			            ////////////////////////////////////////////////////////////////////////////////////////////////////////////   
			            
			         
			         }
       
		}
 
			
		 
 		  
		  
	
    
    
		     // echo "<pre> цены ";  print_r($Item_Array); echo "</pre> ";
		
		 return $Item_Array;
}


 function read_brand($link)
{  
		global $browser, $anchor, $element, $webpage, $div, $mouse, $image, $span, $debug;
        //$fool_link = $site.$link;
        $browser->navigate($link);
        //debug_mess(date("\[ d.m.y H:i:s\] ")." перешли на ". $fool_link);
         $browser->wait_for(640,3); 
         sleep(5);
		 
		 if ($element -> is_exist_by_attribute("class", "partner-info", false))
					{
					 $item = $element->get_inner_html_by_attribute("class", "partner-info", false);	
					$item = iconv (  'windows-1251', 'utf-8', $item);
					
					$item = str_get_html($item);
					//$item = str_get_html($item);					

					
					$OUT_PROP['brand']['logo']= trim($item -> find('img', 0) -> src);
					//$OUT_PROP['brand']['logo']= "//opt-560835.ssl.1c-bitrix-cdn.ru/upload/resize_cache/iblock/50a/135_135_1/mars_175.png";
					
					//$OUT_PROP['brand']['text']= trim($item -> find('.short-text', 0) -> html);
					
					//освобождаем память
				$item -> clear();
				//unset($item);
				$debug->optimize_memory();
							
					}
					
										return $OUT_PROP;

		 
} 
    
    
 function translitIt($str){
    $tr = array(
        "А"=>"A","Б"=>"B","В"=>"V","Г"=>"G","Д"=>"D",
        "Е"=>"E","Ё"=>"YO","Ж"=>"J","З"=>"Z","И"=>"I",
        "Й"=>"Y","К"=>"K","Л"=>"L","М"=>"M","Н"=>"N",
        "О"=>"O","П"=>"P","Р"=>"R","С"=>"S","Т"=>"T",
        "У"=>"U","Ф"=>"F","Х"=>"H","Ц"=>"C","Ч"=>"CH",
        "Ш"=>"SH","Щ"=>"SCH","Ъ"=>"","Ы"=>"YI","Ь"=>"",
        "Э"=>"E","Ю"=>"YU","Я"=>"YA","а"=>"a","б"=>"b",
        "в"=>"v","г"=>"g","д"=>"d","е"=>"e","ё"=>"yo","ж"=>"j",
        "з"=>"z","и"=>"i","й"=>"y","к"=>"k","л"=>"l",
        "м"=>"m","н"=>"n","о"=>"o","п"=>"p","р"=>"r",
        "с"=>"s","т"=>"t","у"=>"u","ф"=>"f","х"=>"h",
        "ц"=>"c","ч"=>"ch","ш"=>"sh","щ"=>"sch","ъ"=>"y",
        "ы"=>"y","ь"=>"","э"=>"e","ю"=>"yu","я"=>"ya",
         " "=>"-" ,
         "."=> "",
            "/"=> "-",
            ","=>"-",
            "-"=>"-",
            "("=>"",
            ")"=>"",
            "["=>"",
            "]"=>"",
            "="=>"-",
            "+"=>"-",
            "*"=>"",
            "?"=>"",
            "\""=>"",
            "'"=>"",
            "&"=>"",
            "%"=>"",
            "#"=>"",
            "@"=>"",
            "!"=>"",
            ";"=>"",
            "№"=>"",
            "^"=>"",
            ":"=>"",
            "~"=>"",
			 "«"=>"",
            "»"=>"",
            "\\"=>""
    );
    return strtr($str,$tr);
}

?>
<?php
 /*
    Working with XML. Usage: 
    $xml=xml2ary(file_get_contents('1.xml'));
    $link=&$xml['ddd']['_c'];
    $link['twomore']=$link['onemore'];
    // ins2ary(); // dot not insert a link, and arrays with links inside!
    echo ary2xml($xml);
*/

// XML to Array
function xml2ary(&$string) {
    $parser = xml_parser_create();
    xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, 0);
    xml_parse_into_struct($parser, $string, $vals, $index);
    xml_parser_free($parser);

    $mnary=array();
    $ary=&$mnary;
    foreach ($vals as $r) {
        $t=$r['tag'];
        if ($r['type']=='open') {
            if (isset($ary[$t])) {
                if (isset($ary[$t][0])) $ary[$t][]=array(); else $ary[$t]=array($ary[$t], array());
                $cv=&$ary[$t][count($ary[$t])-1];
            } else $cv=&$ary[$t];
            if (isset($r['attributes'])) {foreach ($r['attributes'] as $k=>$v) $cv['_a'][$k]=$v;}
            $cv['_c']=array();
            $cv['_c']['_p']=&$ary;
            $ary=&$cv['_c'];

        } elseif ($r['type']=='complete') {
            if (isset($ary[$t])) { // same as open
                if (isset($ary[$t][0])) $ary[$t][]=array(); else $ary[$t]=array($ary[$t], array());
                $cv=&$ary[$t][count($ary[$t])-1];
            } else $cv=&$ary[$t];
            if (isset($r['attributes'])) {foreach ($r['attributes'] as $k=>$v) $cv['_a'][$k]=$v;}
            $cv['_v']=(isset($r['value']) ? $r['value'] : '');

        } elseif ($r['type']=='close') {
            $ary=&$ary['_p'];
        }
    }    
    
    _del_p($mnary);
    return $mnary;
}

// _Internal: Remove recursion in result array
function _del_p(&$ary) {
    foreach ($ary as $k=>$v) {
        if ($k==='_p') unset($ary[$k]);
        elseif (is_array($ary[$k])) _del_p($ary[$k]);
    }
}

// Array to XML
function ary2xml($cary, $d=0, $forcetag='') {
    $res=array();
    foreach ($cary as $tag=>$r) {
        if (isset($r[0])) {
            $res[]=ary2xml($r, $d, $tag);
        } else {
            if ($forcetag) $tag=$forcetag;
            $sp=str_repeat("\t", $d);
            $res[]="$sp<$tag";
            if (isset($r['_a'])) {foreach ($r['_a'] as $at=>$av) $res[]=" $at=\"$av\"";}
            $res[]=">".((isset($r['_c'])) ? "\n" : '');
            if (isset($r['_c'])) $res[]=ary2xml($r['_c'], $d+1);
            elseif (isset($r['_v'])) $res[]=$r['_v'];
            $res[]=(isset($r['_c']) ? $sp : '')."</$tag>\n";
        }
        
    }
    return implode('', $res);
}

// Insert element into array
function ins2ary(&$ary, $element, $pos) {
    $ar1=array_slice($ary, 0, $pos); $ar1[]=$element;
    $ary=array_merge($ar1, array_slice($ary, $pos));
}   
?>