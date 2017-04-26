<?php
$this->renderView("take1/header", [
    "title" => "Skapa nytt innehåll"
]);
$this->renderView("navbar2/navbar");
?>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-header">
                <h1>Skapa nytt innehåll</h1>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <form action="<?= $app->url->create('content/create_validate') ?>"
                method="POST">
                <div class="form-group">
                    <label for="title">Titel</label>
                    <input type="text" name="title" id="title"
                        class="form-control">
                </div>
                <button class="btn btn-primary" name="create" type="submit">
                    Skapa
                </button>
            </form>
        </div>
    </div>
</div>

<?php
$this->renderView("take1/footer");
?>
