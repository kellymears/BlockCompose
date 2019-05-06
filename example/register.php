<?php

namespace App;

use \App\Blocks\Card;
use \Blocks\Script;

/**
 * Helper avaialable to register your script
 */
$script = (new Script([
    'name'      => 'blocks',
    'namespace' => 'sage',
    'file'      => 'blocks/index.js',
    'type'      => 'block',
]))->register();

/**
 * Instantiate card block
 */
new Blocks\Card();
