<?php
   if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moje konto</title>
    <link rel="stylesheet" type="text/css" href="public/css/account.css">
</head>
<body>

<?php 
if(isset($_SESSION['userEmail']) && $_SESSION['userEmail'] != ''){
    if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'){
        include 'adminHeader.php';
    } else {
        include 'Header.php';
    }
} else {
    include 'Header.php';
}
?>

<div class="main">
    <div class="container">
        <h1>Moje konto</h1>

        
        <div class="account-info">
        <?php
            $userRepository = new UserRepository();
            $user = $userRepository->getObject($_SESSION['userEmail']);

            echo '<p><strong>Imię:</strong> ' . htmlspecialchars($user->getName()) . ' </p>';
            echo '<p><strong>Nazwisko:</strong> ' . htmlspecialchars($user->getSurname()) . '</p>';
            echo '<p><strong>Email:</strong> ' . htmlspecialchars($user->getEmail()) . '</p>';
            echo '<p><strong>Numer telefonu:</strong> ' . htmlspecialchars($user->getPhoneNumber()) . '</p>';
            echo '<p><strong>Miasto:</strong> ' . htmlspecialchars($user->getCity()) . '</p>';
            echo '<p><strong>Ulica:</strong> ' . htmlspecialchars($user->getStreet()) . '</p>';
            ?>
        </div>
        <form action="logout" method="post">
            <button type="submit" name="log_out">Wyloguj</button>
        </form>
        
        </div>  
    </div>
</body>
</html>