<?php
$this->renderView("take1/header", [
    "title" => "Radera Innehåll"
]);
$this->renderView("navbar2/navbar");
?>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-header">
                <h1>Radera</h1>
                <p class="lead">
                    Är du säker på att du vill radera nedanstående innehåll?
                </p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <form action="<?= $app->url->create('content/delete_validate') ?>"
                method="POST">
                <input type="hidden" name="id" value="<?= $id ?>">
                <div class="form-group">
                    <label for="title">Titel</label>
                    <input type="text" name="title" id="title"
                        class="form-control" readonly value="<?= $title ?>">
                </div>
                <button class="btn btn-primary" name="delete" type="submit">
                    Radera
                </button>
            </form>
        </div>
    </div>
</div>

<?php
$this->renderView("take1/footer");
?>
