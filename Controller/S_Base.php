<?php

namespace Controller;

/**
* Base Controller Class
*/
class S_Base extends S_Controller
{
	//to keep dinamic site content
	public $content;
	//to work with DB
	public $db_link;
	//for main template
	public $cart_count;
	public $customer;

	public function onInput()
	{
		\Model\DB_Connection::DBConnect();
		//$this->db_work = new \Model\MySQLi_Query();
		$this->db_link = \Model\DB_Connection::$link;

		//define customer and permissions
		$this->customer = \Model\Customer::Instance($this->db_link)->getCustomer();
		//get the cart_count
		$this->cart_count = \Model\MySQLi_Query::select($this->db_link, 'SELECT SUM(count) FROM cart WHERE sid = \''.SID.'\'', 'array');

		//handling the ajax
		if ( isset($_GET['action']) ) {
			new \Model\AjaxHandler($_GET['action'], $this->db_link);
		} else if ( $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
			new \Model\AjaxHandler($_POST['action'], $this->db_link);
		}
	}

	public function onOutput()
	{
		$page = $this->Template('View/layouts/main_layout.php', ['content' => $this->content, 
																'cart_count' => $this->cart_count[0][0],
																'customer' => $this->customer[0]
																]);
		echo $page;
	}
}