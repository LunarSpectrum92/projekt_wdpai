<?php


require_once 'AppController.php';
require_once 'AccessController.php';
require_once __DIR__.'/../repository/OrderRepository.php';
require_once __DIR__.'/../repository/ServiceRepository.php';
require_once __DIR__.'/../repository/UserRepository.php';
require_once __DIR__.'/../repository/EmployeeOrdersRepository.php';







class DefaultController extends AppController {

    public function main()
    {
        $this->render('main');
    }

    public function ofertatemp()
    {
        $this->render('ofertatemp');
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

    public function myEmployeeOrders()
    {

        if(!$this->isPost()){
            $this->render(AccessController::AccessCheckEmployee('myEmployeeOrders'));
        }
    
        $repoOrder = new OrderRepository;
        $repoUser = new UserRepository;

        $repoEmployeeOrder = new EmployeeOrdersRepository;

  
            if (isset($_POST['done']) && !empty($_POST['done'])) {
                
                $orderId = htmlspecialchars($_POST['done']);
                
                $result = $repoOrder->changeObject($orderId, 'wykonane');
                if($result == true){
                $url = "http://$_SERVER[HTTP_HOST]";
                header("Location: {$url}/myEmployeeOrders");
                }else{
                    $url = "http://$_SERVER[HTTP_HOST]";
                    header("Location: {$url}/adminReservations");
                    echo"<script language='javascript'>
                        alert(nie udało sie zmienic statusu);
                    </script>
                    ";
                }
            }
    }



    

    public function rezerwacje()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] != true) {
            header("Location: /login");
            exit;
        }



        if ($_SESSION['role'] != 'client') {
            header("Location: /main");
            exit;
        }



        $orderRepository = new OrderRepository();
        if (!$this->isPost()) {
        $this->render('rezerwacje');
        }

        if (isset($_POST['Usługi']) && isset($_POST['comments'])) {
            $usługi = $_POST['Usługi'];
            $comments = $_POST['comments'];
    
           
            $order = $orderRepository->createObject($usługi, $comments);
    
            if($order){
                header("Location: /info");

        }else{
            header("Location: /main");

        }
            exit; 
        } else {
           
        }

    }

 



}