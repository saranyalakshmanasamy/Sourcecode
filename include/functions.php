<?php

/* Connects to and selects the specified db with specified DB with specified user */
function f_sqlConnect ($user,$pass,$db){
    $link = mysql_connect('sas.co.nz',$user,$pass);
      if (!$link){
	  die ('Could not connect:' .mysql_error());
	  }
	 $db_selected = mysql_select_db($db,$link);
	  if (! $db_selected){
	    die ('Cant use' .$db.'.' .mysql_error());
		}
    }
	
/* Cleans an array to protect against injection attacks */
function f_clean($array){
   return array_map('mysql_real_escape_string', $array);
   }

   
?>


	  
	 







