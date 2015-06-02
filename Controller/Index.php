<?php

namespace Controller;

/**
* Controller of Index page
*/

class Index extends S_Base
{
	public $books = [];
	public $categories;

	public function onInput()
	{
		parent::onInput();
		$this->books = \Model\MySQLi_Query::select($this->db_link, 'SELECT id_book, title, author, cover FROM books', 'assoc');
		$this->categories = \Model\MySQLi_Query::select($this->db_link, 'SELECT DISTINCT category FROM books', 'assoc');
	}

	public function onOutput()
	{
		$this->content = $this->Template('View/pages/index.php', ['books' => $this->books, 'categories' => $this->categories]);
		parent::onOutput();
	}
}