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
            <li><a href="main">home</a></li>
            <li><a href="oferta">oferta</a></li>
            <li><?php 
            if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) {
                if($_SESSION['role'] == 'client'){
                echo '<a href="rezerwacje">rezerwacja</a>';
                }
            } else {
                echo '<a href="login">rezerwacje</a>';
            }
        ?></li>
            <li><a href="kontakt">kontakt</a> </li>
            
            <li>
                <?php 
            $repo = new UserRepository();
            if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true && $repo->getObject($_SESSION['userEmail'])->getRole() == 'client') {
                echo '<a href="myReservations">Rezerwacje</a>';
            } else if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true && $repo->getObject($_SESSION['userEmail'])->getRole() == 'employee'){
                echo '<a href="myEmployeeOrders">zadania</a>';
            }
            ?>
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
            <li><a href="main">home</a></li>
            <li><a href="oferta">oferta</a></li>
            <li><?php 
            if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) {
                echo '<a href="rezerwacje">rezerwacja</a>';
            } else {
                echo '<a href="login">rezerwacje</a>';
            }
        ?></li>
            <li><a href="kontakt">kontakt</a> </li>
            
            <li>
                <?php 
            if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true && $repo->getObject($_SESSION['userEmail'])->getRole() == 'client') {
                echo '<a href="myReservations">Rezerwacje</a>';
            } else if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true && $repo->getObject($_SESSION['userEmail'])->getRole() == 'employee'){
                echo '<a href="login">zadania</a>';
            }
            ?>
            </li>
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
</body>
</html>