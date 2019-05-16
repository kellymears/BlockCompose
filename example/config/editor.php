<?php

return [

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
        'name' => 'sage/blocks',
        'file' => 'scripts/blocks.js',
    ]],

    'block_editor_styles' => [[
        'name' => 'sage/blocks',
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
    */

    'block_categories' => [[
        'slug'  => 'app',
        'title' => 'App blocks',
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
        App\Blocks\Card::class
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
