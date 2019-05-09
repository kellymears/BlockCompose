<?php

namespace BlockCompose;

use BlockCompose\Traits\Compose;

/**
 * Block Composer
 *
 * @author Kelly Mears <developers@tinypixel.dev>
 * @license MIT License
 */
class Composer
{
    public function __construct()
    {
        $this->compose()
             ->renderBlockData();

        return $this;
    }

    use Compose;
}
