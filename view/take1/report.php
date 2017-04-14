<?php
$this->renderView("take1/header", [
    "title" => "Redovisning",
]);
$this->renderView("navbar2/navbar");
?>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-header">
                <h1>Redovisningar</h1>
                <p class="lead">Här samlar jag alla redovisningstexter.</p>
            </div>
            <h3>Kmom01</h3>
            <p><b>Hur känns det att hoppa rakt in i klasser med PHP, gick det bra?</b></p>
            <p>Ja det fick bra. Vi har ju redan fått jobba med klasser i oopython-kursen
            så jag tyckte inte det var några konstigheter. Det enda jag inte har så bra
            koll på är hur man ska jobba med namespaces. I Guess-spelet skrev jag in
            namespaces och fick det att fungera, men jag är inte säker på att jag gjorde
            det på bästa sätt. Det är intressant att man kan använda sig av en autoloader
            som sköter inkluderingen så smidigt.</p>

            <p><b>Berätta om dina reflektioner kring ramverk, anax-lite och din me-sida.</b></p>
            <p>Det var en väldans massa jobb att få klart det där tyckte jag. Men det känns
            som en bra idé att inte använda ett färdigt ramverk som Flask i python, och
            verkligen få se vilken kod som är inblandad när man skriver ett eget ramverk.
            Dock kan jag känna mig lite smått vilsen eftersom vi inte går igenom klasser
            som View, Router, Response o.s.v., men jag kan förstå att det kanske inte är
            så jätteviktigt att ha full koll på det nu på en gång. Jag hoppas att jag i
            slutet av kursen verkligen kan se alla mappar och filer och förstå vad allt är
            till för, eftersom det kändes så otroligt komplicerat med anax-flat i
            design-kursen. Jag skulle förmodligen på eget bevåg gå igenom alla filer och lära
            mig mer, men det känns som ett ganska stort projekt, och tiden känns ganska knapp.
            Men kursen lär nog vara väldigt nyttig.</p>

            <p><b>Gick det bra att komma igång med MySQL, har du liknande erfarenheter sedan
                  tidigare?</b></p>
            <p>Jag har gått igenom grunderna i MySQL förut och känner mig bekväm med vad vi
            hittills har fått testa på. Workbench har jag dock aldrig använt förut, men det
            kan väl inte vara hur svårt som helst om man är bekant med phpmyadmin sen innan.
            I MySQL-uppgiften valde jag att jobba mot “BTHs labbmiljö för MySQL”, eftersom det
            fick mig att känna mig lite mer “pro”. Men att ha bra koll på hur man jobbar med
            en databas är något jag har stort intresse för, så det blir kul att få lära sig
            mer.</p>

            <h3>Kmom02</h3><p>(Kommer uppdateras)</p>
            <h3>Kmom03</h3><p>(Kommer uppdateras)</p>
            <h3>Kmom04</h3><p>(Kommer uppdateras)</p>
            <h3>Kmom05</h3><p>(Kommer uppdateras)</p>
            <h3>Kmom06</h3><p>(Kommer uppdateras)</p>
            <h3>Kmom07-10</h3><p>(Kommer uppdateras)</p>
        </div>
    </div>
</div>
<?php
$this->renderView("take1/footer");
?>
