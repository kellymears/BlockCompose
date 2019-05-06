<?php

namespace App\Blocks;

use \Blocks\Builder;
use \Blocks\Attribute;
use \Blocks\Traits\Compose;

class Card extends Builder
{
    use Compose;

    public $name = 'card'; // block name
    public $namespace = 'sage'; // block namespace
    public $editor_script = 'sage/blocks'; // script

    /**
     * Return array of attributes for use in the
     * block.
     *
     * @param  array block attributes
     * @return array view data
     */
    public function attributes()
    {
        return [
            new Attribute('heading', 'string'),
            new Attribute('copy', 'string'),
        ];
    }

    /**
     * Manipulate block attributes
     * prior to presentation in the view.
     *
     * @param  array block attributes
     * @return array view data
     */
    public function viewWith($attributes)
    {
        return $view_data = $attributes;
    }
}
