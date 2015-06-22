<?php

namespace Controller;

/**
* Main Controller for the all sites
*/

class S_Controller
{
	function __construct() {}


	public function request()
	{
		$this->onInput();
		$this->onOutput();
	}

	// Virtual request handler

	public function onInput() {}


	// Virtual HTML generator

	public function onOutput() {}


	public function isGet()
	{
		return $_SERVER['REQUEST_METHOD'] == 'GET';
	}


	public function isPost()
	{
		return $_SERVER['REQUEST_METHOD'] == 'POST';
	}


	// Template Generation

	public function Template($path, $vars = [])
	{
		// Setting up the variables for template
		foreach ($vars as $key => $value) {
			$$key = $value;
		}

		// HTML to String
		ob_start();
		require $path;
		return ob_get_clean();
	}

}