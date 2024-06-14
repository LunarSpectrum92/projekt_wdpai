<?php

require_once 'Repository.php';
require_once 'UserRepository.php';
require_once 'RepositoryInterface.php';
require_once __DIR__.'/../media/Service.php';


class ServiceRepository extends Repository implements RepositoryInterface{




    public function getObjects(): array {
        try {
            $stmt = $this->DATABASE->getConnection()->prepare('SELECT * FROM public.service');
            $stmt->execute();
            $service = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            $serviceObj = [];
            foreach($service as $ser) {
                $serviceObj[] = new Service($ser['id'], $ser['serviceName'], $ser['price']);
            }
    
            return $serviceObj;
        } catch (PDOException $e) {

            return [];
        }
    }




   
    public function getObject($id){
        try {
        $stmt = $this->DATABASE->getConnection()->prepare('
        SELECT * 
        FROM public.service
        WHERE id = :id
        ');
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->execute();
        $service = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        
        foreach($service as $ser) {
            $serviceObj = new Service($ser['id'], $ser['serviceName'], $ser['price']);
        }

        return $serviceObj;
    } catch (PDOException $e) {

        return null;
    }}







    public function getObjectsById($id){}
    public function deleteObject($id){}
    public function createObject($id, $id1){}
    public function changeObject($id, $text){}








}