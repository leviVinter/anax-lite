<?php
$this->renderView("take1/header", [
    "title" => "Profil",
]);
$this->renderView("navbar2/navbar");
$info = $app->user->getHtml();
?>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <?php if ($success) : ?>
            <div class="alert alert-success" role="alert">
                <?php if ($success === "profile") : ?>
                Din profil har blivit uppdaterad.
                <?php elseif ($success === "password") : ?>
                Ditt lösenord har ändrats.
                <?php endif ?>
            </div>
            <?php endif ?>
            <div class="page-header">
                <h1>Profilsida</h1>
            </div>
            <ul class="nav nav-pills">
                <li role="presentation" class="active">
                    <a href="<?= $app->url->create('logout') ?>">
                        Logga ut
                    </a>
                </li>
                <li role="presentation" class="active">
                    <a href="<?= $app->url->create('profile/edit') ?>">
                        Redigera profil
                    </a>
                </li>
            </ul>
            <br>
            <?= $info ?>
            <h3>Cookie</h3>
            <p>Dagens datum: <?= $app->cookie->get("date") ?></p>
        </div>
    </div>
</div>

<?php
$this->renderView("take1/footer");
?>
