<?php
require_once 'src/controllers/AppController.php';
require_once 'Routing.php';







$controller = new AppController();

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url( $path, PHP_URL_PATH);
Router::get('', 'DefaultController');
Router::get('oferta', 'DefaultController');
Router::get('main', 'DefaultController');
Router::get('kontakt', 'DefaultController');
Router::get('rezerwacje', 'DefaultController');
Router::get('adminHeadertemp', 'DefaultController');
Router::get('myReservations', 'DefaultController');
Router::get('info', 'DefaultController');
Router::get('adminDashboard', 'AdminController');
Router::get('adminUsers', 'AdminController');
Router::get('adminClients', 'AdminController');
Router::get('adminAdmins', 'AdminController');
Router::get('adminEmployees', 'AdminController');
Router::get('myEmployeeOrders', 'DefaultController');
Router::get('ofertatemp', 'DefaultController');
Router::get('adminReservations', 'AdminController');
Router::get('adminHeader', 'AdminController');
Router::post('login', 'SecurityController');
Router::post('register', 'SecurityController');
Router::post('logout', 'SecurityController');



Router::run($path);

