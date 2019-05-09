<?php

namespace App\Blocks;

use \BlockCompose\Composer;
use \BlockCompose\Attribute;
use \BlockCompose\Traits\Compose;

class Card extends Composer
{
    // block details
    public $name = 'card'; // block names
    public $namespace = 'sage'; // block namespace
    public $editor_script = 'sage/blocks'; // registered script

    // (optional) associate with registered style
    public $style = 'sage/blocks';

    // (optional) override view
    public $view = 'blocks.card';

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

    /**
     * Manipulate view data
     *
     * @return array associative
     */
    public function with($data)
    {
        return $data;
    }

    /**
     * Manipulate source block data
     */
    public function withContent($content)
    {
        return $content;
    }

    /**
     * Manipulate source block data
     */
    public function withData($block, $source)
    {
        return $block;
    }

    use Compose;
}
