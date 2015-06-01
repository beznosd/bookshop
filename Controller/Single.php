<?php

namespace Controller;

/**
* Controller of Cart page
*/

class Single extends S_Base
{
	public $categories;

	public function onInput()
	{
		parent::onInput();
		$this->categories = \Model\MySQLi_Query::select($this->db_link, 'SELECT DISTINCT category FROM books', 'assoc');
	}

	public function onOutput()
	{
		$this->content = $this->Template('View/pages/single.php', ['categories' => $this->categories]);
		parent::onOutput();
	}
}