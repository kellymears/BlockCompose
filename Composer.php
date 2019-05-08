<?php

namespace BlockCompose;

use BlockCompose\Traits\Compose;

/**
 * Block Composer
 *
 * @author Kelly Mears <developers@tinypixel.dev>
 * @license MIT License
 */
class Composer
{
    public function __construct()
    {
        $this->compose()
             ->renderBlockData();

        return $this;
    }

    /**
     * Register blocktype with WordPress and establish view
     *
     * Exposed to child classes via viewWith() trait
     *
     * @param  object data
     * @return void
     */
    private function compose()
    {
        add_action('init', function () {
            $attributes = collect($this->attributes())->toArray();
            register_block_type("{$this->namespace}/{$this->name}", [
                'attributes' => [$attributes],
                'style'  => isset($this->style) ? $this->style : null,
                'script' => isset($this->script) ? $this->script : null,
                'editor_script' => $this->editor_script,
                'render_callback' => function ($attributes, $content) {
                    return view(
                        "blocks.{$this->name}",
                        $this->viewWith($attributes, $content)
                    );
                }
            ]);
        });

        return $this;
    }

    /**
     * Provide a hook to manipulate block attributes
     * prior to render_block.
     *
     * Exposed to child classes with modifyData trait
     *
     * @param  void
     * @return mixed block
     */
    private function renderBlockData()
    {
        add_filter('render_block_data', function ($block, $source_block) {
            return $this->modifyData($block, $source_block);
        }, 10, 2);
    }

    use Compose;
}
