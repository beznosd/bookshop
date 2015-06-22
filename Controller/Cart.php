<?php

namespace Controller;

/**
* Controller of Cart page
*/

class Cart extends S_Base
{
	public $items = [];
	public $items_count = [];
	public $items_summ = 0;
	public $all_items_count = 0;

	public function onInput()
	{
		parent::onInput();
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

	}

	public function onOutput()
	{
		$this->content = $this->Template('View/pages/cart.php', ['items' => $this->items,
																'items_count' => $this->items_count[0][0], 
																'all_items_count' => $this->all_items_count,
																'items_summ' => $this->items_summ]);
		parent::onOutput();
	}
}