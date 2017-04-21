<?php
/**
 * Config file for the navbar.
 */
return [
    "config" => [
        "navbar-left-class" => "nav navbar-nav",
        "navbar-right-class" => "nav navbar-nav navbar-right"
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
    ],
    "items-right" => [
        "new_user" => [
            "text" => "Skapa konto",
            "route" => "new_user"
        ],
        "login" => [
            "text" => "Logga in",
            "route" => "login"
        ]
    ]
];
