<?php

namespace Controller;

/**
* Controller of Cart page
*/

class Single extends S_Base
{
	public $categories;
	public $book = [];

	public function onInput()
	{
		parent::onInput();
		if( isset($_GET['id_book']) ){
			$id_book = mysqli_real_escape_string($this->db_link, \Model\Functions::clearData($_GET['id_book']));
			$this->book = \Model\MySQLi_Query::select($this->db_link, 'SELECT * FROM books WHERE id_book = \''. $id_book .'\'', 'assoc');
		}
		$this->categories = \Model\MySQLi_Query::select($this->db_link, 'SELECT DISTINCT category FROM books', 'assoc');
	}

	public function onOutput()
	{
		$this->content = $this->Template('View/pages/single.php', ['categories' => $this->categories, 'book' => $this->book[0]]);
		parent::onOutput();
	}
}