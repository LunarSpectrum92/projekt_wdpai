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
    <link rel="stylesheet" type="text/css" href="public/css/myReservations.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'> 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <title>Admin Dashboard</title>
      
</head>
<body>

<?php include 'header.php'; ?>
<main>

    <div class="reservation-container">
        <div class="search-container">
            <input type="text" class="userSearchInput" placeholder="Szukaj użytkownika">
        </div>
        <?php 
        require_once __DIR__.'/../../src/repository/OrderRepository.php';
        require_once __DIR__.'/../../src/repository/ServiceRepository.php';
        require_once __DIR__.'/../../src/repository/UserRepository.php';


        $userRepository = new UserRepository();
        $serviceRepository = new ServiceRepository();
        $orderRepository = new OrderRepository();

        $orders = $orderRepository->getObjectsById($userRepository->getUser($_SESSION['userEmail'])->getId());

        ?>

        <?php
        foreach($orders as $order): 
            
            $ServiceId = intval($order->getServiceId());
            $UserId = intval($order->getUserId());
            
            $a = $userRepository->getUser($UserId)->getEmail();
            $b = $serviceRepository->getObject($ServiceId)->getserviceName();

            ?>

        <div class="reservation-card">
            <div class="button-dropDown">
                <button class="toggleButton"><i class='bx bx-chevron-down'></i></button>
            </div>
            <div class="date">
                <p class="ReservationDate">Date: <?php echo htmlspecialchars($order->getDate()); ?></p>
                <p class="email-address">Adres e_mail: <?php echo htmlspecialchars($a); ?> </p>
            </div>
            <div class="text">
            
            
            <p>usługa: <?php echo htmlspecialchars($b); ?> </p>
            <p>opis: <?php echo htmlspecialchars($order->getDescription()); ?></p>
            <p class="status">status wykonania: <?php echo htmlspecialchars($order->getStatus()); ?></p>
            <p>data: <?php echo htmlspecialchars($order->getDate()); ?></p>
       
        </div>
            
        </div>
        <?php endforeach; ?>

    </div>

     <script src="public/js/buttonAlerts.js"></script>
    <script src="public/js/displayOrders.js"></script>
    <script src="public/js/search.js"></script>
    <script src="public/js/rezervationStatus.js"></script>


</main>

</body>
</html>
