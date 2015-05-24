<?php

namespace Controller;

/**
* Base Controller Class
*/
class S_Base extends S_Controller
{
	public $content;

	public function onInput()
	{

	}

	public function onOutput()
	{
		$page = $this->Template('View/layouts/main_layout.php', ['content' => $this->content]);
		echo $page;
	}
}