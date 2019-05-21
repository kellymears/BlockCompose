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

    'editor_plugin_scripts' => [[
        'name' => 'tiny/plugins',
        'file' => 'scripts/plugin.js',
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

    'block_categories' => [
        [
            'slug'  => 'specialsauce',
            'title' => 'Custom Blocks',
            'icon'  => 'sticky'
        ]
    ],

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
        App\Blocks\Card::class
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
            'name' => __('native scarlet', 'sage'),
            'slug' => 'native-scarlet',
            'color' => '#C31425',
        ],
        [
            'name' => __('kuroi', 'sage'),
            'slug' => 'light-grayish-magenta',
            'color' => '#101820',
        ],
        [
            'name' => __('very light gray', 'sage'),
            'slug' => 'very-light-gray',
            'color' => '#eee',
        ],
        [
            'name' => __('very dark gray', 'sage'),
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

    'disable_custom_color_palette' => true,

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
            'name' => __('Small', 'sage'),
            'size' => 12,
            'slug' => 'small'
        ],
        [
            'name' => __('Normal', 'sage'),
            'size' => 16,
            'slug' => 'normal'
        ],
        [
            'name' => __('Large', 'sage'),
            'size' => 36,
            'slug' => 'large'
        ],
        [
            'name' => __('Huge', 'sage'),
            'size' => 50,
            'slug' => 'huge'
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Disable Custom Color Palettes
    |--------------------------------------------------------------------------
    |
    | This flag will make sure users are only able to choose font sizes from the
    | font_sizes the theme provided or from the editor default
    | font_sizes if the theme did not provide one.
    |
    | @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/#disabling-custom-font-sizes
    |
    */

    'disable_custom_font_sizes' => false,

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
    | the block’s wrapper (alignwide or alignfull).
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
    | Display Reusable Blocks in the Admin Menu
    |--------------------------------------------------------------------------
    |
    | By default, Reusable Blocks are a built-in posttype which is not
    | displayed in the admin menu. Setting to true will display them the same
    | as any normal WordPress posttype.
    |
    */

    'reusable_blocks_unlock' => true,

    /*
    |--------------------------------------------------------------------------
    | Reusable Blocks Icon
    |--------------------------------------------------------------------------
    |
    | Specify an icon to use with the Reusable blocks. Obviously has no effect
    | if the 'reusable_blocks_unlock' config flag is not set to `true`.
    |
    */

    'reusable_blocks_icon' => 'dashicons-layout',

    /*
    |--------------------------------------------------------------------------
    | Display Reusable Blocks in the Admin Menu
    |--------------------------------------------------------------------------
    |
    | Modify the labels used for Reusable blocks.
    |
    */

    'reusable_blocks_labels' => [
        'name'                     => _x('Blocks', 'post type general name', 'gutenberg'),
        'singular_name'            => _x('Block', 'post type singular name', 'gutenberg'),
        'menu_name'                => _x('Blocks', 'admin menu', 'gutenberg'),
        'name_admin_bar'           => _x('Block', 'add new on admin bar', 'gutenberg'),
        'add_new'                  => _x('Add New', 'Block', 'gutenberg'),
        'add_new_item'             => __('Add New Block', 'gutenberg'),
        'new_item'                 => __('New Block', 'gutenberg'),
        'edit_item'                => __('Edit Block', 'gutenberg'),
        'view_item'                => __('View Block', 'gutenberg'),
        'all_items'                => __('All Blocks', 'gutenberg'),
        'search_items'             => __('Search Blocks', 'gutenberg'),
        'not_found'                => __('No blocks found.', 'gutenberg'),
        'not_found_in_trash'       => __('No blocks found in Trash.', 'gutenberg'),
        'filter_items_list'        => __('Filter blocks list', 'gutenberg'),
        'items_list_navigation'    => __('Blocks list navigation', 'gutenberg'),
        'items_list'               => __('Blocks list', 'gutenberg'),
        'item_published'           => __('Block published.', 'gutenberg'),
        'item_published_privately' => __('Block published privately.', 'gutenberg'),
        'item_reverted_to_draft'   => __('Block reverted to draft.', 'gutenberg'),
        'item_scheduled'           => __('Block scheduled.', 'gutenberg'),
        'item_updated'             => __('Block updated.', 'gutenberg'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Reusable blocks meta data
    |--------------------------------------------------------------------------
    |
    | Add Post Meta support for reusable blocks
    |
    */

    'reusable_blocks_enable_custom_fields' => true,

    /*
    |--------------------------------------------------------------------------
    | Enable reusable blocks WP GraphQL support
    |--------------------------------------------------------------------------
    |
    | This flag does not do anything if wpgraphql/wpgraphql is not present
    | in this environment
    |
    | @link https://github.com/wp-graphql/wp-graphql
    |
    */

    'reusable_blocks_expose_to_graphql' => true,

    /*
    |--------------------------------------------------------------------------
    | Reusable blocks ACL
    |--------------------------------------------------------------------------
    |
    | Modify the permissions for reusable blocks
    |
    */

    'reusable_blocks_capability_type' => 'block',

    'reusable_block_capabilities' => [
        'read'         => 'read_blocks',
        'create_posts' => 'create_posts',
    ],

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
