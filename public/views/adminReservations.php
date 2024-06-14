<!DOCTYPE html>
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

<?php include 'adminHeader.php'; ?>
<main>

    <div class="reservation-container" >
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

        $orders = $orderRepository->getObjects();
        $users = $userRepository->getObjectsById('employee');

        
        ?>

        <?php
        foreach($orders as $order): 
            $ServiceId = intval($order->getServiceId());
            $UserId = intval($order->getUserId());
            
            $a = $userRepository->getUserById($UserId)->getEmail();
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
            
            <p>id: <?php echo  htmlspecialchars($order->getId()); ?> </p>
            <p>usługa: <?php echo htmlspecialchars($b); ?> </p>
            <p>opis: <?php echo htmlspecialchars($order->getDescription()); ?></p>
            <p class="status">status wykonania: <?php echo htmlspecialchars($order->getStatus()); ?></p>
            <p>data: <?php echo htmlspecialchars($order->getDate()); ?></p>
            <p class="email-address">Adres e_mail: <?php echo htmlspecialchars($a); ?> </p>
       
            <div class="buttons">
            <form class="buttons_form"  method="POST">
                <button class="add_admin" value="<?php echo htmlspecialchars($order->getId()); ?>" name="subbmit_to_execute"  type="button">przekaż do wykonania</button>
                <button class="delete" name="delete" value="<?php echo htmlspecialchars($order->getId()); ?>" type="submit">Usuń</button>
                <button class="add_employee" name="done" value="<?php echo htmlspecialchars($order->getId()); ?>" type="submit">wykonane</button>
            </form>
            </div>
            </div>
        </div>
        <div class="a" style="display: none;">
        <form method="POST">
        <?php foreach($users as $user): ?>
            <button class="users-button" name="users-button" value="<?php echo $order->getId() . " " . $user->getEmail(); ?>">
        <div class="reservation-card" id="a"style="display: none; width: 100%; heigth: 100vh">
            <div class="text-user">
            <p>Imię: <?php echo htmlspecialchars($user->getName()); ?> </p>
            <p>Nazwisko: <?php echo htmlspecialchars($user->getSurname()); ?></p>
            <p>Nr. telefonu: <?php echo htmlspecialchars($user->getPhoneNumber()); ?></p>
            <p>Adres e_mail: <?php echo htmlspecialchars($user->getEmail()); ?></p>
            <p class="role">Rola: <?php echo htmlspecialchars($user->getRole()); ?></p>
            </div>
            </div>
        </button>
       
        <?php endforeach; ?>
        </form>
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
