<?php

namespace Controller;

/**
* Controller of Cart page
*/

class Order extends S_Base
{
	public $layout;
	public $items = [];
	public $items_count = [];
	public $items_summ = 0;
	public $all_items_count = 0;

	public function onInput()
	{
		parent::onInput();
		if ( isset($this->customer) && !empty($this->customer) ) {
			$this->items = \Model\MySQLi_Query::select($this->db_link, 'SELECT * FROM cart', 'assoc');
			$this->items_count = \Model\MySQLi_Query::select($this->db_link, 'SELECT COUNT(*) FROM cart WHERE sid = \''.SID.'\'', 'array');
			//calculating the price
			$price_count = \Model\MySQLi_Query::select($this->db_link, 'SELECT price, count FROM cart WHERE sid = \''.SID.'\'', 'assoc');
			foreach ($price_count as $key) {
				$this->items_summ += $key['price'] * $key['count']; 
			}
			if ( $this->cart_count[0][0] ) {
				$this->all_items_count = $this->cart_count[0][0];
			}
			$this->layout = 'View/pages/order.php';
		} else {
			$this->layout = 'View/pages/access_denied.php';
		}
	}

	public function onOutput()
	{
		$this->content = $this->Template($this->layout, ['items' => $this->items,
																'items_count' => $this->items_count[0][0], 
																'all_items_count' => $this->all_items_count,
																'items_summ' => $this->items_summ,
																'o_customer' => $this->customer]);
		parent::onOutput();
	}
}