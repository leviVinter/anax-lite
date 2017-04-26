<?php
$this->renderView("take1/header", [
    "title" => $res->title
]);
$this->renderView("navbar2/navbar");
?>

<div class="container">
    
    <div class="row">
        <div class="col-lg-12">
            <div class="page-header">
                <h1>
                    <?= $app->textfilter->esc($res->title) ?>
                </h1>
            </div>
            <p>
                <?= $app->textfilter->doFilter($res->data, $res->filter) ?>
            </p>
        </div>
    </div>
</div>

<?php
$this->renderView("take1/footer");
?>
