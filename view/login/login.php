<?php
$this->renderView("take1/header", [
    "title" => "Logga in",
]);
$this->renderView("navbar2/navbar");
?>

<div class="container">
    <form action="<?= $app->url->create('login/validate') ?>"
        method="POST" class="form-signin">
        <h2 class="form-signin-heading">Logga in</h2>
        <?php if ($error) : ?>
        <div class="alert alert-danger" role="alert">
            <?php if ($error === "wrong") : ?>
            Uppgifterna matchar inte någon registrerad användare.
            <?php elseif ($error === "notfilled") : ?>
            Både användarnamn och lösenord måste vara ifyllda.
            <?php endif ?>
        </div>
        <?php elseif ($logout) : ?>
        <div class="alert alert-info" role="alert">
            Du är utloggad.
        </div>
        <?php endif ?>
        <label for="inputUser" class="sr-only">Användarnamn</label>
        <input type="text" id="inputUser" name="inputUser" class="form-control"
            placeholder="Användarnamn" required autofocus>
        <label for="inputPass" class="sr-only">Lösenord</label>
        <input type="password" id="inputPass" name="inputPass" class="form-control"
            placeholder="Lösenord" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">
            Logga in
        </button>
    </form>
</div>

<?php
$this->renderView("take1/footer");
?>
