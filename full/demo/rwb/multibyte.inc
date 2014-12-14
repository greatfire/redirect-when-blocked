<?php

function mb_convert_encoding_plus($str, $to_encoding, $from_encoding)
{
	$converted = null;
	
	if(!$to_encoding || !$from_encoding) {
		return $str;
	}
	
	if (mb_supports_encoding($from_encoding) &&
		 mb_supports_encoding($to_encoding)) {
		$converted = mb_convert_encoding($str, $to_encoding, $from_encoding);
	}
	
	if(!$converted) {
		$converted = @iconv($from_encoding, $to_encoding . '//TRANSLIT', $str);
	}

	if(!$converted) {
		$converted = iconv($from_encoding, $to_encoding . '//IGNORE', $str);
	}
	
	return $converted;
}

function mb_supports_encoding($encoding)
{
	static $encodings;
	if (! isset($encodings)) {
		$encodings = array();
		foreach (mb_list_encodings() as $e) {
			$encodings[] = strtolower($e);
		}
		
		// Not in list but also supported.
		$encodings[] = 'gbk';
	}
	
	$encoding = strtolower($encoding);
	
	if (in_array($encoding, $encodings)) {
		return true;
	}
}

function utf8_encode_current_charset($str) {
	// TODO: get from headers_list().
	
	if(preg_match('/charset=([^\'"]+)/', $str, $match)) {
		$str = mb_convert_encoding_plus($str, 'UTF-8', $match[1]);
	}
	
	return $str;
}