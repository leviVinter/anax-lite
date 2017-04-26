<?php

$app->router->add("content/pages", function () use ($app) {
    $res = $app->queryContent->getAll("page");
    $app->view->add("content/show-pages", [
        "res" => $res,
        "title" => "Sidor",
        "header" => "Alla sidor"
    ]);
    $app->response->setBody([$app->view, "render"])
                  ->send();
});

$app->router->add("content/blogs", function () use ($app) {
    $res = $app->queryContent->getAll("post");
    $app->view->add("content/all-blogs", [
        "res" => $res,
        "title" => "Blogg",
        "header" => "Alla bloggar"
    ]);
    $app->response->setBody([$app->view, "render"])
                  ->send();
});

$app->router->add("content/blocks", function () use ($app) {
    $res = $app->queryContent->getAll("block")[0];
    $app->view->add("content/show-sidebar", ["res" => $res]);
    $app->response->setBody([$app->view, "render"])
                  ->send();
});

$app->router->add("content/page/{path}", function () use ($app) {
    $routeArr = $app->request->getRouteParts();
    $path = end($routeArr);
    $res = $app->queryContent->getPage($path);
    if (!$res) {
        header("Location: {$editRoute}");
        exit;
    }
    $app->view->add("content/page", ["res" => $res]);
    $app->response->setBody([$app->view, "render"])
                  ->send();
});

$app->router->add("content/blog/{slug}", function () use ($app) {
    $editRoute = $app->url->create("content/edit");
    $routeArr = $app->request->getRouteParts();
    $slug = end($routeArr);
    $res = $app->queryContent->getBlog($slug);
    if (!$res) {
        header("Location: {$editRoute}");
        exit;
    }
    $app->view->add("content/blog", ["res" => $res]);
    $app->response->setBody([$app->view, "render"])
                  ->send();
});

$app->router->add("content/edit/**", function () use ($app) {
    $loginRoute = $app->url->create("login");
    if (!$app->session->has("admin")) {
        header("Location: {$loginRoute}");
        exit;
    }
});

$app->router->add("content/edit", function () use ($app) {
    $res = $app->queryContent->getAll();
    $app->view->add("content/show-all", [
        "res" => $res,
        "header" => "Allt innehåll",
        "title" => "Innehåll"
    ]);
    $app->response->setBody([$app->view, "render"])
                  ->send();
});

$app->router->add("content/edit/{id}", function () use ($app) {
    $routeArr = $app->request->getRouteParts();
    $contentId = end($routeArr);
    $loginRoute = $app->url->create("login");
    if (!is_numeric($contentId)) {
        header("Location: {$loginRoute}");
        exit;
    }
    $res = $app->queryContent->getContent($contentId);
    if (!$res) {
        header("Location: {$loginRoute}");
        exit;
    }
    $title = $res->title;
    $app->view->add("content/edit", ["res" => $res]);
    $app->response->setBody([$app->view, "render"])
                  ->send();
});

$app->router->add("content/edit_validate", function () use ($app) {
    $deleteRoute = $app->url->create("content/delete");
    if ($app->request->hasKeyPost("delete")) {
        $id = $app->request->getPost("id");
        $title = $app->request->getPost("title");
        if ($title && $id) {
            header("Location: {$deleteRoute}?title={$title}&id={$id}");
            exit;
        }
    }
    $editRoute = $app->url->create("content/edit");
    if (!$app->request->hasKeyPost("update")) {
        header("Location: {$editRoute}");
        exit;
    }
    $postValues = $app->request->getPost([
        "id",
        "title",
        "path",
        "slug",
        "data",
        "type",
        "filter",
        "published"
    ]);
    if (!$postValues["slug"]) {
        $postValues["slug"] = $app->textfilter->slugify($postValues["title"]);
    }
    if (!$postValues["path"]) {
        $postValues["path"] = null;
    }
    $slugIsUnique = $app->queryContent->slugIsUnique(
        $postValues["id"],
        $postValues["slug"]
    );
    if (!$postValues["published"]) {
        $postValues["published"] = null;
    }
    $editIdRoute = $app->url->create("content/edit/{$postValues['id']}");
    if (!$slugIsUnique) {
        header("Location: {$editIdRoute}?error=slug");
        exit;
    }
    $app->queryContent->updateContent($postValues);
    header("Location: {$editIdRoute}?success=updated");
    exit;
});

$app->router->add("content/create", function () use ($app) {
    $app->view->add("content/create");
    $app->response->setBody([$app->view, "render"])
                  ->send();
});

$app->router->add("content/create_validate", function () use ($app) {
    $editRoute = $app->url->create("content/edit");
    $create = $app->request->hasKeyPost("create");
    $title = $app->request->getPost("title");
    if (!$create || !$title) {
        header("Location: {$editRoute}");
        exit;
    }
    $id = $app->queryContent->insertContent($title);
    $editIdRoute = $app->url->create("content/edit/{$id}");
    header("Location: {$editIdRoute}");
    exit;
});

$app->router->add("content/delete", function () use ($app) {
    $editRoute = $app->url->create("content/edit");
    $id = $app->request->getGet("id");
    $title = $app->request->getGet("title");
    if (!$id || !$title) {
        header("Location: {$editRoute}");
        exit;
    }
    $app->view->add("content/delete", [
        "id" => $id,
        "title" => $title
    ]);
    $app->response->setBody([$app->view, "render"])
                  ->send();
});

$app->router->add("content/delete_validate", function () use ($app) {
    $editRoute = $app->url->create("content/edit");
    $id = $app->request->getPost("id");
    if (!$id) {
        echo "hello";
        die();
        header("Location: {$editRoute}");
        exit;
    }
    $app->queryContent->deleteContent($id);
    header("Location: {$editRoute}");
    exit;
});
