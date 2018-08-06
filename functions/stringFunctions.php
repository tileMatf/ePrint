<?php

	function readjustText($text, $max_length) {
		if(!isset($text))
			return $text;
		if(strlen($text) <= $max_length){			
			return $text;
		}
		$new_text = "";
		$text_parts = [];
		while(strlen($text) > $max_length){
			if(substr($text, $max_length-1, 1) === " ") {
				$new_text = substr($text, 0, $max_length); //. "\n";
				array_push($text_parts, $new_text);
				$text = substr($text, $max_length);
			} else {
				$last_space = strrpos($text, " ", -(strlen($text)-$max_length));
				$new_text = trim(substr($text, 0, $last_space)) . "\n";
				array_push($text_parts, $new_text);
				$text = trim(substr($text, $last_space));
			} 
		}		
		//$new_text .= $text;
		array_push($text_parts, $text);
		return $text_parts;
	}

	function getSecondIndexOfSpace($text) {
		$count = 0;
		$index = 0;
		while($count < 2){
			$tmp_index = strpos($text, " ", $index);
			$index += $tmp_index;
			$text = substr($text, $tmp_index+1);
			$count++;
		}
		return $index+1;
	}
	
	function getName($text) {
		$occurrence = substr_count($text, " ");
		if($occurrence < 2)
			return false;
		
		$secondSpaceIndex = getSecondIndexOfSpace($text);		
		return trim(substr($text, 0, $secondSpaceIndex));
	}
	 
	function getAdress($text) {
		$occurrence = substr_count($text, " ");
		if($occurrence < 2)
			return false;
		
		$secondSpaceIndex = getSecondIndexOfSpace($text);		
		return trim(substr($text, $secondSpaceIndex));
	}
	
	function endsWith($haystack, $needle)
	{
		$length = strlen($needle);
		return $length === 0 || (substr($haystack, -$length) === $needle);
	}
	
	function readjustAmount($amount){
		if(!strpos($amount, "="))
			$amount = " = " . $amount;
		if(endsWith($amount, ".00")){
			$index = strrpos($amount, ".00");
			$amount = substr_replace($amount, ",00", $index, 3);
		} else if(!strpos($amount, ".") && !strpos($amount, ",")) {
			$amount .= ",00";
		}
		return $amount;
	}
	
	function convertToCyrilic($input){
		if($input === null || $input === '')
			return '';
        $cyr = [
            'љ','њ','џ','а','б','в','г','д','ђ','е','ж','з','и','j','к','л','м','н','о','п',
            'р','с','т','ћ','у','ф','х','ц','ч','ш',
            'Љ','Њ','Џ','А','Б','В','Г','Д','Ђ','Е','Ж','З','И','Ј','К','Л','М','Н','О','П',
            'Р','С','Т','Ћ','У','Ф','Х','Ц','Ч','Ш'
        ];
        $lat = [
            'lj','nj','dž','a','b','v','g','d','đ','e','ž','z','i','j','k','l','m','n','o','p',
            'r','s','t','ć','u','f','h','c','č','š',
            'LJ','NJ','Dž','A','B','V','G','D','Đ','E','Ž','Z','I','J','K','L','M','N','O','P',
            'R','S','T','Ć','U','F','H','C','Č','Š'
        ];
        $input = str_replace($lat, $cyr, $input);
		return $input;
	}
	
	function remove_special_char($input){
		if($input === null || $input === '')
			return $input;
		
		$special_char = ['\\', '*', '?', '|', '<', '>', '"', ':'];
		
		$input = str_replace($special_char, '', $input);
		return $input;
	}
	
?>