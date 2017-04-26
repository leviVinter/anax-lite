<?php
/**
 * Routes
 */

$app->router->add("admin/**", function () use ($app) {
    $loginRoute = $app->url->create("login");
    if (!$app->session->has("admin")) {
        header("Location: {$loginRoute}");
        exit();
    }
});

$app->router->add("admin", function () use ($app) {
    $adminRoute = $app->url->create("admin");
    $hits = $app->request->getGet("hits", 4);
    if (!(is_numeric($hits) && $hits > 0 && $hits <= 8)) {
        header("Location: {$adminRoute}");
        exit();
    }

    // Get max number of pages
    $searchText = $app->request->getGet("search");
    $max = $app->queryLogin->getCount($searchText);
    $max = $max->max > 0
        ? ceil($max->max / $hits)
        : 1;

    // Get current page
    $page = $app->request->getGet("page", 1);
    if (!(is_numeric($page) && $page > 0 && $page <= $max)) {
        header("Location: {$adminRoute}");
        exit();
    }
    $offset = $hits * ($page - 1);

    // Only these values are valid
    $columns = ["id", "name"];
    $orders = ["asc", "desc"];

    // Get settings from GET or use default
    $orderBy = $app->request->getGet("orderby") ?: "id";
    $order = $app->request->getGet("order") ?: "asc";

    // Incoming matches valid value sets
    if (!(in_array($orderBy, $columns) && in_array($order, $orders))) {
        header("Location: {$adminRoute}");
        exit();
    }
    $sql = "SELECT * FROM users WHERE name LIKE ? "
        . "ORDER BY $orderBy $order LIMIT $hits OFFSET $offset;";
    $params = ["%{$searchText}%"];
    $res = $app->db->executeFetchAll($sql, $params);
    $success = $app->request->getGet("success");
    $app->view->add("login/admin", [
        "res" => $res,
        "max" => $max,
        "searchText" => $searchText,
        "success" => $success
    ]);
    $app->response->setBody([$app->view, "render"])
                  ->send();
});

$app->router->add("admin/edit", function () use ($app) {
    $adminRoute = $app->url->create("admin");
    $userName = $app->request->getGet("name");
    if (!$userName) {
        header("Location: {$adminRoute}");
        exit();
    }
    $user = $app->queryLogin->getUser($userName);
    if (!$user) {
        header("Location: {$adminRoute}");
        exit();
    }
    $error = $app->request->getGet("error");
    $success = $app->request->getGet("success");
    $app->view->add("login/admin_edit", [
        "user" => $user,
        "error" => $error,
        "success" => $success
    ]);
    $app->response->setBody([$app->view, "render"])
                  ->send();
});

$app->router->add("admin/delete", function () use ($app) {
    $loginRoute = $app->url->create("login");
    $userName = $app->request->getGet("name");
    if (!$app->queryLogin->userExists($userName)) {
        header("Location: {$loginRoute}");
        exit();
    }
    $app->queryLogin->removeUser($userName);
    $adminRoute = $app->url->create("admin");
    header("Location: {$adminRoute}?success={$userName}");
    exit();
});

$app->router->add("admin/search", function () use ($app) {
    $searchText = $app->helpers->getPost("search");
    $users = null;
    if ($searchText) {
        $users = $app->queryLogin->searchUsers($searchText);
    }
    $app->view->add("login/admin_search", [
        "searchText" => $searchText,
        "res" => $users
    ]);
    $app->response->setBody([$app->view, "render"])
                  ->send();
});

$app->router->add("admin/change_password", function () use ($app) {
    $loginRoute = $app->url->create("login");
    $adminEditRoute = $app->url->create("admin/edit");
    $userName = $app->helpers->getPost("userName");
    $newPass = $app->helpers->getPost("newPass");
    $reNewPass = $app->helpers->getPost("reNewPass");
    if (!($newPass && $reNewPass)) {
        header("Location: {$loginRoute}");
        exit();
    }
    if ($newPass !== $reNewPass) {
        header("Location: {$adminEditRoute}?name={$userName}&error=missmatch");
        exit();
    }
    $cryptPass = password_hash($newPass, PASSWORD_DEFAULT);
    $app->queryLogin->changePassword($userName, $cryptPass);
    header("Location: {$adminEditRoute}?name={$userName}&success=password");
    exit();
});

$app->router->add("admin/edit_validate", function () use ($app) {
    $loginRoute = $app->url->create("login");
    $adminEditRoute = $app->url->create("admin/edit");
    $userName = $app->helpers->getPost("userName");
    $present = $app->helpers->getPost("present");
    $favMovie = $app->helpers->getPost("favMovie");
    $favColor = $app->helpers->getPost("favColor");
    if ($present === null || $favMovie === null ||
        $favColor === null || !$userName) {
        header("Location: {$loginRoute}");
        exit();
    }
    $app->queryLogin->updateUser($userName, $present, $favMovie, $favColor);
    header("Location: {$adminEditRoute}?name={$userName}&success=profile");
    exit();
});

// $app->router->add("admin/new_admin", function () use ($app) {
//     $sql = "INSERT INTO admin (name, password) VALUES (?, ?)";
//     $cryptPass = password_hash("doe", PASSWORD_DEFAULT);
//     $userName = "doe";
//     $params = [$userName, $cryptPass];
//     $app->db->execute($sql, $params);
//     $sql = "INSERT INTO admin (name, password) VALUES (?, ?)";
//     $cryptPass = password_hash("admin", PASSWORD_DEFAULT);
//     $userName = "admin";
//     $params = [$userName, $cryptPass];
//     $app->db->execute($sql, $params);
// });
