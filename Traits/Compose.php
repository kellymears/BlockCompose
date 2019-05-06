<?php

namespace Blocks\Traits;

use function \Roots\view;

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
            $attributes = collect($this->attributes())->toArray();
            register_block_type("{$this->namespace}/{$this->name}", [
                'attributes' => [$attributes],
                'editor_script' => $this->editor_script,
                'render_callback' => function ($attributes) {
                    return view(
                        "blocks.{$this->name}.{$this->name}",
                        $this->viewWith($attributes)
                    );
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
