<?php

namespace BlockCompose\Traits;

use function \Roots\view;

trait Compose
{
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
            register_block_type("{$this->namespace}/{$this->name}", [
                'attributes' => [collect($this->attributes())->toArray()],
                'style'  => $this->style ?? null,
                'script' => $this->script ?? null,
                'editor_script' => $this->editor_script, // required
                'render_callback' => function ($attributes, $content) {
                    return view("blocks.{$this->name}", $this->viewWith(
                        $attributes,
                        $content
                    ));
                }
            ]);
        });

        return $this;
    }

    /**
     * Provide a hook to manipulate block attributes
     * prior to render_block.
     *
     * @param  void
     * @return mixed block
     */
    private function renderBlockData()
    {
        add_filter('render_block_data', function ($block, $source_block) {
            return $this->processBlockData($block, $source_block);
        }, 10, 2);
    }

    /**
     * Provide a hook to manipulate block markup
     * prior to presentation in the view.
     *
     * @param  array block attributes
     * @return array view data
     */
    public function viewWith($attributes, $content, $viewData = [])
    {
        foreach ($attributes as $key => $value) {
            $viewData[$key] = $value;
        }

        $viewData['content'] = $content ?? '';

        return $viewData;
    }

    /**
     * Provide a hook to manipulate block data
     * prior to inclusion in BlockCompose\Composer\viewWith
     */
    public function processBlockData($block, $source_block)
    {
        $block['attr']['source'] = $source_block;
        return $block;
    }
}
