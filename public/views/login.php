<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="public/css/style.css">    
    <title>Document</title>
</head>
<body class = "flex_row_center_center">
    <div class="main">
<div class= "container">
    <h1 class="t" > login </h1>
    

    <form class = "flex_column_center_center" action="login" method="post"> 
    <div class="messages">
                    <?php
                        if(isset($messages)){
                            foreach($messages as $message) {
                                echo $message;
                            }
                        }
                    ?>
                </div>
        <input type="email" placeholder="email" name="email">
        <input type="password" placeholder="password" name="password">
        <button type="submit" > LOGIN </button>
    </form>
    <p> Nie masz jeszcze konta? <a href="http://localhost:8080/register"> Zarejestruj się </a> </p>  








</div>
</div>
</body>
</html>