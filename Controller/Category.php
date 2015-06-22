<?php

namespace Controller;

/**
* Controller of Index page
*/

class Category extends S_Base
{
	public $books = [];
	public $categories;

	public function onInput()
	{
		parent::onInput();
		if ( isset($_GET['category']) ) {
			$category = \Model\Functions::clearData($_GET['category']);
			//$category = $_GET['category'];
			if (!empty($category)) {
				$this->books = \Model\MySQLi_Query::select($this->db_link, 'SELECT id_book, title, author, cover FROM books WHERE category = \''. $category .'\'', 'assoc');
				$this->categories = \Model\MySQLi_Query::select($this->db_link, 'SELECT DISTINCT category FROM books', 'assoc');
			}
		}
	}

	public function onOutput()
	{
		$this->content = $this->Template('View/pages/category.php', ['books' => $this->books, 'categories' => $this->categories]);
		parent::onOutput();
	}
}