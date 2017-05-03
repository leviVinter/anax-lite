<?php

$app->router->add("admin/webshop", function () use ($app) {
    $res = $app->queryWebshop->getProductInventory();
    $app->view->add("webshop/admin", ["res" => $res]);
    $app->response->setBody([$app->view, "render"])
                  ->send();
});

$app->router->add("admin/webshop/product/{id}", function ($id) use ($app) {
    $res = $app->queryWebshop->getProduct($id);
    $categories = $app->queryWebshop->getCategories();
    $shelves = $app->queryWebshop->getShelves();
    $app->view->add("webshop/edit_product", [
        "res" => $res,
        "categories" => $categories,
        "shelves" => $shelves
    ]);
    $app->response->setBody([$app->view, "render"])
                  ->send();
});

$app->router->add("admin/webshop/edit_validate", function () use ($app) {
    $successRoute = $app->url->create("admin/webshop/product");
    $postVariables = $app->request->getPost([
        "id", "name", "category", "shelf", "description",
        "image", "price", "amount"
    ]);
    $app->queryWebshop->updateProduct($postVariables);
    header("Location: {$successRoute}/{$postVariables['id']}?success=true");
    exit;
});

$app->router->add("admin/webshop/remove_product", function () use ($app) {
    $route = $app->url->create("admin/webshop");
    $prodId = $app->request->getPost("delete");
    $app->queryWebshop->removeProduct($prodId);
    header("Location: {$route}");
    exit;
});

$app->router->add("admin/webshop/create_product", function () use ($app) {
    $shelves = $app->queryWebshop->getShelves();
    $app->view->add("webshop/create_product", ["shelves" => $shelves]);
    $app->response->setBody([$app->view, "render"])
                  ->send();
});

$app->router->add("admin/webshop/create_validate", function () use ($app) {
    $errorRoute = $app->url->create("admin/webshop");
    $editRoute = $app->url->create("admin/webshop/product");
    $prodName = $app->request->getPost("name");
    $amount = $app->request->getPost("amount");
    $shelf = $app->request->getPost("shelf");
    if (!$prodName || !$amount || !$shelf) {
        header("Location: {$errorRoute}");
        exit;
    }
    $id = $app->queryWebshop->createProduct($prodName, $amount, $shelf);
    header("Location: {$editRoute}/{$id}");
    exit;
});
