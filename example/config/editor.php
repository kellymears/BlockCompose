<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Use WordPress Default Block Styles
    |--------------------------------------------------------------------------
    |
    | Core blocks include default styles. The styles are enqueued for editing
    | but are not enqueued for viewing unless the theme opts-in to the core
    | styles. Enable to utilize these default styles in your theme.
    |
    | @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/#default-block-styles
    |
    */

    'default_block_styles' => false,


    /*
    |--------------------------------------------------------------------------
    | Block Editor Scripts
    |--------------------------------------------------------------------------
    |
    | Scripts to be enqueued along with the WordPress block editor. These scripts
    | are not called on any admin or public pages that do not contain an editor
    | instance.
    |
    */

    'block_editor_scripts' => [[
        'name' => 'tiny/blocks',
        'file' => 'scripts/blocks.js',
    ]],

    'block_editor_styles' => [[
        'name' => 'tiny/blocks',
        'file' => 'styles/editor.css',
    ]],


    /*
    |--------------------------------------------------------------------------
    | Block Categories
    |--------------------------------------------------------------------------
    |
    | Additional categories for for the Block Editor inserter menu. The icon
    | can either be a dashicon or a path to an SVG file.
    |
    | @link https://developer.wordpress.org/block-editor/developers/filters/block-filters/#managing-block-categories
    |
    */

    'block_categories' => [[
        'slug'  => 'ndn',
        'title' => 'NDN',
        'icon'  => 'sticky'
    ]],


    /*
    |--------------------------------------------------------------------------
    | Block View Composers
    |--------------------------------------------------------------------------
    |
    | Block view composers provide a more convenient method for registering
    | blocks and also allow blocks to be rendered using certain Blade views.
    |
    */

    'view_composers' => [
        App\Blocks\About::class
    ],


    /*
    |--------------------------------------------------------------------------
    | Editor Color Palette
    |--------------------------------------------------------------------------
    |
    | Different blocks have the possibility of customizing colors. The block
    | editor provides a default palette, but a theme can overwrite it and provide
    | its own.
    |
    | @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/#block-color-palettes
    |
    */

    'color_palette' => [
        [
            'name' => __('strong magenta', 'themeLangDomain'),
            'slug' => 'strong-magenta',
            'color' => '#a156b4',
        ],
        [
            'name' => __('light grayish magenta', 'themeLangDomain'),
            'slug' => 'light-grayish-magenta',
            'color' => '#d0a5db',
        ],
        [
            'name' => __('very light gray', 'themeLangDomain'),
            'slug' => 'very-light-gray',
            'color' => '#eee',
        ],
        [
            'name' => __('very dark gray', 'themeLangDomain'),
            'slug' => 'very-dark-gray',
            'color' => '#444',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Disable Custom Color Palettes
    |--------------------------------------------------------------------------
    |
    | This flag will make sure users are only able to choose colors from the
    | editor-color-palette the theme provided or from the editor default
    | colors if the theme did not provide one.
    |
    | @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/#disabling-custom-colors-in-block-color-palettes
    |
    */

    'disable_color_palette' => true,


    /*
    |--------------------------------------------------------------------------
    | Editor Font Sizes
    |--------------------------------------------------------------------------
    |
    | Block view composers provide a more convenient method for registering
    | blocks and also allow blocks to be rendered using certain Blade views.
    |
    | @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/#block-font-sizes
    |
    */

    'font_sizes' => [
        [
            'name' => __('strong magenta', 'themeLangDomain'),
            'slug' => 'strong-magenta',
            'color' => '#a156b4',
        ],
        [
            'name' => __('light grayish magenta', 'themeLangDomain'),
            'slug' => 'light-grayish-magenta',
            'color' => '#d0a5db',
        ],
        [
            'name' => __('very light gray', 'themeLangDomain'),
            'slug' => 'very-light-gray',
            'color' => '#eee',
        ],
        [
            'name' => __('very dark gray', 'themeLangDomain'),
            'slug' => 'very-dark-gray',
            'color' => '#444',
        ],
    ],

    'disable_font_sizes' => false,


    /*
    |--------------------------------------------------------------------------
    | Editor Styles
    |--------------------------------------------------------------------------
    |
    | Block view composers provide a more convenient method for registering
    | blocks and also allow blocks to be rendered using certain Blade views.
    |
    | @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/#editor-styles
    |
    */

    'editor_styles' => true,
    'dark_editor_styles' => true,


    /*
    |--------------------------------------------------------------------------
    | Block Alignments
    |--------------------------------------------------------------------------
    |
    | Some blocks such as the image block have the possibility to define a
    | “wide” or “full” alignment by adding the corresponding classname to
    | the block’s wrapper ( alignwide or alignfull ).
    |
    | @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/#wide-alignment
    |
    */

    'supports_wide_alignments' => true,


    /*
    |--------------------------------------------------------------------------
    | Responsive Embeds
    |--------------------------------------------------------------------------
    |
    | The embed blocks automatically apply styles to embedded content to
    | reflect the aspect ratio of content that is embedded in an iFrame. To
    | make the content resize and keep its aspect ratio, the <body> element
    | needs the wp-embed-responsive class.
    |
    | @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/#responsive-embedded-content
    |
    */

    'responsive_embeds' => true,


    /*
    |--------------------------------------------------------------------------
    | Debug
    |--------------------------------------------------------------------------
    |
    | Currently will dd() displaying an array of data from WordPress related
    | to currently registered and enqueued scripts.
    |
    */

    'debug' => false,


];
