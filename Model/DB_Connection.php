<?php

namespace Model;

class DB_Connection
{
	const DB_HOST = 'localhost';
	const DB_LOGIN = 'root';
	const DB_PASSWORD = 'beznos22';
	const DB_NAME = 'bookshop'; 

	public static $instance;
	public static $link;

	function __construct(){}
	
	public static function Instance()
	{
		if ( !(self::$instance instanceof self) )
			self::$instance = new self();
		return self::$instance;
	}

	public static function DBConnect()
	{
		self::$link = mysqli_connect(self::DB_HOST, self::DB_LOGIN, self::DB_PASSWORD, self::DB_NAME) or die('No connection with database');
		mysqli_set_charset(self::$link, 'utf8');
	}
}