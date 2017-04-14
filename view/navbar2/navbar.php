<?php
    $navbar = $app->navbar;
    $config = $navbar->getConfig();
?>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="<?= $navbar->getUrl("") ?>">
                <?= $config["brand"] ?>
            </a>
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="<?= $config["config"]["navbar-left-class"] ?>">

            <?php foreach ($config["items"] as $item) : ?>
                <li <?php if ($item["route"] == $navbar->getCurrentRoute()) : ?>
                    class="active"
                    <?php endif ?>
                    ><a href="<?= $navbar->getUrl($item["route"]) ?>">
                        <?= $item["text"] ?>
                    </a>
                </li>
            <?php endforeach; ?>

            </ul>
        </div>
    </div>
</nav>
