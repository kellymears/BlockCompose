<?php

namespace TinyPixel\BlockCompose;

use function Roots\app;
use function Roots\view;
use function Roots\config;

use \TinyPixel\BlockCompose\Traits\Compose;

/**
 * Block Composer
 *
 * @author Kelly Mears <developers@tinypixel.dev>
 * @license MIT License
 */
class Composer
{
    /**
     * Default view
     */
    public $view = 'blocks.layout';

    /**
     * Register blocktype with WordPress and establish view
     *
     * @param  object data
     * @return void
     */
    public function compose()
    {
        /** wp hooks */
        $this->renderBlock();
        $this->renderBlockData();

        add_action('init', function () {
            register_block_type($this->name, [
                'script'          => isset($this->script) ?: null,
                'style'           => isset($this->style) ?: null,
                'editor_style'    => isset($this->editor_style) ?: null,
                'editor_script'   => $this->editor_script,
                'render_callback' => function ($attributes, $content) {
                    return view($this->view, ['block' => $this->yieldViewData($attributes, $content)]);
                }
            ]);
        });
    }

    /**
     * Prepare view data
     *
     * @param  array block attributes
     * @return array view data
     */
    public function yieldViewData($attributes, $content)
    {
        return (object)$this->with(collect([
            'name'       => $this->name,
            'content'    => $content,
            'attributes' => (object) $attributes,
        ])->toArray());
    }

    /**
     * Manipulate markup prior to render
     *
     * @see Hook provided: $this->contentRender();
     * @param void
     * @return array $block_content
     */
    public function renderBlock()
    {
        add_filter('render_block', function ($block_content, $block) {
            $data = $this->withContent($block_content);

            return $data;
        }, 10, 2);
    }

    /**
     * Manipulate data prior to render
     *
     * @see Hook provided: $this->dataRender()
     * @param  void
     * @return mixed $block
     */
    public function renderBlockData()
    {
        add_filter('render_block_data', function ($block, $source_block) {
            $block['attrs']['name'] = $source_block['blockName'];
            $block['attrs']['source'] = $source_block;

            /** Consumer dev hook */
            return $this->withData($block, $source_block);
        }, 10, 2);
    }

    use Compose;
}
