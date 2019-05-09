# BlockCompose

View composer and attribute builder for Sage 10 and WordPress' Project Gutenberg editor.

## ⚠️ Package: this is still in _active_ development

`composer require tiny-pixel/block-compose`

## Get Shit Done Again

Crying in the shower about how the first half of 2019 has gone? Well dry off, pump some jams and maybe throw a couple darts at your Mullenwag dartboard. Because it's time to feel _fluent_ again. After all, we're _developers_ and that's just _how we roll, B._

Check out the included `Card` block in the `example` directory to see how to get started.

## A quick tour

In `register.php` we set our script and instantiate our Card. Where this is done is unimportant. The use of the script helper is optional. You will need to reference the associated script from the block Composer; the convention being used is `namespace/name`:

```php

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

/**
 * Instantiate card block
 */
new Blocks\Card();
```

### Composer

```php

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
```

### View

No surprises here:

```php
<div class="card">
  @if(isset($block->attributes->mediaURL))
    <img class="card-image" src="{!! $block->attributes->mediaURL !!}">
  @endif
  <div class="card-content">
    <div class="card__heading">{!! $block->attributes->heading !!}</div>
    <p class="card__copy">{!! $block->attributes->copy !!}</p>
  </div>
</div>
```

If you utilize `<InnerBlocks>` in your custom blocktype, that content is made accessible via `$block->content` in your view.

### The script

You are not required to write a `save()` method in your `registerBlockType()` script, with one exception: if you use InnerBlocks you must register a `save()` handle. This should suffice:

`js
...,
save: () => { return <div><InnerBlocks.Content /></div> }
```

otherwise, this is sufficient:

```js
import { __ } from '@wordpress/i18n'
import { registerBlockType } from '@wordpress/blocks'
import { RichText } from '@wordpress/editor'

registerBlockType('sage/card', {
  title: __('Card', 'sage'),
  icon: 'wordpress',
  category: 'common',
  attributes: {
    heading: {
        type: 'string',
    },
    copy: {
        type: 'string',
    },
  },
  edit: ({ className, setAttributes, attributes }) => {
    return (
      <div className={className}>
        <div className="card-content">
          <RichText
            tagName="div"
            className="card-content__copy"
            value={attributes.copy}
            placeholder={__('Copy go here', 'sage')}
            onChange={value => { setAttributes({ copy: value }) }} />
        </div>
      </div>
    )
  },
  save: () => { return null },
})
```

Honestly, not writing that save handler makes _a world of difference_. The vast majority of that is actually just HTML, really.

## Thanks for checking out the repo!

If you want to contribute that's totally awesome. Please be considerate in your PRs and issues. More important than anything else is that this repository remains a welcoming space for everyone to learn from, contribute to and utilize as a resource.

I hope this makes it easier for you to get rolling with the editor in a productive way. It's still not as fast as using something like, say, Advanced Custom Fields. But if you want to build with the editor directly that opens up a lot of really cool possibilities for you, your clients and the developer ecosystem.

If you use this work to make something cool or lucrative please let me know! I love that kind of stuff.

**MIT License.**

**&copy; 2019 Kelly Mears**
