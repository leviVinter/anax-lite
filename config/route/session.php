<?php
/**
 * Routes.
 */
$app->router->add("session", function () use ($app) {
    $app->view->add("take1/session");
    $app->response->setBody([$app->view, "render"])
                  ->send();
});

$app->router->add("session/increment", function () use ($app) {
    // $session = new \Vinter\Session\Session();
    $app->session->updateInteger("myInt", 1);
    $sessionUrl = $app->url->create("session");
    header("Location: " . $sessionUrl);
    exit;
});

$app->router->add("session/decrement", function () use ($app) {
    // $session = new \Vinter\Session\Session();
    $app->session->updateInteger("myInt", -1);
    $sessionUrl = $app->url->create("session");
    header("Location: " . $sessionUrl);
    exit;
});

$app->router->add("session/status", function () use ($app) {
    // $session = new \Vinter\Session\Session();
    $data = $app->session->status();
    $app->response->sendJson($data);
});

$app->router->add("session/dump", function () use ($app) {
    // $session = new \Vinter\Session\Session();
    $app->session->dump();
});

$app->router->add("session/destroy", function () use ($app) {
    // $session = new \Vinter\Session\Session();
    $app->session->destroy();
    $sessionUrl = $app->url->create("session");
    header("Location: " . $sessionUrl);
    exit;
});
