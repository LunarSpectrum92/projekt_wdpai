<?php


require_once 'AppController.php';
require_once __DIR__ .'/../media/User.php';
require_once __DIR__.'/../repository/UserRepository.php';


class SecurityController extends AppController{





    public function login()
    {
        $userRepository = new UserRepository();
        if (!$this->isPost()) {
            return $this->render('login');
        }
        


        $email = $_POST['email'];
        $password = $_POST['password'];

        
        $user = $userRepository->getUser($email);


        if (!$user) {
            return $this->render('login', ['messages' => ['User not found!']]);
        }
        if ($user->getPassword() !== $password) {
            return $this->render('login', ['messages' => ['Wrong password!']]);
        }


        session_start();
        $_SESSION['role'] = $user->getRole();
        $_SESSION['userEmail'] = $user->getEmail();
        $_SESSION['loggedIn'] = true;
        
        if($user->getRole() == 'client'){
        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/main");
        }elseif($user->getRole() == 'admin'){
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/adminDashboard"); 
        }elseif($user->getRole() == 'employee'){
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/main");
        }

    }

    




    public function register(){
       
        $userRepository = new UserRepository();
        if(!$this->isPost()){
        $this->render('register');
        }
   
        $name = $_POST['name'] ?? null;
        $surname = $_POST['surname'] ?? null;
        $phone_number = $_POST['phone_number'] ?? null;
        $city = $_POST['city'] ?? null;
        $street = $_POST['street'] ?? null;
        $email = $_POST['email'] ?? null;
        $password = $_POST['password'] ?? null;
        $repeat_password = $_POST['repeat_password'] ?? null;

        if ($password !== $repeat_password) {
            return $this->render('register', ['messages' => ['hasła nie sa zgodne!']]);
        }


        if (empty($name) || empty($surname) || empty($email) || empty($password) || empty($phone_number) || empty($street) || empty($city)) {
           return ;
        }

        $user = $userRepository->getUser($email);

        if($user){
            return $this->render('register', ['messages' => ['jest juz konto zarejestrowane na podany email!']]);
        }




        try {
            $userRepository->createUser($name, $surname, $email, $password, $phone_number, $street, $city);
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/login");
        } catch (Exception $e) {
            return $this->render('register', ['messages' => ['bład podczas rejestracji']]) . $e->getMessage();
        }


    }

    public function logout(){
        


        if(!$this->isPost()){
            return $this->render('logout');
        }

        
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if(isset($_POST['log_out'])){
            session_unset();
            session_destroy();
        }


        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/main");

    }
   
}