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

        add_theme_support('editor-color-palette', collect(config('editor.color_palette'))->toArray());

        if (config('editor.disable_color_palette')==true) {
            add_theme_support('disable-custom-colors');
        }

        add_theme_support('editor-font-sizes', collect(config('editor.font_sizes'))->toArray());

        if (config('editor.disable_color_palette')==true) {
            add_theme_support('disable-custom-font-sizes');
        }

        if (config('editor.supports_wide_alignments')==true) {
            add_theme_support('align-wide');
        }

        if (config('editor.default_block_styles')==true) {
            add_theme_support('wp-block-styles');
        }

        if (config('editor.editor_styles')==true) {
            add_theme_support('editor-styles');
        }

        if (config('editor.dark_editor_styles')==true) {
            add_theme_support('dark-editor-style');
        }

        if (config('responsive_embeds')==true) {
            add_theme_support('responsive-embeds');
        }

        add_action('admin_print_scripts', function () {
            if (\Roots\config('editor.debug')==true) {
                global $wp_scripts;
                dd($wp_scripts);
            }
        });
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
