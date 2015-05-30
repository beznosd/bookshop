<?php

namespace Model;

class Customer
{
	public static $instance;
	private $db_link;

	function __construct($db_link)
	{
		$this->db_link = $db_link;
	}

	public static function Instance($db_link)
	{
		if ( !(self::$instance instanceof self) )
			self::$instance = new self($db_link);
		return self::$instance;
	}

	public function login()
	{
		
	}
}