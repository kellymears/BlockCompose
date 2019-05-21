<?php

namespace TinyPixel\BlockCompose;

use \TinyPixel\BlockCompose\BaseServiceProvider;

use function \Roots\asset;
use function \Roots\config;

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
        $this->readConfig();
        $this->setAssets();
        $this->setOptions();
        add_action('init', [$this, 'setReusableBlockOptions']);
        add_action('rest_init', [$this, 'setEndpoints']);
    }

    public function setOptions()
    {
        ! $this->categories->isEmpty()    ? $this->setCategories()   : null;
        ! $this->color_palette->isEmpty() ? $this->setColorPalette() : null;
        ! $this->font_sizes->isEmpty()    ? $this->setFontSizes()    : null;

        $this->disable_font_sizes     ? $this->disableCustomFontSizes() : null;
        $this->disable_custom_colors  ? $this->disableCustomColors()    : null;
        $this->supports_wide_align    ? $this->enableWideAlign()        : null;
        $this->uses_default_styles    ? $this->enableDefaultStyles()    : null;
        $this->supports_editor_styles ? $this->enableEditorStyle()      : null;
        $this->supports_dark_styles   ? $this->enableDarkEditorStyle()  : null;
        $this->responsive_embeds      ? $this->enableResponsiveEmbeds() : null;
        $this->expose_to_graphql      ? $this->enableGraphQL()          : null;
        $this->script_debug           ? $this->enableScriptDebug()      : null;
    }

    public function setAssets()
    {
        ! $this->editor_scripts->isEmpty()
            ? add_action('init', [$this, 'setEditorScripts'])
            : null;

        ! $this->editor_styles->isEmpty()
            ? add_action('enqueue_block_editor_assets', [$this, 'setEditorStyles'])
            : null;

        ! $this->styles->isEmpty()
            ? add_action('wp_enqueue_scripts', [$this, 'setStyles'])
            : null;

        ! $this->scripts->isEmpty()
            ? add_action('wp_enqueue_scripts', [$this, 'setScripts'])
            : null;
    }


    /**
     * Read configuration file
     */
    public function readConfig()
    {
        $this->editor_scripts = collect(config('editor.block_editor_scripts'));
        $this->editor_plugins = collect(config('editor.editor_plugin_scripts'));
        $this->scripts        = collect(config('editor.scripts'));
        $this->styles         = collect(config('editor.styles'));
        $this->editor_styles  = collect(config('editor.block_editor_styles'));
        $this->categories     = collect(config('editor.block_categories'));
        $this->color_palette  = collect(config('editor.color_palette'));
        $this->font_sizes     = collect(config('editor.font_sizes'));

        $this->disable_font_sizes     = config('editor.disable_custom_font_sizes');
        $this->disable_custom_colors  = config('editor.disable_custom_color_palette');
        $this->supports_wide_align    = config('editor.supports_wide_alignments');
        $this->uses_default_styles    = config('editor.default_block_styles');
        $this->supports_editor_styles = config('editor.editor_styles');
        $this->supports_dark_styles   = config('editor.dark_editor_styles');
        $this->responsive_embeds      = config('editor.responsive_embeds');
        $this->script_debug           = config('editor.debug');
        $this->reusable_unlock        = config('editor.reusable_blocks_unlock');
        $this->reusable_icon          = config('editor.reusable_blocks_icon');
        $this->reusable_block_labels  = config('editor.reusable_blocks_labels');
        $this->reusable_custom_fields = config('editor.reusable_blocks_enable_custom_fields');
        $this->reusable_cap_type      = config('editor.reusable_blocks_capability_type');
        $this->reusable_caps          = config('editor.reusable_blocks_capabilities');
        $this->expose_to_graphql      = config('editor.reusable_blocks_expose_to_graphql');
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

    /**
     * wp register script calls
     */
    public function setEditorScripts()
    {
        $deps = [
            'wp-editor',
            'wp-element',
            'wp-blocks'
        ];

        $plugin_deps = [
            'wp-editor',
            'wp-element',
            'wp-plugins',
            'wp-dom-ready',
            'wp-edit-post'
        ];

        $this->editor_scripts->each(function ($script) use ($deps) {
            wp_register_script(
                $script['name'],
                asset($script['file'])->uri(),
                $deps,
                '',
                null,
                true
            );
        });

        $this->editor_plugins->each(function ($script) use ($plugin_deps) {
            wp_enqueue_script(
                $script['name'],
                asset($script['file'])->uri(),
                $plugin_deps,
                '',
                null,
                true
            );
        });
    }

    /**
     * wp enqueue style calls
     */
    public function setEditorStyles()
    {
        $this->editor_styles->each(function ($style) {
            // wp_enqueue_style($style['name'], asset($style['file'])->uri(), false, null, 'all');
        });
    }

    /**
     * Enqueue frontend scripts
     */
    public function setScripts()
    {
        // ...
    }

    /**
     * Enqueue frontend styles
     */
    public function setStyles()
    {
        // ...
    }

    /**
     * Add inserter categories
     */
    public function setCategories()
    {
        add_filter('block_categories', function ($categories, $post) {
            $this->categories->each(function ($category) {
                $categories[] = [
                    'slug'  => $category['slug'],
                    'title' => $category['title'],
                    'icon'  => $category['icon'],
                ];
            });

            return $categories;
        }, 10, 2);
    }

    /**
     * Set color palette
     */
    public function setColorPalette()
    {
        add_theme_support('editor-color-palette', $this->color_palette->toArray());
    }

    /**
     * Set font sizes
     */
    public function setFontSizes()
    {
        add_theme_support('editor-font-sizes', $this->font_sizes->toArray());
    }

    /**
     * Disable custom font sizes
     */
    public function disableCustomFontSizes()
    {
        add_theme_support('disable-custom-font-sizes');
    }

    /**
     * Disable custom colors
     */
    public function disableCustomColors()
    {
        add_theme_support('disable-custom-colors');
    }

    /**
     * Enable special alignment options
     */
    public function enableWideAlign()
    {
        add_theme_support('align-wide');
    }

    /**
     * Enable default styles
     */
    public function enableDefaultStyles()
    {
        add_theme_support('wp-block-styles');
    }

    /**
     * Enable editor style
     */
    public function enableEditorStyle()
    {
        add_theme_support('editor-styles');
    }

    /**
     * Enable dark editor style
     */
    public function enableDarkEditorStyle()
    {
        add_theme_support('dark-editor-style');
    }

    /**
     * Enable responsive embeds
     */
    public function enableResponsiveEmbeds()
    {
        add_theme_support('responsive-embeds');
    }

    /**
     * Set reusable block options
     */
    public function setReusableBlockOptions()
    {
        $this->type = get_post_type_object('wp_block');

        if ($this->reusable_unlock==true) {
            $this->type->_builtin = false;
            $this->type->show_in_menu = true;
        }

        if ($this->reusable_icon) {
            $this->type->menu_icon = $this->reusable_icon;
        }

        if ($this->reusable_block_labels) {
            $this->type->labels = (object) array_merge(
                $this->reusable_block_labels,
                (array) $this->type->labels
            );
        }

        if ($this->reusable_custom_fields==true) {
            $this->type->supports = [
                'title',
                'editor',
                'custom-fields',
            ];
        }

        if ($this->reusable_cap_type) {
            $this->type->capability_type = $this->reusable_cap_type;
        }

        if ($this->reusable_caps) {
            $this->type->capabilities = $this->reusable_caps;
        }
    }

    public function enableScriptDebug()
    {
        add_action('admin_print_scripts', function () {
            if ($this->script_debug==true) {
                global $wp_scripts;
                dd($wp_scripts);
            }
        });
    }

    public function enableGraphQL()
    {
        add_filter('register_post_type_args', function ($args, $post_type) {
            if ('wp_block' === $post_type) {
                $args['show_in_graphql'] = true;
                $args['graphql_single_name'] = $this->reusable_block_labels['singular_name'];
                $args['graphql_plural_name'] = $this->reusable_block_labels['name'];
            }

            return $args;
        }, 10, 2);
    }
}
