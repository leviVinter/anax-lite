<?php
$this->renderView("take1/header", [
    "title" => $res->title
]);
$this->renderView("navbar2/navbar");
?>

<div class="container">
    
    <div class="row">
        <div class="col-lg-12">
            <div class="blog-post">
                <h1 class="blog-post-title">
                    <?= $app->textfilter->esc($res->title) ?>
                </h1>
                <p class="blog-post-meta">
                    <?= $app->textfilter->esc($res->created) ?>
                </p>
                <p>
                    <?= $app->textfilter->doFilter($res->data, $res->filter) ?>
                </p>
            </div>
        </div>
    </div>
</div>

<?php
$this->renderView("take1/footer");
?>
