<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="public/css/adminHeader.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'> 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <title>Document</title>
</head>
<body>

<header class="header">
    <h2 class="logo">LinkLogic</h2>
    <nav>
        <ul class="menu">
            <li>
                <a href="adminUsers">użytkownicy <i class='bx bx-chevron-down'></i></a>
                <ul class="dropdown">
                    <li><a href="adminUsers?filter=client" class="client-link">klieci</a></li>
                    <li><a href="adminUsers?filter=employee" class="employee-link">pracownicy</a></li>
                    <li><a href="adminUsers?filter=admin" class="admin-link">admini</a></li>
                </ul>
            </li>
            <li>
                <a href="adminReservations" class="reservation">rezerwacje <i class='bx bx-chevron-down'></i></a>
                <ul class="dropdown">
                    <li><a href="adminReservations?status=oczekujące na przyjęcie" class="oczekiwanie-link">oczekiwanie</a></li>
                    <li><a href="adminReservations?status=w trakcie realizacji" class="realizacja-link">w trakcie realizacji</a></li>
                    <li><a href="adminReservations?status=wykonane" class="wykonane-link">wykonane</a></li>
                </ul>
            </li>
        </ul>
        <?php 
            if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) {
                echo '<a href="logout"><button class="login">logout</button></a>';
            } else {
                echo '<a href="login"><button class="login">login</button></a>';
            }
        ?>
        <button class="hamburger"> 
            <div class="bar"></div>
        </button>
    </nav>
</header>
<nav class="mobile-nav">
    <nav>
        <ul class="menu">
            <li><a href="adminUsers">uzytkownicy</a></li>
            <li><a href="adminUsers?filter=client" class="client-link">klieci</a></li>
            <li><a href="adminUsers?filter=employee" class="employee-link">pracownicy</a></li>
            <li><a href="adminUsers?filter=admin" class="admin-link">admini</a></li>
            <li><a href="adminReservations" class="reservation">rezerwacje</a></li>
            <li><a href="adminReservations?status=oczekujące na przyjęcie" class="oczekiwanie-link">oczekiwanie</a></li>
            <li><a href="adminReservations?status=w trakcie realizacji" class="realizacja-link">w trakcie realizacji</a></li>
            <li><a href="adminReservations?status=wykonane" class="wykonane-link">wykonane</a></li>
            <?php 
                if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) {
                    echo '<a href="logout"><button class="login">logout</button></a>';
                } else {
                    echo '<a href="login"><button class="login">login</button></a>';
                }
            ?>
        </ul>
    </nav>
</nav>
<script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.13.1/underscore-min.js"></script>
<script src="public/js/hamburgerMenu.js"></script>
<script src="public/js/adminHeader.js"></script>

<script src="public/js/reservationStatus.js"></script>

</body>
</html>
