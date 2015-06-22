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
	public $base_template = 'View/layouts/main_layout.php';
	public $admin = false;

	public function onInput()
	{
		\Model\DB_Connection::DBConnect();
		//$this->db_work = new \Model\MySQLi_Query();
		$this->db_link = \Model\DB_Connection::$link;

		//define customer and permissions
		$this->customer = \Model\Customer::Instance($this->db_link)->getCustomer()[0];
		if ($this->customer['admin'] == 1) {
			$this->base_template = 'View/layouts/admin_layout.php';
			$this->admin = true;
		}
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
		$page = $this->Template($this->base_template, ['content' => $this->content, 
																'cart_count' => $this->cart_count[0][0],
																'customer' => $this->customer
																]);
		echo $page;
	}
}