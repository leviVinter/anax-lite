<?php
$this->renderView("take1/header", [
    "title" => "Webshop Admin"
]);
$this->renderView("navbar2/navbar");
?>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-header">
                <h1>Admin Webshop</h1>
            </div>
            <ul class="nav nav-pills">
                <li role="presentation" class="active">
                    <a href="<?= $app->url->create('admin/webshop/create_product') ?>">
                        <span class="glyphicon glyphicon-plus"></span>
                    </a>
                </li>
            </ul>
            <br>
            <table class="table">
                <tr>
                    <th>Kategori</th>
                    <th>Namn</th>
                    <th>Antal</th>
                    <th>Hylla</th>
                    <th>Placering</th>
                    <th>Redigera</th>
                </tr>
            <?php foreach ($res as $row) : ?>
                <tr>
                    <td><?= $row->category ?></td>
                    <td><?= $row->product ?></td>
                    <td><?= $row->amount ?></td>
                    <td><?= $row->shelf ?></td>
                    <td><?= $row->location ?></td>
                    <td><a href="<?= $app->url->create("admin/webshop/product/{$row->id}") ?>">
                        <span class="glyphicon glyphicon-pencil"></span></a>
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
