<?php
/**
 * Routes.
 */
$app->router->add("", function () use ($app) {
    $app->view->add("take1/home");
    $app->response->setBody([$app->view, "render"])
                  ->send();
});

$app->router->add("calendar", function () use ($app) {
    $app->view->add("take1/calendar");
    $app->response->setBody([$app->view, "render"])
                  ->send();
});

$app->router->add("calendar/previous", function () use ($app) {
    if (isset($_GET['year']) && isset($_GET['month'])) {
        $year = htmlentities($_GET['year']);
        $month = htmlentities($_GET['month']);
        $previousMonth = mktime(0, 0, 0, $month - 1, 1, $year);
        $app->session->set("date", $previousMonth);
    }
    header("Location: " . $app->url->create("calendar"));
    exit;
});

$app->router->add("calendar/next", function () use ($app) {
    if (isset($_GET['year']) && isset($_GET['month'])) {
        $year = htmlentities($_GET['year']);
        $month = htmlentities($_GET['month']);
        $nextMonth = mktime(0, 0, 0, $month + 1, 1, $year);
        $app->session->set("date", $nextMonth);
    }
    header("Location: " . $app->url->create("calendar"));
    exit;
});

$app->router->add("report", function () use ($app) {
    $app->view->add("take1/report");
    $app->response->setBody([$app->view, "render"])
                  ->send();
});

$app->router->add("about", function () use ($app) {
    $app->view->add("take1/about");
    $app->response->setBody([$app->view, "render"])
                  ->send();
});

$app->router->add("status", function () use ($app) {
    $data = [
        "Server" => php_uname(),
        "PHP version" => phpversion(),
        "Included files" => count(get_included_files()),
        "Memory used" => memory_get_peak_usage(true),
        "Execution time" => microtime(true) - $_SERVER['REQUEST_TIME_FLOAT']
    ];

    $app->response->sendJson($data);
});
