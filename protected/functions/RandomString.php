<?php
	function RandomString($length=0, $chars='', $type=array()) {
		$lowerChars = 'abcdefghijklmnopqrstuvwxyz';
		$upperChars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$num = '0123456789';
		$otherChars = '`~!@#$%^&*()/*-+_=[{}]|;:",<>.\/?' . "'";
		
		$characters = "";
		$string = '';
		
		isset($type['lowerChars'])  ? $type['lowerChars']: $type['lowerChars'] = true;  //lowerChars - default true  
	    isset($type['upperChars'])  ? $type['upperChars']: $type['upperChars'] = true;  //upperChars - default true
	    isset($type['num'])         ? $type['num']: $type['num'] = true;                //num - default true
	    isset($type['otherChars'])  ? $type['otherChars']: $type['otherChars'] = false; //otherChars - default false 
	    isset($type['duplicate'])   ? $type['duplicate']: $type['duplicate'] = true;    //duplicate - default true     
	    
	    if (strlen(trim($chars)) == 0) { 
	        $type['lowerChars'] ? $characters .= $lowerChars : $characters = $characters;
	        $type['upperChars'] ? $characters .= $upperChars : $characters = $characters;
	        $type['num'] ? $characters .= $num : $characters = $characters;
	        $type['otherChars'] ? $characters .= $otherChars : $characters = $characters;        
	    }
	    else
	        $characters = str_replace(' ', '', $chars);
	      
	    if($type['duplicate'])
	        for (; $length > 0 && strlen($characters) > 0; $length--) {
	            $ctr = mt_rand(0, (strlen($characters)) - 1);
	            $string .= $characters[$ctr];
	        }
	    else
	        $string = substr (str_shuffle($characters), 0, $length);
	   
	    return $string;

	}