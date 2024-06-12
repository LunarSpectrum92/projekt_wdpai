<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="public/css/style.css">     
    <title>Document</title>
</head>
<body class = "flex_row_center_center">
<div class= "container">
    <p1 class="t" > login </p1>
    

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
    <input type="text" name="name" placeholder="name" required>
    <input type="text" name="surname" placeholder="surname" required>
    <input type="tel" name="phone_number" placeholder="phone number" required>
    <input type="text" name="city" placeholder="city" required>
    <input type="text" name="street" placeholder="street" required>
    <input type="email" name="email" placeholder="email" required>
    <input type="password" name="password" placeholder="password" required>
    <input type="password" name="repeat_password" placeholder="repeat password" required>
    <button type="submit">REGISTER</button>
</form>

    

</div>
</body>
</html>