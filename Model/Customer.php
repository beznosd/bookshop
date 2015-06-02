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

	public function setSession($email)
	{
		$sid = session_id();
		$id_customer = \Model\MySQLi_Query::select($this->db_link, 'SELECT id_customer FROM customers WHERE email = \''.$email.'\'', 'assoc');
		$id_customer = $id_customer[0]['id_customer'];
		$time_start = time();
		$time_finish = time() + 60 * 10;
		$admin = \Model\MySQLi_Query::select($this->db_link, 'SELECT admin FROM customers WHERE email = \''.$email.'\'', 'assoc');
		$admin = $admin[0]['admin'];

		$object = [
			'id_customer' => $id_customer,
			'sid' => $sid,
			'time_start' => $time_start,
			'time_finish' => $time_finish,
			'admin' => $admin
		];

		$result = \Model\MySQLi_Query::insert($this->db_link, 'sessions', $object);

		if ( $result != -1 )
			return true;
		return false;
	}

	public function updateSession()
	{
		$sid = session_id();
		$session['time_finish'] = time() + 60 * 10;
		$t = "sid = '%s'";
		$where = sprintf($t, mysqli_real_escape_string($this->db_link, $sid));
		$affected_rows = \Model\MySQLi_Query::update($this->db_link, 'sessions', $session, $where);
	}

	public function clearSession()
	{
		$min = time() - 60 * 10;
    	$t = "time_finish < '%i'";
    	$where = sprintf($t, $min);
    	\Model\MySQLi_Query::delete($this->db_link, 'sessions', $where);
	}

	public function deleteSession()
	{
		$sid = session_id();
		$t = "sid = '%s'";
    	$where = sprintf($t, $sid);
		\Model\MySQLi_Query::delete($this->db_link, 'sessions', $where);
		/*session_unset();
        setcookie(session_name(), session_id(), time()-60*60*24);
        session_destroy();*/
	}

	public function getCustomer($id = null)
	{
		$this->clearSession();

		$sid = session_id();
		$customer_id = \Model\MySQLi_Query::select($this->db_link, 'SELECT id_customer FROM sessions WHERE sid = \''.$sid.'\'', 'assoc');
		if( !empty($customer_id[0]['id_customer']) ) {
			$customer_id = $customer_id[0]['id_customer'];
			$this->updateSession();
			$customer = \Model\MySQLi_Query::select($this->db_link, 'SELECT id_customer, name, surname, email, address, phone, admin
																	 FROM customers WHERE id_customer = \''.$customer_id.'\'', 'assoc');
			return $customer;
		}
		return false;
	}

	/* functions called in profile page */

	public static function profile_change_data()
	{

	}

	public static function profile_change_pass()
	{
		
	}
}