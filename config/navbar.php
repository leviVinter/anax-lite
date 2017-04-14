<?php
/**
 * Config file for the navbar.
 */
return [
    "brand" => "THOMAS",
    "config" => [
        "navbar-left-class" => "nav navbar-nav"
    ],
    "items" => [
        "home" => [
            "text" => "Hem",
            "route" => ""
        ],
        "session" => [
            "text" => "Session",
            "route" => "session"
        ],
        "calendar" => [
            "text" => "Kalender",
            "route" => "calendar"
        ],
        "report" => [
            "text" => "Redovisning",
            "route" => "report"
        ],
        "about" => [
            "text" => "Om",
            "route" => "about"
        ],
    ]
];
