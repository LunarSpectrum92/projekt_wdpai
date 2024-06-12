<?php

require_once 'config.php';
require_once 'DatabaseInterface.php';





class Database implements DatabaseInterface
{
    private $USERNAME;
    private $PASSWORD;
    private $HOST;
    private $DATABASE;
    protected $connection;


    private static $instance;




    private function __construct() {
        $this->USERNAME = USERNAME;
        $this->PASSWORD = PASSWORD;
        $this->HOST = HOST;
        $this->DATABASE = DATABASE;
        $this->connection = $this->connect();
    }






    private function connect(){
        try{
            $con = new PDO(
                "pgsql:host=$this->HOST;port=5432;dbname=$this->DATABASE",
                $this->USERNAME,
                $this->PASSWORD
            );
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $con;
        }catch(PDOException $e){
            die("connection failed");
        }
    }


    public function getConnection() {
        return $this->connection;
    }




    public static function getInstance(){
        if(!isset(self::$instance)){
            self::$instance = new Database();
        }
        return self::$instance;
    }





}