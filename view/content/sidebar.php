<div class="col-sm-3 sidebar">
    <h4><?= $app->textfilter->esc($sidebar->title) ?></h4>
    <div class="sidebar-list">
        <?= $app->textfilter->doFilter($sidebar->data, $sidebar->filter) ?>
    </div>
</div>
