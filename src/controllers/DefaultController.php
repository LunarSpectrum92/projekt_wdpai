<?php


require_once 'AppController.php';
require_once 'AccessController.php';
require_once __DIR__.'/../repository/OrderRepository.php';
require_once __DIR__.'/../repository/ServiceRepository.php';
require_once __DIR__.'/../repository/UserRepository.php';






class DefaultController extends AppController {

    public function main()
    {
        $this->render('main');
    }
    
    public function oferta()
    {
        $this->render('oferta');
    }
    
    public function kontakt()
    {
        $this->render('kontakt');
    }


    public function info()
    {
        $this->render('info');
    }


    public function adminHeadertemp()
    {
        $this->render('adminHeadertemp');
    }

    public function myReservations()
    {
        $this->render('myReservations');
    }


    
    

    public function rezerwacje()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] != true) {
            // Redirect to login page or handle unauthorized access
            // Replace 'login' with the actual login page route
            header("Location: /login");
            exit;
        }



        $orderRepository = new OrderRepository();
        if (!$this->isPost()) {
        $this->render('rezerwacje');
        }

        if (isset($_POST['Usługi']) && isset($_POST['comments'])) {
            $usługi = $_POST['Usługi'];
            $comments = $_POST['comments'];
    
           
            $order = $orderRepository->createOrder($usługi, $comments);
    
            if($order){
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/info");
        }else{
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/main");
        }
            exit; // Ensure no further code is executed after header redirection
        } else {
           
        }

    }

 



}