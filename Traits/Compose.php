<?php

namespace BlockCompose\Traits;

use function \Roots\view;

trait Compose
{
    /**
     * Provide a hook to manipulate block markup
     * prior to presentation in the view.
     *
     * @param  array block attributes
     * @return array view data
     */
    public function viewWith($attributes, $content)
    {
        return $attributes;
    }

    /**
     * Provide a hook to manipulate block data
     * prior to inclusion in BlockCompose\Composer\viewWith
     */
    public function processBlockData($block, $source_block)
    {
        return $block;
    }
}
