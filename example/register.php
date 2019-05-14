<?php

namespace App;

use \App\Blocks;
use \BlockCompose\Script;

/**
 * Helper avaialable to register your script
 */
$script = (new Script([
    'name'      => 'blocks',
    'namespace' => 'sage',
    'file'      => 'blocks/index.js',
    'type'      => 'block',
]))->register();
