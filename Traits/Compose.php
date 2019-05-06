<?php

namespace Blocks\Traits;

use function Roots\view;

trait Compose
{
    /**
     * Register blocktype with WordPress and set view
     *
     * @param  object data
     * @return void
     */
    public function compose()
    {
        add_action('init', function () {
            register_block_type("{$this->namespace}/{$this->name}", [
                'attributes' => [
                    collect($this->attributes())->toArray()
                ],
                'editor_script' => $this->editor_script,
                'render_callback' => function ($attributes) {
                    $view = "blocks.{$this->name}.{$this->name}";
                    $data = $this->viewWith(collect($attributes)->toArray());

                    return view($view, $data);
                }
            ]);
        });

        return $this;
    }

    /**
     * Provide a hook to manipulate block attributes
     * prior to presentation in the view.
     *
     * @param  array block attributes
     * @return array view data
     */
    public function viewWith($attributes)
    {
        return $attributes;
    }
}
