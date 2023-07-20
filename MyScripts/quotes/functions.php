<?php
// get string by prefix
function get_string($str1, $pr1, $pr2, $ind_st=0)
{
     //echo $str1."<br>";
     $ind1 = strpos ($str1,$pr1,$ind_st);
    // echo "index 1 ".$ind1."<br>";
    if($ind1===false)
      return "";
     
     $ind2 = strpos ($str1,$pr2,$ind1);
    //echo "index 2 ".$ind2."<br>";
     if($ind2===false)
        return "";

     $sres = substr($str1,$ind1+strlen($pr1), $ind2-$ind1-strlen($pr1));
     //echo $sres; 

    return trim($sres); 
}

// show message in debug panel
function  debug_mess($mess)
{
   global $dbg;
   // debug message
   if($dbg)
      echo $mess."<br>";
}
?>