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
	public $categories;
	public $cart_count;

	public function onInput()
	{
		\Model\DB_Connection::DBConnect();
		//$this->db_work = new \Model\MySQLi_Query();
		$this->db_link = \Model\DB_Connection::$link;

		//get the categories
		$this->categories = \Model\MySQLi_Query::select($this->db_link, 'SELECT DISTINCT category FROM books', 'assoc');
		//get the cart_count
		$this->cart_count = \Model\MySQLi_Query::select($this->db_link, 'SELECT COUNT(*) FROM cart WHERE sid = \''.SID.'\'', 'array');

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
																'categories' => $this->categories,
																'cart_count' => $this->cart_count[0][0]
																]);
		echo $page;
	}
}