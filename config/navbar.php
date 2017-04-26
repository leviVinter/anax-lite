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
        "assignments" => [
            "text" => "Uppgifter",
            "items" => [
                "session" => [
                    "text" => "Session",
                    "route" => "session"
                ],
                "calendar" => [
                    "text" => "Kalender",
                    "route" => "calendar"
                ],
                "textfilter" => [
                    "text" => "Textfilter",
                    "route" => "textfilter"
                ]
            ],
            "dropdown-menu" => true
        ],
        "content" => [
            "text" => "Innehåll",
            "items" => [
                "pages" => [
                    "text" => "Pages",
                    "route" => "content/pages"
                ],
                "blog" => [
                    "text" => "Blogg",
                    "route" => "content/blogs"
                ],
                "block" => [
                    "text" => "Block",
                    "route" => "content/blocks"
                ]
            ],
            "dropdown-menu" => true
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
