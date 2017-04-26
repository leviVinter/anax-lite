<?php
/**
 * Routes
 */
$app->router->add("new_user", function () use ($app) {
    $error = $app->request->getGet("error");
    $app->view->add("login/new_user", ["error" => $error]);
    $app->response->setBody([$app->view, "render"])
                  ->send();
});

$app->router->add("new_user/validate", function () use ($app) {
    // Get post values
    $userName = $app->helpers->getPost("inputUser");
    $userPass = $app->helpers->getPost("inputPass");
    $reUserPass = $app->helpers->getPost("inputRePass");

    // Create routes
    $profileRoute = $app->url->create("profile");
    $newUserRoute = $app->url->create("new_user");
    $adminRoute = $app->url->create("admin");
    if (!($userName && $userPass && $reUserPass)) {
        header("Location: {$newUserRoute}");
        exit();
    }
    // Check if username exists in database
    $userExists = $app->queryLogin->userExists($userName);
    if ($userExists) {
        header("Location: {$newUserRoute}?error=userexists");
        exit();
    }
    // Check if passwords match
    if ($userPass != $reUserPass) {
        header("Location: {$newUserRoute}?error=missmatch");
        exit();
    }
    // Make a hash of the password
    $cryptPass = password_hash($userPass, PASSWORD_DEFAULT);

    // Add user to database
    $app->queryLogin->addUser($userName, $cryptPass);

    if ($app->session->has("admin")) {
        header("Location: {$adminRoute}");
        exit();
    }
    $app->session->delete("admin");

    $app->session->set("user", $userName);

    header("Location: {$profileRoute}");
    exit();
});

$app->router->add("login", function () use ($app) {
    $profileRoute = $app->url->create("profile");
    $adminRoute = $app->url->create("admin");
    if ($app->session->has("user")) {
        header("Location: {$profileRoute}");
        exit();
    } elseif ($app->session->has("admin")) {
        header("Location: {$adminRoute}");
        exit();
    }
    $error = $app->request->getGet("error");
    $logout = $app->request->getGet("logout");
    $app->view->add("login/login", [
        "error" => $error,
        "logout" => $logout
    ]);
    $app->response->setBody([$app->view, "render"])
                  ->send();
});

$app->router->add("login/validate", function () use ($app) {
    // Valid admin users
    $validAdmins = ["doe", "admin"];

    // Get post values
    $userName = $app->helpers->getPost("inputUser");
    $userPass = $app->helpers->getPost("inputPass");

    // Routes
    $adminRoute = $app->url->create("admin");
    $profileRoute = $app->url->create("profile");
    $loginRoute = $app->url->create("login");
    if (!($userName && $userPass)) {
        header("Location: {$loginRoute}?error=notfilled");
        exit();
    }
    // Check if username exists in database
    $userExists = $app->queryLogin->userExists($userName);
    if (!$userExists) {
        header("Location: {$loginRoute}?error=wrong");
        exit();
    }
    $dbPass = $app->queryLogin->getHashedPassword($userName);
    if (!password_verify($userPass, $dbPass)) {
        header("Location: {$loginRoute}?error=wrong");
        exit();
    }
    if (in_array($userName, $validAdmins)) {
        $app->session->set("admin", $userName);
        header("Location: {$adminRoute}");
    } else {
        $app->session->set("user", $userName);
        header("Location: {$profileRoute}");
    }
    exit();
});

$app->router->add("profile/**", function () use ($app) {
    $loginRoute = $app->url->create("login");
    if (!$app->session->has("user")) {
        header("Location: {$loginRoute}");
        exit();
    }
});

$app->router->add("profile", function () use ($app) {
    $app->cookie->set("date", date('Y-m-d'));
    $success = $app->request->getGet("success");
    $app->view->add("login/profile", ["success" => $success]);
    $app->response->setBody([$app->view, "render"])
                  ->send();
});

$app->router->add("profile/edit", function () use ($app) {
    $error = $app->request->getGet("error");
    $app->view->add("login/profile_edit", ["error" => $error]);
    $app->response->setBody([$app->view, "render"])
                  ->send();
});

$app->router->add("profile/edit/validate", function () use ($app) {
    $loginRoute = $app->url->create("login");
    $profileRoute = $app->url->create("profile");
    $present = $app->helpers->getPost("present");
    $favMovie = $app->helpers->getPost("favMovie");
    $favColor = $app->helpers->getPost("favColor");
    if ($present === null || $favMovie === null || $favColor === null) {
        header("Location: {$loginRoute}");
        exit();
    }
    $user = $app->session->get("user");
    $app->queryLogin->updateUser($user, $present, $favMovie, $favColor);
    header("Location: {$profileRoute}?success=profile");
    exit();
});

$app->router->add("profile/changepassword", function () use ($app) {
    $loginRoute = $app->url->create("login");
    $profileEditRoute = $app->url->create("profile/edit");
    $profileRoute = $app->url->create("profile");
    $oldPass = $app->helpers->getPost("oldPass");
    $newPass = $app->helpers->getPost("newPass");
    $reNewPass = $app->helpers->getPost("reNewPass");
    if (!($oldPass && $newPass && $reNewPass)) {
        header("Location: {$loginRoute}");
        exit();
    }
    $userName = $app->session->get("user");
    $dbPass = $app->queryLogin->getHashedPassword($userName);
    if (!password_verify($oldPass, $dbPass)) {
        header("Location: {$profileEditRoute}?error=oldpassword");
        exit();
    }
    if ($newPass !== $reNewPass) {
        header("Location: {$profileEditRoute}?error=missmatch");
        exit();
    }
    $cryptPass = password_hash($newPass, PASSWORD_DEFAULT);
    $app->queryLogin->changePassword($userName, $cryptPass);
    header("Location: {$profileRoute}?success=password");
    exit();
});

$app->router->add("logout", function () use ($app) {
    $loginRoute = $app->url->create("login");
    if ($app->session->has("user")) {
        $app->session->delete("user");
    }
    if ($app->session->has("admin")) {
        $app->session->delete("admin");
    }
    header("Location: {$loginRoute}?logout=true");
    exit();
});
