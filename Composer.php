<?php

namespace BlockCompose;

use BlockCompose\Traits\Compose;
use Illuminate\View\View;
use Illuminate\Support\Str;

/**
 * Block Composer
 *
 * @author Kelly Mears <developers@tinypixel.dev>
 * @license MIT License
 */
class Composer
{
    public $view = 'blocks.layout';

    public function __construct()
    {
        $this->compose();
    }

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
            register_block_type("{$this->namespace}/{$this->name}", [
                'attributes' => [collect($this->attributes())->toArray()],
                'style'  => $this->style  ?? null,
                'script' => $this->script ?? null,
                'editor_script' => $this->editor_script, // required
                'render_callback' => function ($attributes, $content) {
                    return view($this->view, [
                        'block' => $this->yieldViewData($attributes, $content)
                    ]);
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
        $data = [
            'name'       => $this->name,
            'content'    => $content,
            'attributes' => (object) $attributes,
        ];

        return (object) $this->with($data);
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
