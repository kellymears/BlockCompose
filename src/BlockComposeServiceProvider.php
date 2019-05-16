<?php

namespace TinyPixel\BlockCompose;

use \TinyPixel\BlockCompose\BaseServiceProvider;

class BlockComposeServiceProvider extends BaseServiceProvider
{
    /**
     * Service register
     */
    public function register()
    {
        $this->bindFromDir('Blocks');
    }

    /**
     * Service boot
     */
    public function boot()
    {
        $this->processEditorScripts(
            collect(config('editor.block_editor_scripts'))
        );

        $this->processScripts(
            collect(config('editor.scripts'))
        );

        $this->processEditorStyles(
            collect(config('editor.block_editor_styles'))
        );

        $this->processStyles(
            collect(config('editor.styles'))
        );

        $this->registerBlockCategories(
            collect(config('editor.block_categories'))
        );
    }

    /**
     * Initialize blocks and compose views
     **/
    public function withBound()
    {
        foreach ($this->bound as $block) {
            $this->app[$block]->compose();
        }
    }

    public function processEditorScripts($scripts)
    {
        add_action('init', function () use ($scripts) {
            $scripts->each(function ($script) {
                wp_register_script(
                    $script['name'],
                    asset($script['file'])->uri(),
                    ['wp-editor', 'wp-element', 'wp-blocks'],
                    '',
                    null,
                    true,
                );
            });
        });
    }

    public function processEditorStyles($styles)
    {
        add_action('enqueue_block_editor_assets', function () use ($styles) {
            $styles->each(function ($style) {
                wp_enqueue_style(
                    $style['name'],
                    asset($style['file'])->uri(),
                    false,
                    null,
                    'all',
                );
            });
        });
    }

    public function processScripts()
    {
        // ...
    }

    public function processStyles()
    {
        // ...
    }

    public function registerBlockCategories($newCategories)
    {
        add_filter('block_categories', function ($categories, $post) use ($newCategories) {
            collect(config('editor.block_categories'))->each(function ($category) {
                $categories[] = [
                    'slug'  => $category['slug'],
                    'title' => $category['title'],
                    'icon'  => $category['icon'],
                ];
            });

            return $categories;
        }, 10, 2);
    }
}
