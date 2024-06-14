<?php


class employeeOrders {
    
    private $id;
    private $user_id;
    private $order_id;


    public function __construct($id, $user_id, $order_id) {
        $this->id = $id;
        $this->order_id = $order_id;
        $this->user_id = $user_id;

    }

    public function getId(){
        return $this->id;
    }

    public function getOrderId(){
        return $this->order_id;
    }

    public function getUserId(){
        return $this->user_id;
    }

}
