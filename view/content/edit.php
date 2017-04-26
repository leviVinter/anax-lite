<?php
$this->renderView("take1/header", [
    "title" => $res->title
]);
$this->renderView("navbar2/navbar");
$success = $app->request->getGet("success");
$error = $app->request->getGet("error");
?>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-header">
                <h1><?= $app->textfilter->esc($res->title) ?></h1>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <?php if ($success) : ?>
            <div class="alert alert-success" role="alert">
                Innehållet har uppdaterats.
            </div>
            <?php elseif ($error === "slug") : ?>
            <div class="alert alert-danger" role="alert">
                Innehållets slug är upptaget
            </div>
            <?php endif ?>
            <form action="<?= $app->url->create('content/edit_validate') ?>"
                method="POST">
                <div class="form-group">
                    <button class="btn btn-primary" type="reset">
                        Återställ
                    </button>
                    <button class="btn btn-danger" name="delete" type="submit">
                        Radera
                    </button>
                </div>
                <input type="hidden" name="id" value="<?= $res->id ?>">
                <div class="form-group">
                    <label for="title">Titel</label>
                    <input type="text" name="title" id="title"
                        class="form-control" value="<?= $res->title ?>">
                </div>
                <div class="form-group">
                    <label for="path">Path</label>
                    <input type="text" name="path" id="path"
                        class="form-control" value="<?= $res->path ?>">
                </div>
                <div class="form-group">
                    <label for="slug">Slug</label>
                    <input type="text" name="slug" id="slug"
                        class="form-control" value="<?= $res->slug ?>">
                </div>
                <div class="form-group">
                    <label for="data">Text</label>
                    <textarea rows="5" name="data" id="data"
                        class="form-control"><?= $res->data ?></textarea>
                </div>
                <div class="form-group">
                    <label for="type">Typ (ex. page, post eller block)</label>
                    <input type="text" name="type" id="type"
                        class="form-control" value="<?= $res->type ?>">
                </div>
                <div class="form-group">
                    <label for="filter">Filter (ex. bbcode,clickable,markdown,nl2br,strip)</label>
                    <input type="text" name="filter" id="filter"
                        class="form-control" value="<?= $res->filter ?>">
                </div>
                <div class="form-group">
                    <label for="published">Publicerad (YYYY-MM-DD HH:MM:SS)</label>
                    <input type="text" name="published" id="published"
                        class="form-control" value="<?= $res->published ?>">
                </div>
                <button class="btn btn-primary" name="update" type="submit">
                    Uppdatera
                </button>
            </form>
        </div>
    </div>
</div>

<?php
$this->renderView("take1/footer");
?>
