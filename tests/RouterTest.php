<?php
require_once 'src/controllers/DefaultController.php';
require_once 'src/controllers/SecurityController.php';
require_once 'src/controllers/AdminController.php';
require_once 'Routing.php'; 


class RouterTest extends \PHPUnit\Framework\TestCase
{
    public function testGetRoute()
    {
        Router::get('main', 'DefaultController');
        
        $controller = Router::$routes['main'];
        
        $this->assertEquals('DefaultController', $controller);
    }
    
    public function testPostRoute()
    {
        Router::post('login', 'SecurityController');
        
        $controller = Router::$routes['login'];
        
        $this->assertEquals('SecurityController', $controller);
    }
    

}
 


