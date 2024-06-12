<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'> 
    <link rel="stylesheet"href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" type="text/css" href="public/css/main.css">  
    <link rel="stylesheet" type="text/css" href="public/css/rezerwacje.css">  
    <link rel="stylesheet" type="text/css" href="public/css/style_main.css">

    <title>Document</title>
</head>
<body>
<?php include 'header.php'; ?>


<div class="main-text">

    <div class="container_form">
        <p1 class="t" > Rezerwacja </p1>
        <form class="flex_column_center_center" method="POST"> 
    <select placeholder="typ usługi" name="Usługi" id="services">
        <option disabled selected hidden>Typ usługi</option>
        <?php
        require_once __DIR__.'/../../src/repository/OrderRepository.php';
        $orderRepository = new OrderRepository();
        $serviceObj = $orderRepository->getService();
        foreach($serviceObj as $serobj) {
            echo '<option value="' . $serobj->getserviceId() . '">' . $serobj->getserviceName() . '</option>';
        }
        ?>
    </select>
    <textarea name="comments" placeholder="opis usługi"></textarea>
    
    <button type="submit">Kontynuuj</button>
</form>
    </div>
</div>

</body>
</html>
