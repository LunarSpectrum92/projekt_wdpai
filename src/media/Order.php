<?php


class Order {
    
    private $id;
    private $service_id;
    private $user_id;
    private $description;
    private $status;
    private $date;

    public function __construct($id, $service_id, $user_id, $description, $status, $date) {
        $this->id = $id;
        $this->service_id = $service_id;
        $this->user_id = $user_id;
        $this->description = $description;
        $this->status = $status;
        $this->date = $date;

    }

    public function getId(){
        return $this->id;
    }

    public function getDate(){
        return $this->date;
    }

    public function getServiceId(){
        return $this->service_id;
    }

    public function getUserId(){
        return $this->user_id;
    }

    public function getDescription(){
        return $this->description;
    }

    public function getStatus(){
        return $this->status;
    }
}
