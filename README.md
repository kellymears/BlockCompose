# BlockCompose

View composer and attribute builder for Sage 10 and WordPress' Project Gutenberg editor.

## Get Shit Done Again

Crying in the shower about how the first half of 2019 has gone? Well dry off, pump some jams and maybe throw a couple darts at your Mullenwag dartboard. Because it's time to feel _fluent_ again.

## Installation

- `composer require tiny-pixel/block-compose`
- Scaffolding: `app/Blocks` and `config/editor.php`.

### Configuration

For the time being the config file for the Block Compose library needs to be copied manually to `config/editor.php`.

The usage of this file is very straightforward and is commented in a Laravel style.

### Writing a Block View Composer

Minimally, a block view composer contains `name`, `editor_script` and `view` parameters accompanied by an `attributes` method.

```php
namespace App\Blocks;

use \TinyPixel\BlockCompose\Composer;
use \TinyPixel\BlockCompose\Attribute;
use \TinyPixel\BlockCompose\Traits\Compose;

class Starter extends Composer
{
    public $name = 'starter'; // block name
    public $editor_script = 'sage/starter'; // registered script
    public $view = 'blocks.starter'; // associate view

    public function attributes()
    {
        return [
            new Attribute('heading', 'string'),
            new Attribute('example', 'url'),
        ];
    }

    use Compose;
}
```

For your convenience, you can use the `BlockCompose\Attribute` helper class in your composition. Or -- if you prefer -- just return an associative array as per the WordPress spec.

### View

Block attributes are made available in the view in this format: `$block->attributes->attribute_name`.

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

If you utilize `<InnerBlocks>` in your custom blocktype in order to compose with nested blocks, that content is automatically pulled from the block data by the BlockComposer class and made accessible via `$block->content` in your view.

### The script

You are not required to write a `save()` method in your `registerBlockType()` script, with one exception: if you use InnerBlocks you must register a `save()` handle. It does not need to return anything substantive but I've found it requires at least one element to wrap it. This should suffice:

```js
// ...,
save: () => { return <div><InnerBlocks.Content /></div> }
```

Otherwise, this is a sufficient and functional example:

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
        <RichText
          tagName="div"
          className="card-content__copy"
          value={attributes.copy}
          placeholder={__('Copy go here', 'sage')}
          onChange={value => { setAttributes({ copy: value }) }} />
      </div>
    )
  },
  save: () => { return null },
})
```

Honestly, not writing that save handler makes _a world of difference_. The vast majority of that is actually just HTML, really.

### Advanced Composition

You can utilize three optional methods to handle parsing your block data, block markup and view variable templating:

```php
namespace App\Blocks;

use \TinyPixel\BlockCompose\Composer;
use \TinyPixel\BlockCompose\Attribute;
use \TinyPixel\BlockCompose\Traits\Compose;

class Card extends Composer
{

    // ...

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

## Thanks for checking out the repo!

If you want to contribute that's totally awesome. Please be considerate in your PRs and issues. More important than anything else is that this repository remains a welcoming space for everyone to learn from, contribute to and utilize as a resource.

I hope this makes it easier for you to get rolling with the editor in a productive way. It's still not as fast as using something like, say, Advanced Custom Fields. But if you want to build with the editor directly that opens up a lot of really cool possibilities for you, your clients and the developer ecosystem.

If you use this work to make something cool or lucrative please let me know! I love that kind of stuff.

**MIT License.**

**&copy; 2019 Kelly Mears**
