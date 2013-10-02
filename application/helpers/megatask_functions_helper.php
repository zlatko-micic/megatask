<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


if ( ! function_exists('filter_data')) {
	function filter_data($value, $striptags = false) {
		if (get_magic_quotes_gpc()) {
			$value = stripslashes($value);
		}
		if ($striptags === true) {
			$value = strip_tags($value);
		}
		return trim(htmlspecialchars($value));
	}
}

if ( ! function_exists('in_multiarray')) {
	function in_multiarray($elem, $array,$field) {
		$top = sizeof($array) - 1;
		$bottom = 0;
		while($bottom <= $top)
		{
			if($array[$bottom][$field] == $elem)
				return true;
			else 
				if(is_array($array[$bottom][$field]))
					if(in_multiarray($elem, ($array[$bottom][$field])))
						return true;

			$bottom++;
		}        
		return false;
	}
}

if ( ! function_exists('checkDateTime')) {
	function checkDateTime( $date ){ 
		if (preg_match("/^(\d{4})-(\d{2})-(\d{2}) ([01][0-9]|2[0-3]):([0-5][0-9]):([0-5][0-9])$/", $date, $matches)) { 
			if (checkdate($matches[2], $matches[3], $matches[1])) { 
				return true; 
			} 
		} 
		return false; 
	}
}

if ( ! function_exists('convertSeconds')) {
	function convertSeconds($time) {
		// time duration in seconds

		$days = floor($time / (60 * 60 * 24));
		$time -= $days * (60 * 60 * 24);

		$hours = floor($time / (60 * 60));
		$time -= $hours * (60 * 60);

		$minutes = floor($time / 60);
		$time -= $minutes * 60;

		$seconds = floor($time);
		$time -= $seconds;
		
		$result = '';
		
		if ($days > 0) {
			$result .= $days.' days ';
		}
		if ($days > 0 && $hours > 0) {
			$result .= $hours.' hours ';
		}
		if ($days > 0 && $hours > 0 && $minutes > 0) {
			$result .= $minutes.' minutes ';
		}
		
		if ($days > 0 && $hours > 0 && $minutes > 0 && $seconds > 0 ) {
			$result .= $seconds.' seconds ';
		}
		
		return $result;
	}
}