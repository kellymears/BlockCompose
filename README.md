# Block Builder

Important notes: I have only tested this in PHP 7.3 using the development build of [Sage 10](https://github.com/roots/sage). This library has real utility but it is still in early dev and should be used with abundant caution.

A portof this library that doesn't depend on Sage's immaculate stack might be doable --  and I'm willing to work on that if there is interest -- but the best part of this package is flat-out not possible without the Blade view engine.

TLDR; You should use Sage.

## Get Shit Done Again

Crying in the shower about how the first half of 2019 has gone? Well dry off, pump some jams and maybe throw a couple darts at your Mullenwag dartboard. Because it's time to feel _fluent_ again because we're developers and that's just _how we roll, B._

Check out how I'm about to register a block and its associated scripts using the _verbose flavor_ of the Block Builder's primary `Builder` class:

```php
// Initialize builder
$block = new Builder('sage');

$block

    // Name the block
    ->name('card')
    ->namespace('sage')

    // Add attributes
    ->addString('heading')
    ->addString('copy')

    // Register assets within the definition
    ->addEditorScript()
        ->name('blocks')
        ->usesFile('blocks/index.js')
        ->usedByBlocks()
        ->register();

$block->register();
```

Want to know what's really cool about that? If you're using Sage 10 then your attribute data is already available for you in your view. Specifically: `blocks.[blockname].[blockname]`.

You don't even need to write a `save()` method in js. 😲

```php
<div class="card">
  <div class="card-content">
    <div class="card-content__heading">{!! $heading !!}</div>
    <p class="card-content__copy">{!! $copy !!}</p>
  </div>
</div>
```

## Scripts

Define a script in one shot:

```php
$script = new Script([
    'name'      => 'blocks',
    'namespace' => 'sage',
    'file'      => 'blocks/index.js',
    'type'      => 'block',
]);
```
Then register it:

```php
$script->register();
```

Or get _fancy_ (pinkies out!)

```php
$script = new Script();

$script
    ->setNamespace('sage')
    ->setName('blocks')
    ->usesFile('blocks/index.js')
    ->usedByBlocks()
    ->register();
```

## Builder demos
Already have a script registered? Cool, just pass the `usesEditorScript` method your pre-registered namespace and name.

```php
$block = new Builder('sage');

$block
    ->name('card')
    ->addAttributes('heading', 'string')
    // ...
    ->usesEditorScript('sage', 'blocks');

$block->register();
```

Use the `Script` builder for easy registration and then pass the result:

```php
$script = new Script([
    'name'      => 'blocks',
    'namespace' => 'sage',
    'file'      => 'blocks/index.js',
    'type'      => 'block',
])->register();

$builder = new Builder();

$builder
	->setNamespace('sage')
	->setName('card')
	// ...
	->addEditorScript($script);

$builder->register();

```

## Add attributes in a variety of ways

```php
$block
	->addString('heading')
	->addString('copy')
```
Too sweet? Try one of these instead:

```php
$attributes = [
    new Attribute('heading', 'string'),
    new Attribute('copy', 'string')
];

$block->addAttributes($attributes)
```
```php
$block->addAttribute('heading', 'string');
```

```php
$block->addAttributes([
    new Attribute('heading', 'string'),
    new Attribute('copy', 'string'),
]);
```