<?php
$this->renderView("take1/header", [
    "title" => "Admin",
]);
$this->renderView("navbar2/navbar");
$page = $app->helpers->getGet('page', 1);
$prevPage = is_numeric($page) && intval($page) > 1
    ? intval($page) - 1
    : null;
$nextPage = is_numeric($page) && intval($page) < intval($max)
    ? intval($page) + 1
    : null;
?>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <?php if ($success) : ?>
            <div class="alert alert-success" role="alert">
                Användaren <?= $success ?> har raderats.
            </div>
            <?php endif ?>
            <div class="page-header">
                <h1>Admin</h1>
            </div>
            <ul class="nav nav-pills">
                <li role="presentation" class="active">
                    <a href="<?= $app->url->create('logout') ?>">
                        Logga ut
                    </a>
                </li>
                <li role="presentation" class="active">
                    <a href="<?= $app->url->create('new_user') ?>">
                        Skapa användare
                    </a>
                </li>
                <li role="presentation" class="active">
                    <a href="<?= $app->url->create('content/edit') ?>">
                        Innehåll
                    </a>
                </li>
                <li role="presentation" class="active">
                    <a href="<?= $app->url->create('admin/webshop') ?>">
                        Webbshoppen
                    </a>
                </li>
            </ul>
            <br>
        </div>
        <div class="col-lg-6">
            <form action="<?= $app->url->create('admin') ?>"
                method="GET">
                <div class="input-group input-group-md">
                    <input type="text" class="form-control" name="search"
                        value="<?= $searchText ?>" placeholder="Sök användare"
                        required>
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-primary">Sök</button>
                    </span>
                </div>
            </form>
        </div>
        <?php if ($res) : ?>
        <div class="col-lg-12">
            <br>
            <h3>Användare</h3>
            <p>Antal per sida:
                <a href="<?= $app->helpers->mergeQueryString(['hits' => 2]) ?>">2</a>
                <a href="<?= $app->helpers->mergeQueryString(['hits' => 4]) ?>">4</a>
                <a href="<?= $app->helpers->mergeQueryString(['hits' => 8]) ?>">8</a>
            </p>
            <table class="table">
                <tr>
                    <th>Id <?= $app->helpers->orderby2("id") ?></th>
                    <th>Namn <?= $app->helpers->orderby2("name") ?></th>
                    <th>Redigera</th>
                    <th>Radera</th>
                </tr>
            <?php foreach ($res as $row) : ?>
                <tr>
                    <td><?= $row->id ?></td>
                    <td><?= $row->name ?></td>
                    <td><a href="<?= $app->url->create("admin/edit?name={$row->name}") ?>">
                        <span class="glyphicon glyphicon-pencil"></span></a>
                    </td>
                    <td><a href="<?= $app->url->create("admin/delete?name={$row->name}") ?>">
                        <span class="glyphicon glyphicon-remove"></span></a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </table>
            <nav aria-label="Page navigation">
                <ul class="pagination">
                <li class="<?= $prevPage ? '' : 'disabled' ?>">
                    <a href="<?= $app->helpers->mergeQueryString(['page' => $prevPage]) ?>"
                        aria-label="Previous"><span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <?php for ($i = 1; $i <= $max; $i++) : ?>
                    <li class="<?= intval($page) === $i ? 'active' : null ?>">
                        <a href="<?= $app->helpers->mergeQueryString(["page" => $i]) ?>">
                            <?= $i ?>
                        </a>
                    </li>
                <?php endfor; ?>
                <li class="<?= $nextPage ? '' : 'disabled' ?>">
                    <a href="<?= $app->helpers->mergeQueryString(['page' => $nextPage]) ?>"
                        aria-label="Next"><span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
                </ul>
            </nav>
        </div>
        <?php endif ?>
    </div>
</div>
<?php
$this->renderView("take1/footer");
?>
