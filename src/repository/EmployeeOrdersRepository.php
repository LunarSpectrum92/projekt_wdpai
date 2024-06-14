<?php

require_once 'Repository.php';
require_once 'UserRepository.php';
require_once 'RepositoryInterface.php';
require_once __DIR__.'/../media/Order.php';
require_once __DIR__.'/../media/Service.php';
require_once __DIR__.'/../media/employeeOrders.php';



class EmployeeOrdersRepository extends Repository implements RepositoryInterface{





    public function getObjects(): array{
        try {
            $stmt = $this->DATABASE->getConnection()->prepare('
           SELECT *
           FROM employee_orders
            ');
            $stmt->execute();
            $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $orderObj = [];
            foreach ($orders as $order) {
                $orderObj[] = new EmployeeOrders(
                    $order['id'],
                    $order['user_id'],
                    $order['order_id'],
                );
            }
    
            return $orderObj;
    
        } catch (PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            return [];
        }
    }
    public function getObjectsById($id){
        try {
            $stmt = $this->DATABASE->getConnection()->prepare('
           SELECT *
           FROM employee_orders
           WHERE user_id = :id
            ');
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);

            $stmt->execute();
            $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $orderObj = [];
            foreach ($orders as $order) {
                $orderObj[] = new EmployeeOrders(
                    $order['id'],
                    $order['user_id'],
                    $order['order_id'],
                );
            }
    
            return $orderObj;
    
        } catch (PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            return [];
        }
    }
    public function getObject($id){  
        try {
        $stmt = $this->DATABASE->getConnection()->prepare('
       SELECT *
       FROM employee_orders
       WHERE order_id = :id
        ');
    $stmt->bindParam(':id', $id, PDO::PARAM_STR);

        $stmt->execute();
        $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $orderObj = [];
        foreach ($orders as $order) {
            $orderObj[] = new EmployeeOrders(
                $order['id'],
                $order['user_id'],
                $order['order_id'],
            );
        }
        if($orderObj != []){
            return true;
        }else{
            return false;
        }
        

    } catch (PDOException $e) {
        error_log("Database error: " . $e->getMessage());
        return [];
    }  }
    public function deleteObject($id){}
    
    
    
    public function createObject($userId, $orderId){
        try {
            $stmt = $this->DATABASE->getConnection()->prepare('
            INSERT INTO employee_orders(user_id, order_id) 
            VALUES(:user_id, :order_id)
            ');
            $stmt->bindParam(':user_id', $userId);
            $stmt->bindParam(':order_id', $orderId);
            $stmt->execute();
            $order = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            return $order;
        } catch (PDOException $e) {
            return false;
        }
    }   




    public function changeObject($id, $status){}
}