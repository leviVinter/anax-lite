<?php
$this->renderView("take1/header", [
    "title" => "Admin",
]);
$this->renderView("navbar2/navbar");
?>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <?php if ($success) : ?>
            <div class="alert alert-success" role="alert">
                <?php if ($success === "password") : ?>
                Lösenordet har uppdaterats.
                <?php elseif ($success === "profile") : ?>
                Användarens profil har uppdaterats.
                <?php endif ?>
            </div>
            <?php endif ?>
            <div class="page-header">
                <h1>Redigera användare &ldquo;<?= $user->name ?>&rdquo;</h1>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <form action="<?= $app->url->create('admin/edit_validate') ?>"
                method="POST">
                <input type="hidden" name="userName" value="<?= $user->name ?>">
                <div class="form-group">
                    <label for="present">Presentation</label>
                    <textarea rows="5" name="present" id="present"
                        class="form-control"><?= $user->presentation ?></textarea>
                </div>
                <div class="form-group">
                    <label for="favMovie">Favoritfilm</label>
                    <input type="text" name="favMovie" id="favMovie"
                        class="form-control" value="<?= $user->fav_movie ?>">
                </div>
                <div class="form-group">
                    <label for="favColor">Favoritfärg</label>
                    <input type="text" name="favColor" id="favColor"
                        class="form-control" value="<?= $user->fav_color ?>">
                </div>
                <button class="btn btn-primary" type="submit">
                    Uppdatera
                </button>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <form action="<?= $app->url->create('admin/change_password') ?>"
                method="POST">
                <h2>Byt lösenord</h2>
                <?php if ($error) : ?>
                <div class="alert alert-danger" role="alert">
                    <?php if ($error === "missmatch") : ?>
                    Lösenorden matchade inte varandra.
                    <?php endif ?>
                </div>
                <?php endif ?>
                <input type="hidden" name="userName" value="<?= $user->name ?>">
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
