<?php
$route1 = $app->url->create("calendar/previous");
$route2 = $app->url->create("calendar/next");
$date = null;
if ($app->session->has("date")) {
    $date = $app->session->getOnce("date");
}
$calendar = new \Vinter\Calendar\Calendar($route1, $route2, $date);
$imageUrls = [
    $app->url->asset("img/january.jpg"),
    $app->url->asset("img/february.jpg"),
    $app->url->asset("img/march.jpg"),
    $app->url->asset("img/april.jpg"),
    $app->url->asset("img/may.jpg"),
    $app->url->asset("img/june.jpg"),
    $app->url->asset("img/july.jpg"),
    $app->url->asset("img/august.jpg"),
    $app->url->asset("img/september.jpg"),
    $app->url->asset("img/october.jpg"),
    $app->url->asset("img/november.jpg"),
    $app->url->asset("img/december.jpg")
];
$calendar->setImages($imageUrls);

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
            <?= $calendar->getCalendar() ?>
        </div>
    </div>
</div>
<?php
$this->renderView("take1/footer");
?>
