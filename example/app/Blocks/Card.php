<?php

namespace App\Blocks;

use \TinyPixel\BlockCompose\Composer;
use \TinyPixel\BlockCompose\Attribute;
use \TinyPixel\BlockCompose\Traits\Compose;

class Card extends Composer
{
    // block details
    public $name = 'card'; // block name
    public $namespace = 'sage'; // block namespace
    public $editor_script = 'sage/blocks'; // registered script

    public $view = 'blocks.card'; // associate view

    /**
     * Set block attributes
     */
    public function attributes()
    {
        return [
            new Attribute('heading', 'string'),
            new Attribute('copy', 'string'),
        ];
    }

    use Compose;
}
