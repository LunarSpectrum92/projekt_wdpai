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
        require_once __DIR__.'/../../src/repository/UserRepository.php';
        require_once __DIR__.'/../../src/repository/OrderRepository.php';
        require_once __DIR__.'/../../src/repository/EmployeeOrdersRepository.php';
        require_once __DIR__.'/../../src/repository/ServiceRepository.php';


        $userRepository = new UserRepository();
        $orderRepository = new OrderRepository();
        $orderEmployeeRepository = new EmployeeOrdersRepository();
        $ServiceRepository = new ServiceRepository();



        $users = $userRepository->getUsers();


   
        ?>
        <?php foreach($users as $user): 
        $employeeOrders = $orderEmployeeRepository->getObjectsById($user->getId());
        $orders = $orderRepository->getObject($user->getId());

        ?>
        <div class ="abc" style="width: 100%;">
        <div class="reservation-card">
            <div class="button-dropDown">
                <button class="toggleButton"><i class='bx bx-chevron-down'></i></button>
            </div>
            <div class="email">
                <p class="email-address">Adres e_mail: <?php echo htmlspecialchars($user->getEmail()); ?></p>

        </div>
            <div class="text">
            <p>Id: <?php echo htmlspecialchars($user->getId()); ?> </p>

            <p>Imię: <?php echo htmlspecialchars($user->getName()); ?> </p>
            <p>Nazwisko: <?php echo htmlspecialchars($user->getSurname()); ?></p>
            <p>Miasto: <?php echo htmlspecialchars($user->getCity()); ?></p>
            <p>Ulica: <?php echo htmlspecialchars($user->getStreet()); ?></p>
            <p>Nr. telefonu: <?php echo htmlspecialchars($user->getPhoneNumber()); ?></p>
            <p>Adres e_mail: <?php echo htmlspecialchars($user->getEmail()); ?></p>
            <p class="role">Rola: <?php echo htmlspecialchars($user->getRole()); ?></p>

        
            <div class="buttons">
            <form class="buttons_form" method="POST">
                <button class="add_admin" name="add_admin" value="<?php echo htmlspecialchars($user->getEmail()); ?>" type="submit">Dodaj jako admina</button>
                <button class="add_employee" name="add_employee" value="<?php echo htmlspecialchars($user->getEmail()); ?>" type="submit">Dodaj jako pracownika</button>
                <button class="delete" name="delete" value="<?php echo htmlspecialchars($user->getEmail()); ?>" type="submit">Usuń</button>
                <button class="display_employee_orders" style="display: none;">wyswietl zadania pracownika</button>

            </form>
            </div>
            </div>
            
        </div>
        <div class="employee-orders"  style="display: none;">
        <?php foreach($employeeOrders as $order): 
            ?>
            <div class="reservation-card" id="a" style=" background-color: #588157;" >
            <div class="text-order">
            <p>id: <?php echo htmlspecialchars($order->getOrderId()); ?> </p>
            <p>usługa: <?php echo htmlspecialchars($ServiceRepository->getObject($orderRepository->getObject($order->getOrderId())->getServiceId())->getserviceName()); ?></p>
            <p>opis: <?php echo htmlspecialchars($orderRepository->getObject($order->getOrderId())->getDescription()); ?></p>
            <p class="status">status wykonania: <?php echo htmlspecialchars($orderRepository->getObject($order->getOrderId())->getStatus()); ?></p>
            <p >data: <?php echo htmlspecialchars($orderRepository->getObject($order->getOrderId())->getDate()); ?></p>
            </div>
            </div>
        <?php endforeach; ?>
        </div>
        </div>
        <?php endforeach; ?>

    </div>
    <script src="public/js/buttonAlerts.js"></script>
    <script src="public/js/displayUser.js"></script>
    <script src="public/js/search.js"></script>
    <script src="public/js/adminHeader.js"></script>
    <script src="public/js/rezervationStatus.js"></script>
    <script src="public/js/userRole.js"></script>

    



</main>

</body>
</html>
