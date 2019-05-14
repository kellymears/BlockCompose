<?php

namespace TinyPixel\BlockCompose;

use \TinyPixel\BlockCompose\BaseServiceProvider;

class BlockComposeServiceProvider extends BaseServiceProvider
{
    /**
     * Service register
     */
    public function register()
    {
        $this->app->bind('blocks.script', function () {
            return new \TinyPixel\BlockCompose\Script();
        });

        $this->bindFromDir('Blocks');
    }

    /**
     * Service boot
     */
    public function boot()
    {
    }

    /**
     * Initialize blocks and compose views
     **/
    public function withBound()
    {
        foreach ($this->bound as $block) {
            $this->app[$block]->init()->compose();
        }
    }
}
