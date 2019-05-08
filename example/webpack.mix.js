const mix = require('laravel-mix')
require('laravel-mix-wp-blocks')

mix.block('./resources/assets/editor/index.js', './storage/theme/assets/blocks')
