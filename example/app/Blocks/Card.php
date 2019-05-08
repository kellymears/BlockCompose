<?php

namespace App\Blocks;

use \BlockCompose\Composer;
use \BlockCompose\Attribute;
use \BlockCompose\Traits\Compose;

class Card extends Composer
{
    public $name = 'card'; // block name
    public $namespace = 'sage'; // block namespace
    public $style = 'sage/blocks'; // registered style
    public $editor_script = 'sage/blocks'; // registered script

    public function attributes()
    {
        return [
            new Attribute('heading', 'string'),
            new Attribute('copy', 'string'),
        ];
    }


    // Modify source block data prior viewWith hook
    public function processBlockData($block, $source_block)
    {
        return $block;
    }

    // Modify attributes and markup prior to view
    public function viewWith($attributes, $content)
    {
        return $attributes;
    }

    use Compose;
}
