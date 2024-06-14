<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>main</title>

    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:ital,wght@0,400;0,600;0,700;0,900;1,400;1,600;1,700&display=swap" rel="stylesheet" />
    
    <link rel="stylesheet" href="public/css/MainStyle.css" />
</head>
<body>
<?php include 'header.php'; ?>

    <main>
        <section class="banner">
            <div class="container">
                <h1>
                Innowacyjne rozwiązania <br class="hide-mob" />
                <span>dla cyfrowej</span> przyszłości
                </h1>

                <h3>Kompleksowe usługi IT dla Twojej firmy</h3>

                <a href="#" class="button">dowiedz sie więcej</a>
            </div>
        </section>

        <section id="services" class="services">
            <div class="container">
                <h2>usługi</h2>
                
                <div class="services-grid">
                <?php
        require_once __DIR__.'/../../src/repository/ServiceRepository.php';
        $ServiceRepository = new ServiceRepository();
        $serviceObj = $ServiceRepository->getObjects();
        foreach($serviceObj as $serobj) {
            echo '<div class="service">

            <div class="content">
                <h3>' . $serobj->getserviceName() . '</h3>
                <p>
                Lorem ipsum dolor, sit amet consectetur adipisicing elit.
            </p>
                <a href="#" class="button">zarezerwuj termin</a>

        </div>
    </div>';
        }
        
        ?>
</div>
                </div>
            </div>
        </section>

        <section class="projects" id="projects">
        <h2>Nasi Partnerzy</h2>    
        <div class="container">
                
                
                <div class="projects-grid">
                <div class="project">
    <div class="content">
        <h3>TechNova Solutions</h3>
        <p>TechNova Solutions oferuje zaawansowane rozwiązania chmurowe i IT. Specjalizuje się w zarządzaniu danymi oraz bezpieczeństwie w chmurze.</p>
    </div>
</div>

<div class="project">
    <div class="content">
        <h3>CyberGuardians Inc.</h3>
        <p>CyberGuardians Inc. to lider w bezpieczeństwie cybernetycznym, oferujący ochronę przed cyberatakami oraz audyty bezpieczeństwa IT.</p>
    </div>
</div>

<div class="project">
    <div class="content">
        <h3>DataWave Analytics</h3>
        <p>DataWave Analytics specjalizuje się w analityce danych i big data, dostarczając narzędzia do analizy biznesowej i wizualizacji danych.</p>
    </div>
</div>

<div class="project">
    <div class="content">
        <h3>DevOps Dynamics</h3>
        <p>DevOps Dynamics oferuje rozwiązania w zakresie DevOps, automatyzacji procesów IT i monitorowania aplikacji.</p>
    </div>
</div>

<div class="project">
    <div class="content">
        <h3>QuantumLeap Innovations</h3>
        <p>QuantumLeap Innovations specjalizuje się w sztucznej inteligencji i uczeniu maszynowym, dostarczając innowacyjne rozwiązania AI.</p>
    </div>
</div>

<div class="project">
    <div class="content">
        <h3>NetWorkX Communications</h3>
        <p>NetWorkX Communications zajmuje się rozwiązaniami sieciowymi i telekomunikacyjnymi, oferując projektowanie i zarządzanie sieciami LAN/WAN.</p>
    </div>
</div>

<div class="project">
    <div class="content">
        <h3>SoftWareHouse</h3>
        <p>SoftWareHouse specjalizuje się w tworzeniu oprogramowania na zamówienie, dostarczając rozwiązania dopasowane do potrzeb klientów z różnych sektorów.</p>
    </div>
</div>

<div class="project">
    <div class="content">
        <h3>CloudBridge Services</h3>
        <p>CloudBridge Services oferuje kompleksowe rozwiązania do zarządzania IT w chmurze, specjalizując się w migracji do chmury i zarządzaniu zasobami.</p>
    </div>
</div>

<div class="project">
    <div class="content">
        <h3>InnoTech Labs</h3>
        <p>InnoTech Labs prowadzi badania i rozwój w technologiach IT, w tym IoT, AR, VR i blockchain.</p>
    </div>
</div>

<div class="project">
    <div class="content">
        <h3>GreenIT Solutions</h3>
        <p>GreenIT Solutions zajmuje się ekologicznymi rozwiązaniami IT, redukując ślad węglowy i wspierając zrównoważony rozwój.</p>
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
