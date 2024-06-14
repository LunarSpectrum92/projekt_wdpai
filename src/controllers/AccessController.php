<?php


require_once 'AppController.php';



class AccessController extends AppController{


    public static function AccessCheck($pathName){
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }


        if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'){
            return ($pathName);
        }    


        return 'main';

    }




    
    public static function AccessCheckEmployee($pathName){
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }


        if(isset($_SESSION['role']) && $_SESSION['role'] == 'employee'){
            return ($pathName);
        }    


        return 'main';

    }






}