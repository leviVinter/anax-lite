<?php
$this->renderView("take1/header", [
    "title" => "Logga in",
]);
$this->renderView("navbar2/navbar");
?>

<div class="container">
    <form action="<?= $app->url->create('new_user/validate') ?>"
        method="POST" class="form-signin">
        <h2 class="form-signin-heading">Skapa användare</h2>
        <?php if ($error) : ?>
        <div class="alert alert-danger" role="alert">
            <?php if ($error === "missmatch") : ?>
            Lösenorden matchar inte.
            <?php elseif ($error === "userexists") : ?>
            Användarnamnet är upptaget.
            <?php endif ?>
        </div>
        <?php endif ?>
        <label for="inputUser" class="sr-only">Användarnamn</label>
        <input type="text" id="inputUser" name="inputUser" class="form-control"
            placeholder="Användarnamn" required autofocus>
        <label for="inputPass" class="sr-only">Lösenord</label>
        <input type="password" id="inputPass" name="inputPass" class="form-control"
            placeholder="Lösenord" required>
        <label for="inputRePass" class="sr-only">Bekräfta lösenordet</label>
        <input type="password" id="inputRePass" name="inputRePass" class="form-control"
            placeholder="Bekräfta lösenordet" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">
            Skapa användare
        </button>
    </form>
</div>

<?php
$this->renderView("take1/footer");
?>

