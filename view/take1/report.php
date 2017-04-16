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

            <h3>Kmom02</h3>
            <p><b>Hur känns det att skriva kod utanför och inuti ramverket, ser du fördelar
                och nackdelar med de olika sätten?</b></p>
            <p>Att injektera objekt in i $app tycker jag är en smidig lösning om man vill komma
                åt dem på olika ställen i sin kod. Men jag måste erkänna att jag hittills inte
                riktigt känner att Navbar-klassen är till så himla stor nytta. Jag tycker det
                känns lite opraktiskt att göra en klass av den och implementera den i appen, men
                det kan bero på att jag inte utnyttjar den till någon vidare hög grad. Det finns
                förmodligen ett sätt att strukturera sin kod för att få mer nytta av den.
                Session-klassen däremot ser jag stora fördelar med att skriva in i ramverket då
                den till skillnad från navbaren lär vara användbar i fler än en vy. Med erfarenhet
                så skapar man sig nog en smak för när något bör skrivas utanför eller innanför
                ramverket.</p>
            <p><b>Hur väljer du att organisera dina vyer?</b></p>
            <p>Just nu har jag gjort det ganska simpelt. Headern, navbaren och footern inkluderas
                med hjälp av $this->renderView() i varje vy som använder dem, men det känns som
                ett icke-DRY sätt att skriva på. Det skrevs i en övning om hur man kan organisera
                koden i en layout-stil och rendera vyer i regioner, vilket möjligtvis kan vara något
                jag borde titta närmare på. Men jag valde mitt nuvarande sätt eftersom det påminner
                om hur jag skrev koden i Flask/Jinja, vilket är bekvämt men kanske inte helt
                optimalt.</p>
            <p><b>Berätta om hur du löste integreringen av klassen Session.</b></p>
            <p>Klassen Session injekterar jag i $app i index.php, och jag startar även igång den där
                eftersom koden annars blev så stökig med alla “$app->session->start()” i de olika
                routerna. Jag skapade två nya metoder för klassen förutom de grundläggande. En är
                “updateInteger()” som antingen adderar eller subtraherar en value i $_SESSION med
                ett. Den andra metoden är “status()”som  returnerar information för status-routen.
                I varje route så anropas $app->session vilket känns smidigt.</p>
            <p><b>Berätta om hur du löste uppgiften Tärningsspelet 100/Månadskalendern, hur du
                tänkte, planerade och utförde uppgiften samt hur du organiserade din kod?</b></p>
            <p>Jag skrev en månadskalender och använder mig enbart av en klass, Calendar, som jag
                initierar i vyn calendar.php. I klassen Calendar har jag en metod som skriver ut all
                html-kod för kalendern. I konstruktorn avgörs vilken månad som ska visas upp beroende
                på vilka parametrar som skickas in. En metod “setImages()” används för att skicka in
                url:er för bilderna för varje månad och sparas i en array. Kalendern skapas som en
                table med hjälp av metoden “getCalendar()”, och med hjälp av funktionerna date(),
                strtotime(), mktime() så får jag tag i all information om de olika datumen. Allt
                eftersom html-koden skapas kallas olika privata metoder i klassen. När man byter
                månad så skickas kalenderns nuvarande datum i en query-sträng till en av två routes
                som antingen adderar eller subtraherar datumet med en månad. Detta nya datum sparas
                sedan i $_SESSION med hjälp av $app->session->set(), och man redirectas tillbaka till
                den ursprungliga kalender-routen. Där hämtas och raderas värdet i session för att
                initiera ett nytt Calendar-objekt.</p>
            <p><b>Några tankar kring SQL så här långt?</b></p>
            <p>Har inte varit några konstigheter hittills efter att ha gjort 10 av uppgifterna. Jag
                kan dock tycka att referensmanualen är besvärlig att leta upp information i. Jag har
                hittills letat upp all information där, men det kliar ofta i fingrarna efter att bara
                googla upp hur något används. Men kanske att jag tvingar mig att använda manualen
                kommer betala för sig i framtiden. Jag är inte van vid att använda funktioner eller
                operatorer som + och -, så det är lite nytt för mig vilket är intressant.</p>
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
