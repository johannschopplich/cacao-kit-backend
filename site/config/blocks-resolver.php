<?php

use Kirby\Cms\Block;
use Kirby\Cms\File;
use Kirby\Content\Field;

return [
    // Custom resolves for `block:field`
    'resolvers' => [
        // Resolve permalinks (containing UUIDs) to URLs inside the
        // field `text` of the `prose` block
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
];
