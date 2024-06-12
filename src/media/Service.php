<?php



class Service{

    private $serviceId;
    private $serviceName;
    private $priceForHour;



    public function __construct($serviceId, $serviceName, $priceForHour){
        $this->serviceId = $serviceId;
        $this->serviceName = $serviceName;
        $this->priceForHour = $priceForHour;     
    }


    public function getserviceName(){
        return $this->serviceName;
    }
    
    public function getserviceId(){
        return $this->serviceId;
    }



}