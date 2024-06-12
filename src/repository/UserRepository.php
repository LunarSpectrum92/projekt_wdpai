<?php

require_once 'Repository.php';
require_once __DIR__.'/../media/User.php';



class UserRepository extends Repository{




    
    public function getUser($id): ?User{
        if(gettype($id) == 'string'){ 
        $stmt = $this->DATABASE->getConnection()->prepare('
         SELECT * FROM public.users WHERE email = :id
         ');
         $stmt->bindParam(':id', $id, PDO::PARAM_STR);
         $stmt->execute();
         $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if($user == false){
            return null;
        }

        
         return new User(
            $user['id'],
            $user['name'],
            $user['surname'],
            $user['email'],
            $user['password'],
            $user['phonenumber'],
            $user['street'],
            $user['city'],
            $user['role']
         ); 
        }else{
        $stmt = $this->DATABASE->getConnection()->prepare('
         SELECT * FROM public.users WHERE id = :id
         ');
         $stmt->bindParam(':id', $id, PDO::PARAM_STR);
         $stmt->execute();
         $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if($user == false){
            return null;
        }

        
         return new User(
            $user['id'],
            $user['name'],
            $user['surname'],
            $user['email'],
            $user['password'],
            $user['phonenumber'],
            $user['street'],
            $user['city'],
            $user['role']
         ); 
        }
    }


    public function getUsers(): array {
        try {
            $stmt = $this->DATABASE->getConnection()->prepare('SELECT * FROM public.users');
            $stmt->execute();
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            $userObj = [];
            foreach ($users as $user) {
                $userObj[] = new User(
                    $user['id'],
                    $user['name'],
                    $user['surname'],
                    $user['email'],
                    $user['password'],
                    $user['phonenumber'],
                    $user['street'],
                    $user['city'],
                    $user['role']
                );
            }
    
            return $userObj;
    
        } catch (PDOException $e) {
            // Log the exception if necessary
            error_log("Database error: " . $e->getMessage());
            return [];
        }
    }




    public function createUser($name, $surname, $email, $password, $phonenumber, $street, $city){
        try {
        $stmt = $this->DATABASE->getConnection()->prepare('
        INSERT INTO users(name, surname, email, password, phonenumber, street, city)
        VALUES (:name, :surname, :email, :password, :phonenumber, :street, :city)
        ');
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':surname', $surname);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':phonenumber', $phonenumber);
        $stmt->bindParam(':street', $street);
        $stmt->bindParam(':city', $city);
        $stmt->execute();
    } catch (PDOException $e) {
        // Obsługa błędów związanych z bazą danych
        echo 'Błąd: ' . $e->getMessage();
    }


    }






    public function deleteUser($email) {
        try {
            // Pobierz użytkownika
            $user = $this->getUser($email);
            $userId = $user->getId();
            if (!$user) {
                return false;
            }else if($userId == 55){

                return true;
            }
            

            $this->DATABASE->getConnection()->beginTransaction();

            $stmt = $this->DATABASE->getConnection()->prepare('
                DELETE FROM orders
                WHERE user_id = :userId
            ');
            $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
            $stmt->execute();

            $stmt = $this->DATABASE->getConnection()->prepare('
                DELETE FROM users
                WHERE email = :email
            ');
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();
    

            $this->DATABASE->getConnection()->commit();
    
            return true;
        } catch (PDOException $e) {
            
            $this->DATABASE->getConnection()->rollBack();
            echo 'Błąd: ' . $e->getMessage();
            return false;
        }
    }
    


    
    
    
    public function changeRole(string $email, string $role) {
        $client ='client';

        $user = $this->getUser($email);
        if($user->getRole() == 'client'){
        $stmt = $this->DATABASE->getConnection()->prepare('
        UPDATE users
        SET role = :admin
        WHERE email = :email
        ');
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':admin', $role, PDO::PARAM_STR);
        $stmt->execute();
        }else if($user->getRole() == 'admin' || $user->getRole() == 'employee'){
            $stmt = $this->DATABASE->getConnection()->prepare('
        UPDATE users
        SET role = :client
        WHERE email = :email
        ');
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':client', $client, PDO::PARAM_STR);
        $stmt->execute();
        }else{
            die();
        }
        
   }




}