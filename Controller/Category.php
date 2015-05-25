<?php

namespace Controller;

/**
* Controller of Index page
*/
class Category extends S_Base
{
	public $in = ['content' => 'Content'];
	public function onInput()
	{
		parent::onInput();
	}

	public function onOutput()
	{
		$this->content = $this->Template('View/pages/index.php', $this->in);
		parent::onOutput();
	}
}