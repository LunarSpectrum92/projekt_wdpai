<?php



require_once __DIR__.'/../../Database.php';


class Repository{


    protected $DATABASE;




    public function __construct(){
        $this->DATABASE = Database::getInstance();
    }




}