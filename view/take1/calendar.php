<?php
$this->renderView("take1/header", [
    "title" => "Kalender",
]);
$this->renderView("navbar2/navbar");
?>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-header">
                <h1>Kalender</h1>
            </div>
        </div>
    </div>
</div>
<?php
$this->renderView("take1/footer");
?>
