<?php
$this->renderView("take1/header", [
    "title" => "Visa sidebar"
]);
$this->renderView("navbar2/navbar");
?>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-header">
                <h1>En sida med sidebar</h1>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-9">
            <h2>Lite text</h2>
            <p>Så här kan en sida med en sidebar se ut</p>
            <p>Sidebaren är av typen block och är sparad i databasen. Den är skriven i markdown och filtreras
                till vanlig html-kod innan den skrivs ut här.</p>
            <p>
        </div>
        <?php $this->renderView("content/sidebar", ["sidebar" => $res]) ?>
    </div>
</div>

<?php
$this->renderView("take1/footer");
?>
