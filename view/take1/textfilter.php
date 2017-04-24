<?php
$this->renderView("take1/header", [
    "title" => "Textfiltrering",
]);
$this->renderView("navbar2/navbar");
$bbcodeText = "[url=https://sv.wikipedia.org/wiki/BBCode]BBCode [/url] är "
    . "ett är en förkortning som står för [i]Bulletin Board Code[/i]. Man "
    . "kan lätt skapa text i [b]fetstil[/b] genom att använda sig av "
    . "hakparenteser. BBCode används ofta på moderna [u]forum[/u].";
$nl2brText = "Med hjälp av php-funktionen nl2br kan jag ersätta alla \n "
    . "med ett &lt;br&gt; istället. Detta gör \r att jag inte behöver skriva "
    . "\n\r text specifikt för \r\n HTML hela \n tiden.";
$linkText = "Nu filtrerar jag texten med en funktion som gör att jag slipper "
    . "skriva in &lt;a&gt;-taggar varje gång jag vill skapa en länk. Jag "
    . "skriver bara url:en, till exempel https://dbwebb.se/, och så skapas "
    . "länken automatiskt för browsern.";
$markdownText = "Jag kan skriva texten i "
    . "[Markdown](http://en.wikipedia.org/wiki/Markdown) och på så sätt "
    . "använda mig av till exempel **för att skriva i fetstil**, eller *för "
    . "kursiv stil*.";
$stripText = "Man kan med hjälp av php-funktionen strip_tags se till så att "
    . "HTML- och PHP-kod inte används i browsern. Till exempel "
    . "<b>fetstil</b> blir inte i fetstil.";
$escText = "Här filtreras texten igenom htmlentities vilket för att "
    . "<b>fetstil</b> inte blir i fetstil. Istället visas själva taggarna.";
?>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-header">
                <h1>Textfiltrering</h1>
            </div>
            <h2>BBCode</h2>
            <p><?= $bbcodeText ?></p>
            <p><?= $app->textfilter->doFilter($bbcodeText, "bbcode") ?></p>
            <h2>nl2br</h2>
            <p><?= $nl2brText ?></p>
            <p><?= $app->textfilter->doFilter($nl2brText, "nl2br") ?></p>
            <h2>link</h2>
            <p><?= $linkText ?></p>
            <p><?= $app->textfilter->doFilter($linkText, "clickable") ?></p>
            <h2>Markdown</h2>
            <p><?= $markdownText ?></p>
            <p><?= $app->textfilter->doFilter($markdownText, "markdown") ?></p>
            <h2>strip</h2>
            <p><?= $stripText ?></p>
            <p><?= $app->textfilter->doFilter($stripText, "strip") ?></p>
            <h2>esc</h2>
            <p><?= $escText ?></p>
            <p><?= $app->textfilter->doFilter($escText, "esc") ?></p>
        </div>
    </div>
</div>
<?php
$this->renderView("take1/footer");
?>
