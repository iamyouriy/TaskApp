<?php

namespace app\core;

class View
{
    public $path;
    public $route;
    public $layout = 'default';
    
    public function __construct($route)
        {
           $this->route = $route;
           $this->path = $route['controller'].'/'.$route['controller'];
           
        }

    public function render($title, $vars = [])
        {   
            extract($vars);
            
            if(file_exists('app/view/'.$this->path.'.php'))
                {
                    ob_start();
                    require 'app/view/'.$this->path.'.php';
                    $content = ob_get_clean();
                    require 'app/view/layout/'.$this->layout.'.php';
                }
        }
    
    public static function error($code)
        {
            http_response_code($code);
            require 'app/view/errors/'.$code.'.php';
            exit;
        }
    public function redirect($redirectUrl)
        {
            header('location: '. $redirectUrl);
            exit;
        }
    
    public function message($status, $message = 'null')
        {
            exit(json_encode(['status' => $status, 'message' => $message]));
        }

    public function redirectJs($url)
        {
            exit(json_encode(['url' => $url]));
        }
}