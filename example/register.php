<?php

namespace App;

use \Blocks\Builder;

$block = new Builder();

$block
    ->name('card')
    ->namespace('sage')

    ->addString('heading')
    ->addString('copy')

    ->addEditorScript()
        ->name('blocks')
        ->usesFile('blocks/index.js')
        ->usedByBlocks()
        ->register();

// Register
$block->register();
