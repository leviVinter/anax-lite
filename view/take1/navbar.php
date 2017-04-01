<?php
$urlHome = $app->url->create("");
$urlReport = $app->url->create("report");
$urlAbout = $app->url->create("about");

?>
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="<?= $urlHome ?>">THOMAS</a>
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li>
                    <a href="<?= $urlHome ?>">Hem</a>
                </li>
                <li>
                    <a href="<?= $urlReport ?>">Redovisning</a>
                </li>
                <li>
                    <a href="<?= $urlAbout ?>">Om</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
