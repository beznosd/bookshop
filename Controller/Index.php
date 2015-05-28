<?php

namespace Controller;

/**
* Controller of Index page
*/

class Index extends S_Base
{
	public $books = [];

	public function onInput()
	{
		parent::onInput();
		$this->books = \Model\MySQLi_Query::select($this->db_link, 'SELECT * FROM books', 'assoc');
	}

	public function onOutput()
	{
		$this->content = $this->Template('View/pages/index.php', ['books' => $this->books]);
		parent::onOutput();
	}
}