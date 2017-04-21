<?php
$this->renderView("take1/header", [
    "title" => "Hem",
]);
$this->renderView("navbar2/navbar");
$imageMe = $this->asset("img/thomas.png");
?>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-header">
                <h1>Hem</h1>
            </div>
            <img src="<?= $imageMe ?>" alt="Picture of me" class="img-right">
            <p>
                Hej, mitt namn är Thomas Hedlund och jag studerar
                webbprogrammering på Blekinge Tekniska Högskola.
            </p>
            <p>
                Jag bor för tillfället i Finspång i Östergötland, men växte
                upp i en liten by som heter Vuollerim i Norrbotten. Där hann
                jag utbilda mig till musiklärare och flyttade sedan ner till
                den södra delen av landet när jag fick jobb. Dock har har jag
                insett att det inte är yrket för mig, så jag har påbörjat ett
                nytt äventyr med programmering istället.
            </p>
            <p>
                Förutom programmering gillar jag även emellanåt att spela
                datorspel, spela gitarr, och att läsa böcker om historia och
                dylikt. Jag har även satt ett livsmål att lära mig japanska,
                men det går inte i det allra högsta tempot, men kanske att
                jag om en viss framtid kan åka till Japan och förstå vad folk
                säger.
            </p>
        </div>
    </div>
</div>

<?php
$this->renderView("take1/footer");
?>
