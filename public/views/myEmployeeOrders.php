<!DOCTYPE html>
<?php
   if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="public/css/adminUser.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'> 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <title>Admin Dashboard</title>
      
</head>
<body>

<?php include 'Header.php'; ?>
<main>

    <div class="reservation-container" >
        <div class="search-container">
            <input type="text" class="userSearchInput" placeholder="Szukaj użytkownika">
        </div>
        <?php 
        require_once __DIR__.'/../../src/repository/OrderRepository.php';
        require_once __DIR__.'/../../src/repository/ServiceRepository.php';
        require_once __DIR__.'/../../src/repository/UserRepository.php';
        require_once __DIR__.'/../../src/repository/EmployeeOrdersRepository.php';



        $userRepository = new UserRepository();
        $serviceRepository = new ServiceRepository();
        $orderRepository = new OrderRepository();
        $EmployeeOrdersRepo = new EmployeeOrdersRepository();

        if(isset($_SESSION['userEmail']) && $_SESSION['userEmail'] != ''){
        $id = $userRepository->getUser($_SESSION['userEmail'])->getId();
        $employeeOrders = $EmployeeOrdersRepo->getObjectsById($id);
        }else{
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/main");
        }
        
        ?>

        <?php
        foreach($employeeOrders as $order): 
            
            
            $OrderId = intval($order->getOrderId());
            $UserId = intval($order->getUserId());
            
            $a = $userRepository->getUser($UserId)->getEmail();  //email
            $d = $orderRepository->getObject($OrderId)->getDate();
            $b = $orderRepository->getObject($OrderId)->getDescription(); //opis zamowienia
            $c = $serviceRepository->getObject($orderRepository->getObject($OrderId)->getServiceId())->getserviceName(); //nazwa uslugi 
           
            if($orderRepository->getObject($OrderId)->getStatus() == 'wykonane' || $orderRepository->getObject($OrderId)->getStatus() == 'oczekujące na przyjęcie'){
                continue;
            }; //opis zamowienia

            ?>
        <div class="reservation-card">
            <div class="button-dropDown">
                <button class="toggleButton"><i class='bx bx-chevron-down'></i></button>
            </div>
            <div class="date">
                <p class="ReservationDate">Date: <?php echo htmlspecialchars($d); ?></p>
                <p class="email-address">Adres e_mail: <?php echo htmlspecialchars($a); ?> </p>
            </div>
            <div class="text">
            
            <p>id: <?php echo  htmlspecialchars($order->getId()); ?> </p>
            <p>usługa: <?php echo htmlspecialchars($c); ?> </p>
            <p>opis: <?php echo htmlspecialchars($b); ?></p>
            <p>data: <?php echo htmlspecialchars($d); ?></p>
       
            <div class="buttons">
            <form class="buttons_form"  method="POST">
                <button class="delete"  style="visibility: hidden">Usuń</button>
                <button class="add_employee" name="done" value="<?php echo htmlspecialchars($order->getOrderId()); ?>" type="submit">wykonane</button>

                <button class="add_employee" style="visibility: hidden">wykonane</button>
                
            </form>
            </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

     <script src="public/js/buttonAlerts.js"></script>
    <script src="public/js/displayOrders.js"></script>
    <script src="public/js/search.js"></script>
    <script src="public/js/rezervationStatus.js"></script>
    <script src="public/js/employeeList.js"></script>
    <script src="public/js/userRole.js"></script>




</main>

</body>
</html>
