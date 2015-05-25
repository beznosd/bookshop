<?php

namespace Controller;

/**
* Base Controller Class
*/
class S_Base extends S_Controller
{
	public $content;
	public $db_work;

	public function onInput()
	{
		\Model\DB_Connection::DBConnect();
		$this->db_work = new \Model\MySQLi_Query();
	}

	public function onOutput()
	{
		$page = $this->Template('View/layouts/main_layout.php', ['content' => $this->content]);
		echo $page;
	}
}