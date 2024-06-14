<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>main</title>

    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:ital,wght@0,400;0,600;0,700;0,900;1,400;1,600;1,700&display=swap" rel="stylesheet" />
    
    <link rel="stylesheet" href="public/css/kontakt.css" />
</head>
<body>
<?php include 'header.php'; ?>

    <main>

        <section class="contact-info" id="contact-info">
            <h2>Informacje <br class="br"></br> Kontaktowe</h2>    
            <div class="container">
                <div class="contact-info-grid">
                    <div class="contact-item">
                        <div class="content">
                            <h3>Adres Biura</h3>
                            <p>ul. Przykładowa 123<br>00-123 Miasto<br>Polska</p>
                        </div>
                    </div>

                    <div class="contact-item">
                        <div class="content">
                            <h3>Telefon</h3>
                            <p>+48 123 456 789</p>
                        </div>
                    </div>

                    <div class="contact-item">
                        <div class="content">
                            <h3>Email</h3>
                            <p><a href="mailto:kontakt@example.com">kontakt@example.com</a></p>
                        </div>
                    </div>

                    <div class="contact-item">
                        <div class="content">
                            <h3>Godziny Otwarcia</h3>
                            <p>Poniedziałek - Piątek: 9:00 - 17:00<br>Sobota: 10:00 - 14:00<br>Niedziela: Zamknięte</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="contact" id="contact">
            <div class="container">
                <h2>Contact</h2>
                
                <form>
                    <div class="form-grid">
                        <input type="text" name="name" id="name" placeholder="Name" class="form-element" />
                        <input type="email" name="email" id="email" placeholder="Email" class="form-element" />
                        <textarea name="message" id="message" placeholder="Messsage" class="form-area"></textarea>
                    </div>
                    <div class="right-align">
                        <input type="submit" value="Send message" class="button" />
                    </div>
                </form>
            </div>
        </section>
    </main>

    <script src="public/js/main.js"></script>

</body>
</html>
