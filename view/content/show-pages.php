<?php
$this->renderView("take1/header", [
    "title" => $title,
]);
$this->renderView("navbar2/navbar");
?>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-header">
                <h1><?= $header ?></h1>
            </div>
            <table class="table">
                <tr>
                    <th>Id</th>
                    <th>Titel</th>
                    <th>Path</th>
                    <th>Slug</th>
                    <th>Skapad</th>
                    <th>Publicerad</th>
                    <th>Updaterad</th>
                </tr>
            <?php foreach ($res as $row) : ?>
            <?php if ($row->status === "isPublished") : ?>
                <tr>
                    <td><?= $app->textfilter->esc($row->id) ?></td>
                    <td><a href="<?= $app->url->create("content/page/{$row->path}") ?>">
                        <?= $app->textfilter->esc($row->title) ?></a>
                    </td>
                    <td><?= $app->textfilter->esc($row->path) ?></td>
                    <td><?= $app->textfilter->esc($row->slug) ?></td>
                    <td><?= $app->textfilter->esc($row->created) ?></td>
                    <td><?= $app->textfilter->esc($row->published) ?></td>
                    <td><?= $app->textfilter->esc($row->updated) ?></td>
                </tr>
            <?php endif ?>
            <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>
<?php
$this->renderView("take1/footer");
?>
