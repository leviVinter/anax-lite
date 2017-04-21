<?php
$this->renderView("take1/header", [
    "title" => "Redigera profil",
]);
$this->renderView("navbar2/navbar");
$userInfo = $app->user->getInfo();
?>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-header">
                <h1>Redigera profil</h1>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <form action="<?= $app->url->create('profile/edit/validate') ?>"
                method="POST">
                <div class="form-group">
                    <label for="present">Presentation</label>
                    <textarea rows="5" name="present" id="present"
                        class="form-control"><?= $userInfo["presentation"] ?></textarea>
                </div>
                <div class="form-group">
                    <label for="favMovie">Favoritfilm</label>
                    <input type="text" name="favMovie" id="favMovie"
                        class="form-control" value="<?= $userInfo["favMovie"] ?>">
                </div>
                <div class="form-group">
                    <label for="favColor">Favoritfärg</label>
                    <input type="text" name="favColor" id="favColor"
                        class="form-control" value="<?= $userInfo["favColor"] ?>">
                </div>
                <button class="btn btn-primary" type="submit">
                    Uppdatera
                </button>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <form action="<?= $app->url->create('profile/changepassword') ?>"
                method="POST">
                <h2>Byt lösenord</h2>
                <?php if ($error) : ?>
                <div class="alert alert-danger" role="alert">
                    <?php if ($error === "oldpassword") : ?>
                    Det nuvarande lösenordet var felaktigt.
                    <?php elseif ($error === "missmatch") : ?>
                    De nya lösenorden matchade inte varandra.
                    <?php endif ?>
                </div>
                <?php endif ?>
                <div class="form-group">
                    <input type="password" name="oldPass" class="form-control"
                        placeholder="Nuvarande lösenord" required>
                </div>
                <div class="form-group">
                    <input type="password" name="newPass" class="form-control"
                        placeholder="Nytt lösenord" required>
                </div>
                <div class="form-group">
                    <input type="password" name="reNewPass" class="form-control"
                        placeholder="Bekräfta nytt lösenord" required>
                </div>
                <button class="btn btn-primary" type="submit">
                    Byt lösenord
                </button>
            </form>
        </div>
    </div>
</div>

<?php
$this->renderView("take1/footer");
?>
