<?php

namespace Blocks;

use \Blocks\Traits\Compose;

/**
 * Block Builder
 *
 * @author Kelly Mears <developers@tinypixel.dev>
 * @license MIT License
 */
class Builder
{
    public function __construct()
    {
        $this->compose();
        return $this;
    }

    use Compose;
}
