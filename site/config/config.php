<?php

use Kirby\Cms\Block;
use Kirby\Cms\File;
use Kirby\Content\Field;

return [

    'debug' => env('KIRBY_DEBUG', false),

    'yaml' => [
        'handler' => 'symfony'
    ],
    'date' => [
        'handler' => 'intl'
    ],

    'languages' => env('KIRBY_MULTILANG', false),

    'panel' => [
        'install' => env('KIRBY_PANEL_INSTALL', false),
        'slug' => env('KIRBY_PANEL_SLUG', 'panel')
    ],

    'thumbs' => [
        'format' => 'webp',
        'quality' => 80,
        'presets' => [
            'default' => ['format' => 'webp', 'quality' => 80],
        ],
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

    // Default to token-based authentication
    'kql' => [
        'auth' => 'bearer'
    ],

    // See: https://github.com/johannschopplich/kirby-headless#toresolvedblocks
    'blocksResolver' => [
        'resolvers' => [
            // Resolve permalinks (containing UUIDs) to URLs inside the text field
            // of the text block
            'text:text' => function (Field $field, Block $block) {
                return $field->permalinksToUrls()->value();
            },
            // Resolve the team structure server-side to handle image transformations
            // and deep page links
            'team-structure:team' => function (Field $field, Block $block) {
                $structure = $field->toStructure();

                return $structure->map(function ($item) {
                    $image = $item->image()->toFile();

                    return [
                        'name' => $item->name()->value(),
                        'image' => [
                            'url' => $image?->url(),
                            'width' => $image?->width(),
                            'height' => $image?->height(),
                            'srcset' => $image?->srcset(),
                            'alt' => $image?->alt()->value()
                        ],
                        'link' => $item->link()->toPage()?->uri()
                    ];
                })->values();
            }
        ],
        'defaultResolvers' => [
            'files' => fn (File $image) => [
                'url' => $image->url(),
                'width' => $image->width(),
                'height' => $image->height(),
                'srcset' => $image->srcset(),
                'alt' => $image->alt()->value()
            ]
        ]
    ],

    // Kirby headless options
    'headless' => [
        // Enable returning Kirby templates as JSON
        'globalRoutes' => true,

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
            'allowHeaders' => env('KIRBY_HEADLESS_ALLOW_HEADERS', 'Accept, Content-Type, Authorization, X-Language'),
            'maxAge' => env('KIRBY_HEADLESS_MAX_AGE', '86400')
        ]
    ]

];
