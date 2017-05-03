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
            <h3>Kmom03</h3>
            <p><b>Hur kändes det att jobba med PHP PDO, SQL och MySQL?</b></p>
            <p>Jag är bekant med PDO och MySQL sedan tidigare så det tyckte jag inte var några
                konstigheter med. Det handlade nog mer om att påminna mig om hur man skrev allting
                igen. Jag gillar hur PDO fungerar, det gör kommunikationen med databasen mycket enkel,
                och man slipper tänka på potentiell SQL-injektion. Att skriva MySQL-kod är någonting
                jag gärna skulle vilja lära mig mer om. Det blir tydligt i uppgiften “Kom igång med
                SQL” att det finns mycket att lära sig för att kunna räknas någon sorts expert.</p>
            <p><b>Reflektera kring koden du skrev för att lösa uppgifterna, klasser, formulär,
                integration Anax Lite?</b></p>
            <p>Det blev att jag skapade fem nya klasser i det här kursmomentet. Database, Query,
                User, Cookie, och Helpers. Alla är integrerade i ramverket eftersom jag ser användning
                för dem i flera sammanhang. Database sköter PDO-koden som kommunicerar med databasen,
                Query sköter själva SQL-koden som sedan används av Database, User samlar information
                om en inloggad användare, Cookie sköter cookies, och Helpers sköter lite olika saker
                som att hämta värden från $_POST och $_GET med hjälp av htmlentities och hjälper till
                med kod för paginering. Jag använder mig ofta av validations-router när man loggar in,
                skapar ett konto, ändrar lösenord etc. Dessa router har ingen egen view utan skickar
                en sedan vidare till en ny route beroende på uppgifterna som skickats in. Jag har
                försökt att förutspå de problem som kan uppstå vid varje route och hantera dem. Till
                exempel gör jag en koll ifall en admin är inloggad för varje route som bara ska nås
                av en sådan, och samma sak med router för vanliga användare. Jag kollar också att alla
                värden som ska ha skickats med POST eller GET finns med. Ifall det finns något fel så
                skickas man alltid till en ny passande route. Det blev rätt så många router att skriva,
                men det kändes också nödvändigt för att allt ska fungera som jag vill. De flesta router
                jag skrivit är sådana utan en egen view, utan de sköter bara en viss logik och skickar
                en sedan vidare. </p>
            <p><b>Känner du dig hemma i ramverket, dess komponenter och struktur?</b></p>
            <p>Det här kursmomentet har jag känt mig mycket mer hemma än tidigare. Jag har vetat direkt
                var jag ska sätta in mina nya filer, medan jag tidigare har fått tänka mer “hur
                fungerade det här nu igen?”. Det känns väldigt skönt eftersom jag tidigare har funderat
                hur logiskt allt kommer kännas i slutändan, men det verkar som jag kommer ha ganska bra
                klarhet över ramverket när kursen är slut.</p>
            <p><b>Hur bedömer du svårighetsgraden på kursens inledande kursmoment, känner du att du lär
                dig något/bra saker?</b></p>
            <p>Jag skulle nog inte säga att svårighetsgraden har varit så jättestor. Det är mest att
                det tagit väldigt mycket tid, mer än någon tidigare kurs. I det här kursmomentet så var
                det väldigt hjälpsamt att man får kod för paginering i en övning. Annars hade nog just
                pagineringsdelen av koden kunnat vara ett problem vad gäller svårighetsgraden.
                Kalender-uppgiften tyckte jag dock var lite knepig, och var tvungen att googla runt lite
                för att få tips om hur jag kunde skriva koden. Men för det mesta har det varit ganska
                rättframt hur man ska lösa uppgifter. Det jag mest känner jag lär mig om är att verkligen
                bli van vid att använda mig utav klasser och objekt, att bli van vid att skriva kod i
                ett ramverk, och att skriva SQL-kod. Jag tycker dock att kursmomenten borde kortas ner
                lite eftersom jag inte alls känt att jag haft tid till extrauppgifter, fastän jag lagt
                ner mycket tid om dagarna på att jobba med kursmomenten.</p>
            <h3>Kmom04</h3>
            <p><b>Finns det något att säga kring din klass för textfilter, eller rent allmänt om
                formatering och filtrering av text som sparas i databasen av användaren?</b></p>
            <p>Jag har mest sett filtrering av användares texter som en säkerhetsfråga. Att se till att
                ingen JavaScript-kod slås igång när man skriver ut det i browsern till exempel. Men det
                är ju väldigt användbart i andra sammanhang som visas i det här kursmomentet. Filtrering
                av texter är något man borde vara väldigt insatt i om man vill att en webbplats man har
                ansvar för ska vara säker, så det är bra att vi får gå in lite på det.</p>
            <p><b>Berätta hur du tänkte när du strukturerade klasserna och databasen för webbsidor och
                bloggposter.</b></p>
            <p>De enda klasserna jag skapat det här kursmomentet är Textfilter och QueryContent.
                QueryContent sköter helt enkelt all sql-kod och kommunicerar med Database-klassen för
                content-tabellen. Jag kunde inte riktigt motivera varför jag skulle ha en Content-, Page-,
                och Blog-klass, så jag lät helt enkelt bli att skapa sådana. Det skulle möjligtvis vara
                för att ha mer organiserad kod, men eftersom att jag inte gillar att använda mig av en
                createHTML-metod i klasser där man skapar en sträng med all HTML-kod så kunde jag inte
                riktigt se nyttan. Kanske någon kan övertala mig till att klasser hade varit bättre, men
                för stunden kör jag utan. Textfilter och QueryContent är en del av ramverket. Databasen
                är gjord som det står i övningen. Det är alltså bara en tabell (content) där all
                information som title, slug, path, created, o.s.v. finns med. Inga konstigheter.</p>
            <p><b>Förklara vilka routes som används för att demonstrera funktionaliteten för webbsidor
                och blogg (så att en utomstående kan testa).</b></p>
            <p>Om man klickar på “Innehåll” i navbaren får man fram en dropdown-lista där Pages, Blogg,
                och Block finns med. Klickar man Pages får man fram en tabell med allt innehåll av typen
                page, och klickar man på ett titelnamn får man se det filtrerade innehållet. Klickar du på
                Blogg kommer en lista fram med alla bloggar, och du kan klicka på “Läs mer” för att se dem
                enskilda. På Block så kommer du till en sida där en sidebar av typen block helt enkelt
                visas upp tillsammans med lite annan text. Om du loggar in som admin (user: admin, pass:
                admin) så kan du från admin-sidan klicka på “Innehåll”. Du får då se en lista på allt
                innehåll, även om de är opublicerade eller borttagna, och därifrån välja att redigera
                enskilt innehåll. Från dropdownen i navbaren kan du bara se publicerat innehåll.</p>
            <p><b>Hur känns det att dokumentera databasen så här i efterhand?</b></p>
            <p>Det gick väldigt enkelt och snabbt. Det är ju väldigt likt hur man dokumenterar klasser i
                ett UML-diagram, så jag kände mig redan bekant med sättet att tänka. Precis som Mikael
                Roos sa i föreläsningen för Kmom03 så är det ju väldigt bra att ha om man ska återkomma
                till sin kod och databas efter en lång tid. Så de kan vara bra att ha även om man jobbar
                helt själv på ett projekt, utan medarbetare.</p>
            <p><b>Om du är självkritisk till koden du skriver i Anax Lite, ser du förbättringspotential
                och möjligheter till alternativ struktur av din kod?</b></p>
            <p>Jag har kikat lite snabbt i default-mappen i views och har sett att metoder används med
                hjälp av “$this” som jag inte har någon koll på. Är säker på att det finns användbara
                saker att använda i ramverket som hade gjort min kod snyggare, men jag har inte koll på
                allt sånt än. Det har blivit väldigt många router, och det borde finnas ett sätt att
                organisera det bättre. Till exempel är det många router som fungerar som en
                processing-route för att hantera $_POST-variabler och kommunicera med databasen för att
                sedan redirecta en till en ny route, och det ser väldigt stökigt ut. Men jag vet inte
                riktigt hur det kan skötas på ett snyggt sätt. Men det borde gå att fixa tycker jag.
                Det handlar mest om organisering, och jag känner inte att jag är någon expert i det
                området, men man måste ju göra ett första försök med nya saker man lär sig, och sedan
                förbättra sina metoder allt eftersom man får erfarenhet.</p>
            <h3>Kmom05</h3>
            <p><b>Gick det bra att komma igång med det vi kallar programmering av databas, med
                transaktioner, lagrade procedurer, triggers, funktioner?</b></p>
            <p>Ja det fungerade bra. Övningarna gjorde att jag snabbt kunde sätta igång med alltihop.
                Det är första gången jag försökt mig på sådan typ av programmering så det var
                nyttigt.</p>
            <p><b>Hur är din syn på att programmera på detta viset i databasen?</b></p>
            <p>Jag tycker det verkar kunna vara till stor hjälp. Det kändes smidigt att kunna
                programmera på det sättet för att testa hur databasen fungerar, utan att behöva skriva
                någon PHP-kod. Sen är det lite svårare att veta vad som är bäst i slutändan när databasen
                ska kopplas till själva webbplatsen. Ska man programmera i databasen eller med PHP? Om
                man programmerar i databasen blir det ju lätt att använda procedurerna m.m. i andra
                sammanhang än bara webbplatsen, medan det kanske kan kännas lättare att få en överblick
                över all kod om man sköter det i PHP. Skulle vara intressant att höra lite argument för
                och emot.</p>
            <p><b>Några reflektioner kring din kod för backenden till webbshopen?</b></p>
            <p>Jag kikade mycket på exempelkoden för en e-shop, vilket var hjälpsamt för att skapa alla
                tabeller. Invoice och InvoiceRow är två tabeller jag har skapat, men som inte används
                av admin eller i mitt SQL-API. Men jag tänkte att jag skulle ha lite framtidstänk och
                ändå ha med dem. Det blev väldigt många rader kod. Kanske det finns smartare sätt att
                skriva SQL-koden på men jag gjorde så gott jag kunde i alla fall. Är lite osäker för
                tillfället på hur väl jag utnyttjar att man kan göra en ROLLBACK. Just det där med
                felhantering är jag osäker på hur det är ställt för tillfället, men det ska jag ha mer
                i åtanke i framtiden.</p>
            <p><b>Något du vill säga om koden generellt i och kring Anax Lite?</b></p>
            <p>Vi börjar ju närma oss projektarbetet för kursen nu och då ska det bli intressant att få
                starta igång ett nytt anax-lite från grunden (antar bara nu att det är det vi kommer göra)
                och se vad jag kan göra bättre för att få en snyggare kod. Man lär sig ju mycket under
                kursens gång, men det är inte alltid så lätt att implementera allt man lärt sig i all
                kod man skrivit innan. Det kan vara funktioner jag inte använt mig av, eller hur koden
                är strukturerad, så det finns nog områden som kommer bli bättre i nytt försök.</p>
            <h3>Kmom06</h3><p>(Kommer uppdateras)</p>
            <h3>Kmom07-10</h3><p>(Kommer uppdateras)</p>
        </div>
    </div>
</div>
<?php
$this->renderView("take1/footer");
?>
