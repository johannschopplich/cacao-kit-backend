<?php

return [

    'debug' => env('KIRBY_DEBUG', false),

    'languages' => env('KIRBY_MULTILANG', false),

    'panel' => [
        'install' => env('KIRBY_PANEL_INSTALL', false),
        'slug' => env('KIRBY_PANEL_SLUG', 'panel')
    ],

    'thumbs' => [
        'quality' => '80',
        'format' => 'webp',
        'srcsets' => [
            'default' => [360, 720, 1024, 1280, 1536]
        ]
    ],

    'cache' => [
        'pages' => [
            'active' => env('KIRBY_CACHE', false),
            'ignore' => fn (\Kirby\Cms\Page $page) => $page->kirby()->user() !== null
        ]
    ],

    // Enable basic authentication for the API and thus KQL
    'api' => [
        'basicAuth' => true
    ],

    // Default to token-based authentication
    'kql' => [
        'auth' => 'bearer'
    ],

    'blocksResolver' => [
        // Resolve UUIDs inside blocks (for KQL queries)
        'files' => [
            // Block name as key, field name as value
            // Resolve the built-in `image` field of the `image` block
            'image' => ['image']
        ],
        // Resolve UUIDS inside nested blocks (for KQL queries)
        'nested' => [
            'prose'
        ]
    ],

    'resolvers' => [
        // Resolver for each file object from a `files` field
        'files' => fn ($image) => [
            'url' => $image->url(),
            'width' => $image->width(),
            'height' => $image->height(),
            'srcset' => $image->srcset(),
            'alt' => $image->alt()->value()
        ]
    ],

    // Kirby headless options
    'headless' => [
        // Optional API token to use for authentication, also used
        // for for KQL endpoint
        'token' => env('KIRBY_HEADLESS_API_TOKEN'),

        'panel' => [
            // Preview URL for the Panel preview button
            'frontendUrl' => env('KIRBY_HEADLESS_FRONTEND_URL'),
            // Redirect to the Panel if no authorization header is sent,
            // useful for editors visiting the site directly
            'redirect' => true
        ],

        'cors' => [
            'allowOrigin' => env('KIRBY_HEADLESS_ALLOW_ORIGIN', '*'),
            'allowMethods' => env('KIRBY_HEADLESS_ALLOW_METHODS', 'GET, POST, OPTIONS'),
            'allowHeaders' => env('KIRBY_HEADLESS_ALLOW_HEADERS', '*'),
            'maxAge' => env('KIRBY_HEADLESS_MAX_AGE', '86400')
        ]
    ]

];
