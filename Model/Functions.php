<?php

namespace Model;

/**
* Some usefull functions
*/
class Functions
{
	public static function clearData($data, $type = 's')
	{
		switch ($type) {
			case 's':
				return trim(strip_tags($data));
				break;
			case 'i':
				return (int)$data;
				break;
		}
	}
}