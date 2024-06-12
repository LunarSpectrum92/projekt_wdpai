<?php


require_once 'AppController.php';
require_once 'AccessController.php';
require_once __DIR__.'/../repository/OrderRepository.php';
require_once __DIR__.'/../repository/ServiceRepository.php';
require_once __DIR__.'/../repository/UserRepository.php';


class AdminController extends AppController{

    public function adminHeader()
    {
        $this->render('adminHeader');
    }


    public function adminDashboard()
    {
        $this->render(AccessController::AccessCheck('adminDashboard'));
    }



















    public function adminReservations()
    {

            
   
            if(!$this->isPost()){
                $this->render(AccessController::AccessCheck('adminReservations'));
                }
        

            
            $repoOrder = new OrderRepository;


            if (isset($_POST['delete']) && !empty($_POST['delete'])) {
                $deleteId = htmlspecialchars($_POST['delete']);
                $success = $repoOrder->deleteObject($deleteId);
    
                if ($success) {
                    $url = "http://$_SERVER[HTTP_HOST]";
                    header("Location: {$url}/adminReservations");
                } else {
                    $url = "http://$_SERVER[HTTP_HOST]";
                    header("Location: {$url}/main");
                }
            }
    
    
    
            if (isset($_POST['subbmit_to_execute']) && !empty($_POST['subbmit_to_execute'])) {
                $orderId = htmlspecialchars($_POST['subbmit_to_execute']);
                $result = $repoOrder->changeObject($orderId, 'w trakcie realizacji');
               

                if($result == true){
                    $url = "http://$_SERVER[HTTP_HOST]";
                    header("Location: {$url}/adminReservations");
                    }else{
                        $url = "http://$_SERVER[HTTP_HOST]";
                        header("Location: {$url}/adminReservations");
                        echo"<script language='javascript'>
                            alert(nie udało sie zmienic statusu);
                        </script>
                        ";
                    }
            }
    
    
    
            if (isset($_POST['done']) && !empty($_POST['done'])) {
                
                $orderId = htmlspecialchars($_POST['done']);
                
                $result = $repoOrder->changeObject($orderId, 'wykonane');
                if($result == true){
                $url = "http://$_SERVER[HTTP_HOST]";
                header("Location: {$url}/adminReservations");
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





    public function adminUsers()
    {


        if(!$this->isPost()){
        $this->render(AccessController::AccessCheck('adminUsers'));
    }


        $repo = new UserRepository;

        if (isset($_POST['delete']) && !empty($_POST['delete'])) {
            $deleteId = htmlspecialchars($_POST['delete']);
            $success = $repo->deleteUser($deleteId);

            if ($success) {
                $url = "http://$_SERVER[HTTP_HOST]";
                header("Location: {$url}/adminUsers");
            } else {
                $url = "http://$_SERVER[HTTP_HOST]";
                header("Location: {$url}/main");
            }
        }



        if (isset($_POST['add_admin']) && !empty($_POST['add_admin'])) {
            
            $adminId = htmlspecialchars($_POST['add_admin']);
            $repo->changeRole($adminId, 'admin');
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/adminUsers");
        }



        if (isset($_POST['add_employee']) && !empty($_POST['add_employee'])) {
            
            $clientId = htmlspecialchars($_POST['add_employee']);
            $repo->changeRole($clientId, 'employee');
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/adminUsers");
        }



    }




    public function adminClients()
    {
        if(!$this->isPost()){
        $this->render(AccessController::AccessCheck('adminUsers'));
        }

        $repo = new UserRepository;

        if (isset($_POST['delete']) && !empty($_POST['delete'])) {
            $deleteId = htmlspecialchars($_POST['delete']);
            $success = $repo->deleteUser($deleteId);

            if ($success) {
                $url = "http://$_SERVER[HTTP_HOST]";
                header("Location: {$url}/adminUsers");
            } else {
                $url = "http://$_SERVER[HTTP_HOST]";
                header("Location: {$url}/main");
            }
        }



        if (isset($_POST['add_admin']) && !empty($_POST['add_admin'])) {
            
            $adminId = htmlspecialchars($_POST['add_admin']);
            $repo->changeRole($adminId, 'admin');
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/adminUsers");
        }



        if (isset($_POST['add_employee']) && !empty($_POST['add_employee'])) {
            
            $clientId = htmlspecialchars($_POST['add_employee']);
            $repo->changeRole($clientId, 'employee');
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/adminUsers");
        }



    }

















}