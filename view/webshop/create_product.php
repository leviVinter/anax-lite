<?php
$this->renderView("take1/header", [
    "title" => "Lägg till produkt"
]);
$this->renderView("navbar2/navbar");
?>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-header">
                <h1>Lägg till produkt</h1>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <form action="<?= $app->url->create('admin/webshop/create_validate') ?>"
                method="POST">
                <div class="form-group">
                    <label for="name">Namn</label>
                    <input type="text" name="name" id="name"
                        class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="amount">Antal</label>
                    <input type="number" name="amount" id="amount"
                        class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="shelf">Hylla</label>
                    <select class="form-control" name="shelf" id="shelf">
                        <?php foreach ($shelves as $shelf) : ?>
                        <option value="<?= $shelf->shelf ?>">
                            <?= $shelf->shelf ?>
                        </option>
                        <?php endforeach ?>
                    </select>
                </div>
                <button class="btn btn-primary" type="submit">
                    Skapa
                </button>
            </form>
        </div>
    </div>
</div>

<?php
$this->renderView("take1/footer");
?>
