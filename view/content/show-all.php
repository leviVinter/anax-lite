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
            <ul class="nav nav-pills">
                <li role="presentation" class="active">
                    <a href="<?= $app->url->create('content/create') ?>">
                        <span class="glyphicon glyphicon-plus"></span>
                    </a>
                </li>
            </ul>
            <br>
            <table class="table">
                <tr>
                    <th>Id</th>
                    <th>Titel</th>
                    <th>Typ</th>
                    <th>Path</th>
                    <th>Slug</th>
                    <th>Skapad</th>
                    <th>Publicerad</th>
                    <th>Updaterad</th>
                    <th>Borttagen</th>
                    <th>Redigera</th>
                </tr>
            <?php foreach ($res as $row) : ?>
                <tr>
                    <td><?= $app->textfilter->esc($row->id) ?></td>
                    <td><?= $app->textfilter->esc($row->title) ?></td>
                    <td><?= $app->textfilter->esc($row->type) ?></td>
                    <td><?= $app->textfilter->esc($row->path) ?></td>
                    <td><?= $app->textfilter->esc($row->slug) ?></td>
                    <td><?= $app->textfilter->esc($row->created) ?></td>
                    <td><?= $app->textfilter->esc($row->published) ?></td>
                    <td><?= $app->textfilter->esc($row->updated) ?></td>
                    <td><?= $app->textfilter->esc($row->deleted) ?></td>
                    <td>
                        <a href="<?= $app->url->create("content/edit/{$row->id}") ?>">
                            <span class="glyphicon glyphicon-pencil"></span>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>
<?php
$this->renderView("take1/footer");
?>
