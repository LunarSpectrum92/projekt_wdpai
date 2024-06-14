<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usługi</title>

    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:ital,wght@0,400;0,600;0,700;0,900;1,400;1,600;1,700&display=swap" rel="stylesheet" />
    
    <link rel="stylesheet" href="public/css/ofertatemp.css" />
</head>
<body>
<?php include 'header.php'; ?>

    <main>
        <section id="services" class="services">
            <div class="container">
                <h2>Nasze Usługi</h2>
                
                <div class="services-grid">
                <?php
                require_once __DIR__.'/../../src/repository/ServiceRepository.php';
                $ServiceRepository = new ServiceRepository();
                $serviceObj = $ServiceRepository->getObjects();
                $colors = ['F6BD60', 'F7EDE2', 'F5CAC3', '84A59D', 'F28482', 'CDB4DB', 'FFC8DD', 'BDE0FE', 'A2D2FF', 'F3722C' ];
                $colorIndex = 0;
                foreach($serviceObj as $serobj) {
                    echo '<div class="service" style="background-color:#' . $colors[$colorIndex] . '">
                    <div class="content">
                        <h3>' . $serobj->getserviceName() . '</h3>
                        <p>
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                        </p>
                        <a href="rezerwacje" class="button">Zarezerwój Termin</a>
                    </div>
                </div>';
                    $colorIndex++;
                    if ($colorIndex >= count($colors)) {
                        $colorIndex = 0; // Reset index if it exceeds the array length
                    }
                }
                ?>
                </div>
            </div>
        </section>
    </main>

    <script src="public/js/temp.js"></script>

</body>
</html>
