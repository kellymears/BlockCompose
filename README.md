# Block Builder

View composer and attribute builder for Sage 10 and WordPress' Project Gutenberg editor.

## Get Shit Done Again

Crying in the shower about how the first half of 2019 has gone? Well dry off, pump some jams and maybe throw a couple darts at your Mullenwag dartboard. Because it's time to feel _fluent_ again. After all, we're _developers_ and that's just _how we roll, B._

Check out the included `Card` block in the `example` directory to see how to get started.

## A quick tour

In `register.php` we set our script and instantiate our Card. Where this is done is unimportant. The use of the script helper is optional. You will need to reference the associated script from the block Composer; the convention being used is `namespace/name`:

```php

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
```

### Compose

Next, it probably makes sense to check out the `Card` class.

```php

namespace App\Blocks;

use \Blocks\Builder;
use \Blocks\Attribute;
use \Blocks\Traits\Compose;

class Card extends Builder
{
    use Compose;

    public $name = 'card'; // block name
    public $namespace = 'sage'; // block namespace
    public $editor_script = 'sage/blocks'; // script

    /**
     * Return array of attributes for use in the
     * block.
     *
     * @param  array block attributes
     * @return array view data
     */
    public function attributes()
    {
        return [
            new Attribute('heading', 'string'),
            new Attribute('copy', 'string'),
        ];
    }

    /**
     * Manipulate block attributes
     * prior to presentation in the view.
     *
     * @param  array block attributes
     * @return array view data
     */
    public function viewWith($attributes)
    {
        return $view_data = $attributes;
    }
}
```

After the boilerplate you'll need to set the `name`, `namespace` and `editor_script` parameters. These need to match up with your blockname and your scriptname, respectively.

In the `attributes` method you need to return an array of attributes for use in the block. Here, I am using the `Blocks\Attribute` class to make it a little easier, but -- as with `\Block\Script` -- this is totally optional. You can also just return an associative array as specified by the WordPress API.

The last method is `viewWith`. This optional method gives you a chance to manipulate the data that will be made available to your view. This is for when your block attributes are returning data to be used in a posts query, for example.

That's it. When this block is requested on the frontend, it will be composed by these rules and rendered with its associated Blade view. In the example card block above the view called is `blocks.card.card`.

### View

No surprises here:

```php
<div class="card">
  <div class="card-content">
    <div class="card-content__heading">{!! $heading !!}</div>
    <p class="card-content__copy">{!! $copy !!}</p>
  </div>
</div>
```

### The script

You are not required to write a `save()` method in your `registerBlockType()` script. The Composer has taken over that function. So that really just leaves the block registration and edit method. Here's our card's script (combined into one file for ease of reading):

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
        <div className="card">
          <div className="card-content">
            <RichText
              tagName="div"
              className="card-content__heading"
              value={attributes.heading}
              placeholder={__('Heading', 'sage')}
              onChange={value => { setAttributes({ heading: value }) }} />
            <RichText
              tagName="div"
              className="card-content__copy"
              value={attributes.copy}
              placeholder={__('Copy go here', 'sage')}
              onChange={value => { setAttributes({ copy: value }) }} />
          </div>
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
