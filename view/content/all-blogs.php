<?php
$this->renderView("take1/header", [
    "title" => "Blogs"
]);
$this->renderView("navbar2/navbar");
?>

<div class="container">
    <div class="blog-header">
        <h1 class="blog-title">Bloggen</h1>
        <p class="lead">Du kan välja att se en blogg enskilt genom att klicka
            på den medföljande länken.
        </p>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <?php foreach ($res as $row) : ?>
            <?php if ($row->status === 'isPublished') : ?>
            <div class="blog-post">
                <h2 class="blog-post-title">
                    <?= $app->textfilter->esc($row->title) ?>
                </h2>
                <p class="blog-post-meta">
                    <?= $app->textfilter->esc($row->created) ?>
                </p>
                <p>
                    <?= $app->textfilter->doFilter($row->data, $row->filter) ?>
                </p>
                <p><a href="<?= $app->url->create("content/blog/{$row->slug}") ?>">
                    Läs mer &raquo;</a></p>
            </div>
            <?php endif ?>
            <?php endforeach ?>
        </div>
    </div>
</div>

<?php
$this->renderView("take1/footer");
?>
