<?php
$this->renderView("take1/header", [
    "title" => "Session",
]);
$this->renderView("navbar2/navbar");
$session = $app->session;
// $session->start();
if (!$session->has("myInt")) {
    $session->set("myInt", 0);
}

$currentValue = $session->get("myInt");

/* Routes */
$increment = $app->url->create("session/increment");
$decrement = $app->url->create("session/decrement");
$status = $app->url->create("session/status");
$dump = $app->url->create("session/dump");
$destroy = $app->url->create("session/destroy");
?>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-header">
                <h1>Testa Session</h1>
                <p class="lead">Välj en route.</p>
            </div>
            <p>Nuvarande värde: <?= htmlentities($currentValue) ?></p>
            <a class="btn btn-primary" href="<?= $increment ?>">Increment</a>
            <a class="btn btn-success" href="<?= $decrement ?>">Decrement</a>
            <a class="btn btn-info" href="<?= $status ?>">Status</a>
            <a class="btn btn-warning" href="<?= $dump ?>">Dump</a>
            <a class="btn btn-danger" href="<?= $destroy ?>">Destroy</a>
        </div>
    </div>
</div>
<?php
$this->renderView("take1/footer");
?>
