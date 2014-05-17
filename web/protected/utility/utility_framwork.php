<?php

if (!function_exists('getListObject'))
{

	function getListObject($datas, $value, $text)
	{
		$result = array();
		foreach ($datas as $data)
		{
			$result[$data->$value] = $data->$text;
		}

		return $result;
	}

}

if (!function_exists('getListArray'))
{

	function getListArray($datas, $value, $text)
	{
		$result = array();
		foreach ($datas as $data)
		{
			$result[$data[$value]] = $data[$text];
		}

		return $result;
	}

}


if (!function_exists('extractArrayValue'))
{

	function extractArrayValue($arg_input, $key)
	{
		$result = array();
		foreach ($arg_input as $data)
		{
			$result[] = $data[$key];
		}

		return $result;
	}

}

if (!function_exists('extractObjectValue'))
{

	function extractObjectValue($arg_input, $key, $useIndex = true)
	{
		$result = array();
		if (is_array($arg_input))
		{
			foreach ($arg_input as $index => $data)
			{
				if ($data->$key !== null)
					if ($useIndex)
						$result[$index] = $data->$key;
					else
						$result[] = $data->$key;
			}
		}

		return $result;
	}

}

if (!function_exists('extractObjectValues'))
{

	function extractObjectValues($arg_input, $key)
	{
		$result = array();
		foreach ($arg_input as $index => $data)
		{
			foreach ($key as $field)
				$result[$index][$field] = $data->$field;
		}

		return $result;
	}

}

if (!function_exists('convertModelToArray'))
{

	function convertModelToArray($models, $arrField)
	{
		if (!is_array($arrField) || count($arrField) == 0)
			return array();

		$result = array();
		foreach ($models as $model)
		{
			$temp = array();
			foreach ($arrField as $field)
				$temp[$field] = $model->$field;
			$result[] = $temp;
		}

		return $result;
	}

}

if (!function_exists('makeAssocArray'))
{

	function makeAssocArray($arg_input, $arg_key, $with_blank_key = false)
	{
		$result = array();
		if (is_array($arg_input))
			foreach ($arg_input as $val)
				if (is_array($val))
				{
					if (array_key_exists($arg_key, $val))
						$result[$val[$arg_key]] = $val;
					elseif ($with_blank_key)
						$result[''] = $val;
				}
		return $result;
	}

}

if (!function_exists('makeAssocObject'))
{

	function makeAssocObject($arg_input, $arg_key, $with_blank_key = false)
	{
		$result = array();
		if (is_array($arg_input))
			foreach ($arg_input as $val)
				if (is_object($val))
				{
					$result[$val->$arg_key] = $val;
				}
		return $result;
	}

}

if (!function_exists('getRandomNumber'))
{

	function getRandomNumber($length = 8, $full = true)
	{
		$maxNumber = str_pad('', $length, '9', STR_PAD_LEFT);
		$number = rand(1, $maxNumber);
		if ($full)
			$number = str_pad($number, $length, '0', STR_PAD_LEFT);

		return $number;
	}

}

if (!function_exists('getImageUrl'))
{

	function getImageUrl($imageUrl)
	{
		return $imageUrl . '?id=' . getRandomNumber();
	}

}

if (!function_exists('licenseEncode'))
{

	function licenseEncode($data, $mc_key)
	{
		$encrypt = serialize($data);
		$encrypt = time() . $encrypt;
		$iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND);
		$passcrypt = trim(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $mc_key, trim($encrypt), MCRYPT_MODE_ECB, $iv));
		$encode = base64_encode($passcrypt);
		$encode = setStrBase64ToBainisyFormat($encode);
		return $encode;
	}

}

if (!function_exists('licenseDecode'))
{

	function licenseDecode($data, $mc_key)
	{
		$data = setStrBainisyToBase64Format($data);
		$decoded = base64_decode($data);
		$iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND);
		$decrypted = trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $mc_key, trim($decoded), MCRYPT_MODE_ECB, $iv));
		$decrypted = substr($decrypted, 10, strlen($decrypted) - 10);

		$result = @unserialize($decrypted);
		if(!$result)
			$result = array();
		return $result;
	}

}

if (!function_exists('setStrBase64ToBainisyFormat'))
{

	function setStrBase64ToBainisyFormat($str)
	{
		$pattern = getPatternConvert();
		$resultPattern = $pattern['patternEncode'];
		$str = str_split($str);
		$result = array();
		foreach ($str as $value)
		{
			if (!isset($resultPattern[$value]))
				$result[] = $value;
			else
				$result[] = $resultPattern[$value];
		}
		return implode('', $result);
	}

}

if (!function_exists('setStrBainisyToBase64Format'))
{

	function setStrBainisyToBase64Format($str)
	{
		$pattern = getPatternConvert();
		$resultPattern = $pattern['patternDecode'];
		$str = str_split($str);
		$result = array();
		foreach ($str as $value)
		{
			if (!isset($resultPattern[$value]))
				$result[] = $value;
			else
				$result[] = $resultPattern[$value];
		}
		return implode('', $result);
	}

}

if (!function_exists('getPatternConvert'))
{

	function getPatternConvert()
	{
		$patternStr = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$convertPatternStr = 'mnopqrstuvwxyz12345MNOPQRSTUVWXYZABCDEFGHIJKL67890abcdefghijkl';
		$pattern = str_split($patternStr);
		$convertPattern = str_split($convertPatternStr);

		$resultPattern = array();
		foreach ($pattern as $index => $value)
			$resultPattern[$value] = $convertPattern[$index];

		$resultConvertPattern = array();
		foreach ($convertPattern as $index => $value)
			$resultConvertPattern[$value] = $pattern[$index];

		return array('patternEncode' => $resultPattern, 'patternDecode' => $resultConvertPattern);
	}

}

if (!function_exists('copyArrayValue'))
{

	function copyArrayValue(&$arg_input, $arg_keys, $arg_merge_array = array())
	{
		if (is_array($arg_merge_array))
			$arg_output = &$arg_merge_array;
		foreach ($arg_keys as $key)
			if (array_key_exists($key, $arg_input))
				$arg_output[$key] = $arg_input[$key];
		return $arg_output;
	}

}
?>