<?php

namespace App\Blocks;

use \TinyPixel\BlockCompose\Composer;

class Card extends Composer
{
    // block details
    public $name = 'sage/card'; // block name
    public $editor_script = 'sage/blocks'; // registered script
    public $view = 'blocks.card'; // associate view
}
