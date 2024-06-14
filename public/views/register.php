<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="public/css/register.css">     
    <title>Document</title>
</head>
<body class = "flex_row_center_center">
    <div class="main">
<div class= "container">
    <p1 class="t" > register </p1>
    

    <form class="flex_column_center_center" method="POST">
    <div class="messages">
                    <?php
                        if(isset($messages)){
                            foreach($messages as $message) {
                                echo $message;
                            }
                        }
                    ?>
                </div>
                <input type="text" id="name" name="name" placeholder="name" required>
                <input type="text" id="surname" name="surname" placeholder="surname" required>
                <input type="tel" id="phone_number" name="phone_number" placeholder="phone number" required>
                <input type="text" id="city" name="city" placeholder="city" required>
                <input type="text" id="street" name="street" placeholder="street" required>
                <input type="email" id="email" name="email" placeholder="email" required>
                <input type="password" id="password" name="password" placeholder="password" required>
                <input type="password" id="repeat_password" name="repeat_password" placeholder="repeat password" required>
                <button type="submit">REGISTER</button>
</form>

<script src="public/js/walidacjeLogin.js"></script>


</div>
</div>
</body>
</html>