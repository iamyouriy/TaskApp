<?php

namespace app\core;

use app\core\View;
use app\model\Model;

abstract class Controller
{
    public $route;
    public $view;
	public $rule;
	

	public function __construct($route) 
		{
			
			$this->route = $route;
			$this->view = new View($route);
			$this->model = new Model;
		}
	
}


	

	