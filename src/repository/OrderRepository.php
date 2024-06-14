<?php

require_once 'Repository.php';
require_once 'UserRepository.php';
require_once 'RepositoryInterface.php';
require_once __DIR__.'/../media/Order.php';

require_once __DIR__.'/../media/Service.php';


class OrderRepository extends Repository implements RepositoryInterface{



    public function createObject($service_id, $description){
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        try {
            if($_SESSION['role'] == 'client'){
            $userRepository = new UserRepository();
            $user = $userRepository->getObject($_SESSION['userEmail']);
            $userId = $user->getId();
            $status = 'oczekujące na przyjęcie';
            $stmt = $this->DATABASE->getConnection()->prepare('
            INSERT INTO orders(service_id, user_id, description, status) 
            VALUES(:serviceId, :userId, :description, :status)
            ');
            $stmt->bindParam(':serviceId', $service_id);
            $stmt->bindParam(':userId', $userId);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':status', $status);
            $stmt->execute();
            $order = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            return true;
        }
            else{
                echo 'tylko klienci i moga dodawac rezerwacje';
            }
        } catch (PDOException $e) {
            return false;
        }
    }
    


    public function getObjects(): array{
        try {
            $stmt = $this->DATABASE->getConnection()->prepare('
           SELECT *
           FROM orders
            ');
            $stmt->execute();
            $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $orderObj = [];
            foreach ($orders as $order) {
                $orderObj[] = new Order(
                    $order['id'],
                    $order['service_id'],
                    $order['user_id'],
                    $order['description'],
                    $order['status'],
                    $order['date'],
                );
            }
    
            return $orderObj;
    
        } catch (PDOException $e) {
            // Log the exception if necessary
            error_log("Database error: " . $e->getMessage());
            return [];
        }
    }


    public function getObjectsById($id){ 
        try {
        
        $stmt = $this->DATABASE->getConnection()->prepare('
       SELECT *
       FROM orders
       WHERE user_id = :id
        ');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $orderObj = [];
        foreach ($orders as $order) {
            $orderObj[] = new Order(
                $order['id'],
                $order['service_id'],
                $order['user_id'],
                $order['description'],
                $order['status'],
                $order['date'],
            );
        }

        return $orderObj;

    } catch (PDOException $e) {
        error_log("Database error: " . $e->getMessage());
        return [];
    }}






    public function getObject($id){
       try{
        $stmt = $this->DATABASE->getConnection()->prepare('
         SELECT * FROM public.orders WHERE id = :id
         ');
         $stmt->bindParam(':id', $id, PDO::PARAM_STR);
         $stmt->execute();
         $order = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if($order == false){
            return null;
        }

        
         return new Order(
            $order['id'],
            $order['service_id'],
            $order['user_id'],
            $order['description'],
            $order['status'],
            $order['date'],
         ); 
        }catch(PDOException $e){
            echo 'Błąd: ' . $e->getMessage();
            return null;
        }
        
    }








    public function deleteObject($id){
        try {
            $order = $this->getObject($id);
            if (!$order) {
                return false;
            }
            

            $this->DATABASE->getConnection()->beginTransaction();

            $stmt = $this->DATABASE->getConnection()->prepare('
                DELETE FROM orders
                WHERE id = :Id
            ');
            $stmt->bindParam(':Id', $id, PDO::PARAM_INT);
            $stmt->execute();


            $this->DATABASE->getConnection()->commit();
    
            return true;
        } catch (PDOException $e) {
            
            $this->DATABASE->getConnection()->rollBack();
            echo 'Błąd: ' . $e->getMessage();
            return false;
        }



    }
    
    
    
    public function changeObject($id, $status){
        try{
            $order = $this->getObject($id);
            if (!$order) {
                return false;
            }
        $stmt = $this->DATABASE->getConnection()->prepare('
        UPDATE orders
        SET status = :status
        WHERE id = :id
        ');
        $stmt->bindParam(':status', $status, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->execute();
        return true;
        }catch(PDOException $e){
            echo 'Błąd: ' . $e->getMessage();
            return false;
        }
        
    }

}