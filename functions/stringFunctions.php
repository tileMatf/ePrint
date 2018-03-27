<?php

	function readjustText($text) {
		if(strlen($text) <= 59){			
			return $text;
		}
		$new_text = "";
		while(strlen($text) > 59){
			if(substr($text, 58, 1) === " ") {
				$new_text .= substr($text, 0, 59) . "\n";
				$text = substr($text, 59);
			} else {
				$last_space = strrpos($text, " ", -(strlen($text)-59));
				$new_text .= trim(substr($text, 0, $last_space)) . "\n";
				$text = trim(substr($text, $last_space));
			} 
		}		
		$new_text .= $text;
		return $new_text;
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
        $cyr = [
            'а','б','в','г','д','ђ','е','ж','з','и','j','к','л','љ','м','н','њ','о','п',
            'р','с','т','ћ','у','ф','х','ц','ч','џ','ш',
            'А','Б','В','Г','Д','Ђ','Е','Ж','З','И','Ј','К','Л','Љ','М','Н','Њ','О','П',
            'Р','С','Т','Ћ','У','Ф','Х','Ц','Ч','Џ','Ш',''
        ];
        $lat = [
            'a','b','v','g','d','đ','e','ž','z','i','j','k','l','lj','m','n','nj','o','p',
            'r','s','t','ć','u','f','h','c','č','dž','š',
            'A','B','V','G','D','Đ','E','Ž','Z','I','J','K','L','LJ','M','N','NJ','O','P',
            'R','S','T','Ć','U','F','H','C','Č','Dž','Š', ''
        ];
        $input = str_replace($lat, $cyr, $input);
		return $input;
	}

?>