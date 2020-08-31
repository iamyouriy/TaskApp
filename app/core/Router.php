<?php

namespace app\core;

class Router
{
    public $routes = [];
    protected $parameters = [];

    public function __construct()
        {
            $arrRoutes = require 'app/config/routes.php';
            foreach($arrRoutes as $route => $parameters)
                {
                    $this->add($route, $parameters);
                }
                
              
         
        }

    function add($route, $parameters)
        {
            $route = preg_replace('/{([a-z]+):([^\}]+)}/', '(?P<\1>\2)', $route);
            $varRoute = '#^'.$route.'$#';
            $this->routes[$varRoute] = $parameters;
        }

    function match()
        {
            $currentUrl = trim($_SERVER['REQUEST_URI'], '/');
            foreach ($this->routes as $route => $parameters) 
                {
                    if(preg_match($route, $currentUrl, $matches))
                        {
                            foreach ($matches as $key => $match) 
                                {
                                    if (is_string($key)) 
                                        {
                                            if (is_numeric($match)) 
                                                {
                                                    $match = (int) $match;
                                                }
                                            $parameters[$key] = $match;
                                        }
                                }
                            $this->parameters = $parameters;
                            return true;
                        }
                }
                
            return false;
        }
    
    function run()
        {   
            
            if($this->match())
                {
                    $path = 'app\controllers\\'.ucfirst($this->parameters['controller'].'Controller');
                    
                    if (class_exists($path))
                        {
                            $controller = new $path($this->parameters);
                            $controller->loadPage(); 
                        }
                    else
                        {
                            View::error(404);
                        }
                }
            else
                {
                    View::error(404); 
                }                
        }
    
    
}
