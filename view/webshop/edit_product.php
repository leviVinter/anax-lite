<?php
$this->renderView("take1/header", [
    "title" => "Redigera Produkt"
]);
$this->renderView("navbar2/navbar");
$success = $app->request->getGet("success");
?>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <?php if ($success) : ?>
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert"
                    aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                Produktens information har uppdaterats.
            </div>
            <?php endif ?>
            <div class="page-header">
                <h1>Redigera produkt</h1>
            </div>
            <h2><?= $res->prodName ?></h2>
            <p><?= $res->description ?></p>
            <p><b>Pris: </b><?= $res->price ?> kr</p>
            <img src="<?= $app->url->asset("img/webshop/{$res->imageName}") ?>"
                class="image-webshop">
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <form action="<?= $app->url->create('admin/webshop/edit_validate') ?>"
                method="POST">
                <input type="hidden" name="id" value="<?= $res->prodId ?>">
                <div class="form-group">
                    <label for="name">Namn</label>
                    <input type="text" name="name" id="name"
                        class="form-control" value="<?= $res->prodName ?>">
                </div>
                <div class="form-group">
                    <label for="category">Kategori</label>
                    <select class="form-control" name="category" id="category">
                        <?php foreach ($categories as $category) : ?>
                        <option value="<?= $category->category ?>"
                            <?= $res->category === $category->category ? "selected" : "" ?>>
                            <?= $category->category ?>
                        </option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="amount">Antal</label>
                    <input type="number" name="amount" id="amount"
                        class="form-control" value="<?= $res->amount ?>">
                </div>
                <div class="form-group">
                    <label for="shelf">Hylla</label>
                    <select class="form-control" name="shelf" id="shelf">
                        <?php foreach ($shelves as $shelf) : ?>
                        <option value="<?= $shelf->shelf ?>"
                            <?= $res->shelf === $shelf->shelf ? "selected" : '' ?>>
                            <?= $shelf->shelf ?>
                        </option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="description">Beskrivning</label>
                    <textarea rows="5" name="description" id="description"
                        class="form-control"><?= $res->description ?></textarea>
                </div>
                <div class="form-group">
                    <label for="image">Bildfilnamn</label>
                    <input type="text" name="image" id="image"
                        class="form-control" value="<?= $res->imageName ?>">
                </div>
                <div class="form-group">
                    <label for="price">Pris</label>
                    <input type="number" name="price" id="price"
                        class="form-control" value="<?= $res->price ?>">
                </div>
                <button class="btn btn-primary" type="submit">
                    Uppdatera
                </button>
                <button class="btn btn-danger pull-right" type="submit" name="delete"
                    form="formdelete" value="<?= $res->prodId ?>">
                    Ta bort
                </button>
            </form>
            <form action="<?= $app->url->create('admin/webshop/remove_product') ?>"
                method="POST" id="formdelete">
            </form>
        </div>
    </div>
</div>

<?php
$this->renderView("take1/footer");
?>
