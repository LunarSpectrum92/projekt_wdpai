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

        $userRepository = new UserRepository();
        
         $isUser = $userRepository->getObject($email);



         
         
         
         if (!$isUser) {
            return $this->render('login', ['messages' => ['User not found!']]);
        }


        $hashedPassword = $isUser->getPassword();


if($hashedPassword){
        password_verify($password, $hashedPassword);
        $user = $userRepository->getObject($email);
}

     


        if (!password_verify($password, $hashedPassword)) {
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

    



    public function register() {
        $userRepository = new UserRepository();
        
        if (!$this->isPost()) {
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
    
        $messages = [];
    
        if ($password !== $repeat_password) {
            $messages[] = 'Passwords do not match!';
        }
    
        if (strlen($name) > 50 || strlen($surname) > 50 || strlen($city) > 50 || strlen($street) > 50) {
            $messages[] = 'Fields are too long!';
        }
    
        if (!preg_match('/^\d{9}$/', $phone_number)) {
            $messages[] = 'Phone number must be 9 digits!';
        }
    
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $messages[] = 'Invalid email format!';
        }
    
        $passwordPattern = '/^(?=.*[A-Z])(?=.*\d)[A-Za-z\d@$!%*?&]{8,}$/';
        if (!preg_match($passwordPattern, $password)) {
            $messages[] = 'Password must be at least 8 characters long, contain at least one uppercase letter and one digit!';
        }
    
        if (!empty($messages)) {
            return $this->render('register', ['messages' => $messages]);
        }
    
        $user = $userRepository->getObject($email);
    
        if ($user) {
            return $this->render('register', ['messages' => ['An account with this email already exists!']]);
        }
    
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
        try {
            $userRepository->createUser($name, $surname, $email, $hashedPassword, $phone_number, $street, $city);
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/login");
        } catch (Exception $e) {
            return $this->render('register', ['messages' => ['Error during registration: ' . $e->getMessage()]]);
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