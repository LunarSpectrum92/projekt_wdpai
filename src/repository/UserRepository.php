<?php

require_once 'Repository.php';
require_once 'RepositoryInterface.php';

require_once __DIR__.'/../media/User.php';

class UserRepository extends Repository implements RepositoryInterface{
    public function getObject($id) {
        try {
            $stmt = $this->DATABASE->getConnection()->prepare('
                SELECT 
                    u.id AS user_id, 
                    u.name, 
                    u.surname, 
                    u.email, 
                    u.password, 
                    u.role, 
                    ud.phonenumber, 
                    ud.street, 
                    ud.city
                FROM users u
                LEFT JOIN user_details ud ON u.id = ud.user_id
                WHERE u.email = :id
            ');
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);  // Fetching a single row as associative array
    
            if (!$user) {
                return null;
            }
    
            return new User(
                $user["user_id"],
                $user['name'],
                $user['surname'],
                $user['email'],
                $user['password'], 
                $user['phonenumber'],
                $user['street'],
                $user['city'],
                $user['role']
            );
    
        } catch (PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            return null; 
        }
    }

    public function getObjects() {
        try {
            $stmt = $this->DATABASE->getConnection()->prepare('
                SELECT 
                    u.id AS user_id, 
                    u.name, 
                    u.surname, 
                    u.email, 
                    u.password, 
                    u.role, 
                    ud.phonenumber, 
                    ud.street, 
                    ud.city
                FROM users u
                LEFT JOIN user_details ud ON u.id = ud.user_id
            ');
            $stmt->execute();
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $userObj = [];
            foreach ($users as $user) {
                $userObj[] = new User(
                    $user['user_id'],
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
            error_log("Database error: " . $e->getMessage());
            throw new Exception("Failed to retrieve objects.");
        }
    }
    public function createObject($id, $id1){}


    public function getObjectsById($id): array {
        try {
            $stmt = $this->DATABASE->getConnection()->prepare('
                SELECT u.id AS user_id, 
                u.name, 
                u.surname, 
                u.email, 
                u.password, 
                u.role, 
                ud.phonenumber, 
                ud.street, 
                ud.city
                FROM users u
                LEFT JOIN user_details ud ON u.id = ud.user_id
                WHERE role = :id
            ');
            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
            $stmt->execute();
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            $userObj = [];
            foreach ($users as $user) {
                $userObj[] = new User(
                    $user['user_id'],
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
            error_log("Database error: " . $e->getMessage());
            return [];
        }
    }

    public function deleteObject($id) {
        try {
            $user = $this->getObject($id);
            $userId = $user->getId();
    
            if (!$user) {
                return false;
            }
    
            $this->DATABASE->getConnection()->beginTransaction();
            $stmt = $this->DATABASE->getConnection()->prepare('
                DELETE FROM user_details
                WHERE user_id = :id
            ');
            $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
            $stmt->execute();
            
            $stmt = $this->DATABASE->getConnection()->prepare('
                DELETE FROM orders
                WHERE user_id = :userId
            ');
            $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
            $stmt->execute();
    
            
            $stmt = $this->DATABASE->getConnection()->prepare('
                DELETE FROM users
                WHERE id = :id
            ');
            $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
            $stmt->execute();
    
            $this->DATABASE->getConnection()->commit();
    
            return true;
        } catch (PDOException $e) {
            $this->DATABASE->getConnection()->rollBack();
            error_log("Database error: " . $e->getMessage());
            throw new Exception("Failed to delete object.");
        }
    }




    public function createUser($name, $surname, $email, $password, $phonenumber, $street, $city) {
        try {
    
            $stmt = $this->DATABASE->getConnection()->prepare('
                INSERT INTO users(name, surname, email, password)
                VALUES (:name, :surname, :email, :password)
            ');
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':surname', $surname);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);
            $stmt->execute();
    
    
            $stmt = $this->DATABASE->getConnection()->prepare('
                SELECT id
                FROM users
                WHERE email = :email 
            ');
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
            $userId = $user['id'];
            $stmt = $this->DATABASE->getConnection()->prepare(' 
                INSERT INTO user_details(user_id, phonenumber, street, city)
                VALUES (:user_id, :phonenumber, :street, :city)
            ');
            $stmt->bindParam(':user_id', $userId);
            $stmt->bindParam(':phonenumber', $phonenumber);
            $stmt->bindParam(':street', $street);
            $stmt->bindParam(':city', $city);
            $stmt->execute();
    
    
    
        } catch (PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            throw new Exception("Failed to create object.");
        }
    }





    public function changeObject($id, $role) {
        try {
            $user = $this->getObject($id);
            if (!$user) {
                throw new Exception("Object not found.");
            }
    
            $stmt = $this->DATABASE->getConnection()->prepare('
                UPDATE users
                SET role = :role
                WHERE email = :id
            ');
            $stmt->bindParam(':role', $role, PDO::PARAM_STR);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
    return true;
        } catch (PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            throw new Exception("Failed to change object role.");
        }
    }





    public function getUserById($id) {
        try {
            $stmt = $this->DATABASE->getConnection()->prepare('
                SELECT 
                    u.id AS user_id, 
                    u.name, 
                    u.surname, 
                    u.email, 
                    u.password, 
                    u.role, 
                    ud.phonenumber, 
                    ud.street, 
                    ud.city
                FROM users u
                LEFT JOIN user_details ud ON u.id = ud.user_id
                WHERE u.id = :id
            ');
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);  
            if (!$user) {
                return null;
            }
    
            return new User(
                $user["user_id"],
                $user['name'],
                $user['surname'],
                $user['email'],
                $user['password'], 
                $user['phonenumber'],
                $user['street'],
                $user['city'],
                $user['role']
            );
        }catch (PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            throw new Exception("Failed to change object role.");
        }
    }





}

