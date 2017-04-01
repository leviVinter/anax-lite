<?php
$navbar = [
    "brand" => "THOMAS",
    "config" => [
        "navbar-class" => "nav navbar-nav"
    ],
    "items" => [
        "home" => [
            "text" => "Hem",
            "route" => "",
        ],
        "report" => [
            "text" => "Redovisning",
            "route" => "report",
        ],
        "about" => [
            "text" => "Om",
            "route" => "about",
        ],
    ]
];

?>
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="<?= $app->url->create("") ?>">
                <?= $navbar["brand"] ?>
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
            <ul class="<?= $navbar["config"]["navbar-class"] ?>">

            <?php foreach ($navbar["items"] as $item) : ?>
                <li>
                    <a href="<?= $app->url->create($item["route"]) ?>">
                        <?= $item["text"] ?>
                    </a>
                </li>
            <?php endforeach; ?>

            </ul>
        </div>
    </div>
</nav>

