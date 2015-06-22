<?php

namespace Controller;

/**
* Controller of Profile page
*/
class Profile extends S_Base
{
	private $layout;
	private $p_customer;
	private $data_flag = true;
	private $msg = '';
	private $orders_info;
	private $orders_book_info;
	private $new_orders_count;

	public function onInput()
	{
		parent::onInput();
		if ( isset($this->customer) && !empty($this->customer) ) {
			$this->p_customer = $this->customer;
			// validate necessary data for orders and warn users
			if ( empty($this->p_customer['address']) ) {
				$this->p_customer['address'] = 'Довьте пожалуйста адресс в разделе "Изменить данные"';
				$this->data_flag = false;
			}
			if ( empty($this->p_customer['phone']) ) {
				$this->p_customer['phone'] = 'Довьте пожалуйста телефон в разделе "Изменить	 данные"';
				$this->data_flag = false;
			}

			//User
		
			if ( isset($_GET['menu_point'])  && !$this->admin) {

				$menu_point = \Model\Functions::clearData($_GET['menu_point']);
				if( !empty($menu_point) ) {
					switch ($menu_point) {
						case 'cur_orders':
							$this->orders_info = \Model\MySQLi_Query::select($this->db_link, 
								'SELECT DISTINCT orders.id_order, date, order_summ, state FROM orders WHERE id_customer = \''.$this->customer['id_customer'].'\'', 'assoc');
							$this->orders_book_info = \Model\MySQLi_Query::select($this->db_link, 
								'SELECT orders.id_order, title, count, price FROM orders, book_order, books WHERE id_customer = \''.$this->customer['id_customer'].'\' AND orders.id_order = book_order.id_order AND book_order.id_book = books.id_book', 'assoc');
							$this->layout = 'View/pages/profile_cur_orders.php';
							break;
						case 'old_orders':
							$this->orders_info = \Model\MySQLi_Query::select($this->db_link, 
								'SELECT DISTINCT orders.id_order, date, order_summ, state FROM orders WHERE id_customer = \''.$this->customer['id_customer'].'\'', 'assoc');
							$this->orders_book_info = \Model\MySQLi_Query::select($this->db_link, 
								'SELECT orders.id_order, title, count, price FROM orders, book_order, books WHERE id_customer = \''.$this->customer['id_customer'].'\' AND orders.id_order = book_order.id_order AND book_order.id_book = books.id_book', 'assoc');
							$this->layout = 'View/pages/profile_old_orders.php';
							break;
						case 'change_data':
							if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
								$this->msg = \Model\Customer::profile_change_data($this->customer['id_customer']);
							}
							if ($this->msg == 'success') {
								header("Location: http://localhost/bookshop/?r=site/profile&menu_point=change_data");
								die();
							}
							$this->layout = 'View/pages/profile_change_data.php';
							break;
						case 'change_pass':
							if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
								$this->msg = \Model\Customer::profile_change_pass($this->customer['id_customer']);
							}
							$this->layout = 'View/pages/profile_change_pass.php';
							break;
						default:
							$this->layout = 'View/pages/profile.php';
							break;
					}
				}
				else {
					$this->layout = 'View/pages/profile.php';
				}

			} else {
				$this->layout = 'View/pages/profile.php';
			}

			// Admin
			// for displaying count of new orders on every menu item
			if ($this->admin) {
				$this->new_orders_count = \Model\MySQLi_Query::select($this->db_link, 
								'SELECT COUNT(*) FROM orders WHERE state = \'0\'');
			}

			if ( isset($_GET['menu_point']) && $this->admin ) {

				$menu_point = \Model\Functions::clearData($_GET['menu_point']);
				if( !empty($menu_point) ) {
					switch ($menu_point) {
						case 'new_orders':
							$this->orders_info = \Model\MySQLi_Query::select($this->db_link, 
								'SELECT DISTINCT orders.id_order, date, order_summ, state, name, surname, phone, email FROM orders, customers WHERE state = \'0\' AND orders.id_customer = customers.id_customer', 'assoc');
							$this->orders_book_info = \Model\MySQLi_Query::select($this->db_link, 
								'SELECT orders.id_order, title, count, price FROM orders, book_order, books WHERE state = \'0\' AND orders.id_order = book_order.id_order AND book_order.id_book = books.id_book', 'assoc');
							$this->layout = 'View/pages/a_profile_new_orders.php';
							break;
						case 'cur_orders':
							$this->orders_info = \Model\MySQLi_Query::select($this->db_link, 
								'SELECT DISTINCT orders.id_order, date, order_summ, state, name, surname, phone, email FROM orders, customers WHERE state = \'1\' AND orders.id_customer = customers.id_customer', 'assoc');
							$this->orders_book_info = \Model\MySQLi_Query::select($this->db_link, 
								'SELECT orders.id_order, title, count, price FROM orders, book_order, books WHERE state = \'1\' AND orders.id_order = book_order.id_order AND book_order.id_book = books.id_book', 'assoc');
							$this->layout = 'View/pages/a_profile_cur_orders.php';
							break;
						case 'old_orders':
							$this->orders_info = \Model\MySQLi_Query::select($this->db_link, 
								'SELECT DISTINCT orders.id_order, date, order_summ, state, name, surname, phone, email FROM orders, customers WHERE state = \'2\' AND orders.id_customer = customers.id_customer', 'assoc');
							$this->orders_book_info = \Model\MySQLi_Query::select($this->db_link, 
								'SELECT orders.id_order, title, count, price FROM orders, book_order, books WHERE state = \'2\' AND orders.id_order = book_order.id_order AND book_order.id_book = books.id_book', 'assoc');
							$this->layout = 'View/pages/a_profile_old_orders.php';
							break;
						case 'change_data':
							if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
								$this->msg = \Model\Customer::profile_change_data($this->customer['id_customer']);
							}
							if ($this->msg == 'success') {
								header("Location: http://localhost/bookshop/?r=site/profile&menu_point=change_data");
								die();
							}
							$this->layout = 'View/pages/a_profile_change_data.php';
							break;
						case 'change_pass':
							if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
								$this->msg = \Model\Customer::profile_change_pass($this->customer['id_customer']);
							}
							$this->layout = 'View/pages/a_profile_change_pass.php';
							break;
						default:
							$this->layout = 'View/pages/a_profile.php';
							break;
					}
				} else if(empty($menu_point)) {
					$this->layout = 'View/pages/a_profile.php';
				}	
			}

			if (!isset($_GET['menu_point']) && $this->admin) {
				$this->layout = 'View/pages/a_profile.php';
			}

		} else {
			$this->layout = 'View/pages/access_denied.php';
		}
	}


	public function onOutput()
	{
		$this->content = $this->Template($this->layout, ['p_customer' => $this->p_customer,
														'data_flag' => $this->data_flag,
														'msg' => $this->msg,
														'orders_info' => $this->orders_info,
														'orders_book_info' => $this->orders_book_info,
														'new_orders_count'=> $this->new_orders_count[0][0]]);
		parent::onOutput();
	}
}