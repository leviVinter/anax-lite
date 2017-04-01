<?php
$status = $app->url->create("status");
$imagePHP = $app->url->asset("img/php.png");
$imageBootstrap = $app->url->asset("img/bootstrap.png");
?>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-header">
                <h1>Om</h1>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8">
            <p>
                Denna webbplats är skapad som en del av kursen oophp på BTH där
                inriktningen är objektorienterad programmering i PHP.
            </p>
            <p>
                Jag får själv testa på att bygga upp mini-ramverket anax-lite
                från grunden, och jag har koden sparad i mitt egna
                <a href="https://github.com/leviVinter/anax-lite">repo på GitHub.</a>
            </p>
            <p>
                Stylen är skapad med hjälp av Bootstrap, med lite egen css-kod
                ovanpå. Som databas kommer jag använda MySQL.
            </p>
            <p>
                Om du har lust att spela "Gissa numret" så kan du
                <a href="http://www.student.bth.se/~thhe16/dbwebb-kurser/oophp/me/kmom01/guess/">
                    klicka här.
                </a>
            </p>
            <p>
                <a href="<?= $status ?>">Detaljer om systemet.</a>
            </p>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4">
            <img src="<?= $imagePHP ?>" alt="PHP and MySQL" class="img-responsive">
            <img src="<?= $imageBootstrap ?>" alt="Bootstrap" class="img-responsive">
        </div>
    </div>
</div>
