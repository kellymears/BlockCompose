<?php

namespace Blocks;

use Blocks\Script;
use Blocks\Attribute;

use function Roots\view;
use function Roots\asset;

/**
 * Block Builder
 */
class Builder
{
    /**
     * Construct
     */
    public function __construct($namespace)
    {
        /**
         * Block namespace
         */
        $this->namespace = 'sage';

        /**
         * Block name
         */
        $this->name = 'card';

        /**
         * Block attributes
         **/
        $this->attributes = [];

        /**
         * Editor script
         */
        $this->editor_script = object;

        /**
         * Style
         */
        $this->style = object;

        /**
         * Handling
         *
         * Use in usingScript, etc. to determine
         * what parameter we are manipulating call-to-call
         */
        $this->handling = '';

        /**
         * Set namespace if passed as param
         */
        if (isset($namespace)) {
            $this->setNamespace($namespace);
        }

        return $this;
    }

    /**
     * Set block namespace
     *
     * @param string namespace
     * @return self
     */
    public function setNamespace($name)
    {
        $this->namespace = $name;

        return $this;
    }

    /**
     * setNamespace() sugar
     *
     * @param string namespace
     * @return self
     */
    public function namespace($name)
    {
        $this->setNamespace($name);

        return $this;
    }

    /**
     * Set block name
     *
     * @param string name
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * setName() sugar
     *
     * @param string name
     * @return self
     */
    public function name($name)
    {
        $this->setName($name);

        return $this;
    }

    /**
     * Get qualified name
     */
    public function getDesignation()
    {
        return $this->designation = "{$this->namespace}/{$this->name}";
    }

    /**
     * Set attribute
     *
     * @param  array attribute
     * @return self
     */
    public function addAttribute($attributeName, $attributeType)
    {
        $this->attributes[] = new Attribute($attributeName, $attributeType);

        return $this;
    }

    /**
     * Set attributes
     *
     * @param  array attributes
     * @return self
     */
    public function addAttributes($attributes)
    {
        collect($attributes)->map(function ($attribute) {
            $this->attributes[] = $attribute->toArray();
        });

        return $this;
    }

    /**
     * Add attribute: string
     * @param  string name
     * @return self
     */
    public function addString($name)
    {
        $this->attributes[] = (new Attribute($name, 'string'))->toArray();

        return $this;
    }

    /**
     * Set Style
     *
     * @param  string style reference
     * @return self
     * @todo  #todo incomplete
     */
    public function style($style_name)
    {
        $this->assets->style = "{$this->namespace}-{$style_name}";

        return $this;
    }

    /**
     * Add Script
     */
    public function addEditorScript($definition = null)
    {
        $this->editor_script = $definition
                               ? new Script($definition)
                               : new Script([
                                    'namespace' => $this->namespace,
                                    'name'      => $this->name,
                                    'type'      => 'block',
                               ]);

        $this->handling = 'editor_script';

        return $this->editor_script;
    }

    /**
     * Uses existing editor_script
     *
     * @param   mixed script
     * @return  self
     */
    public function usesEditorScript($namespace, $name)
    {
        if (is_string($script)) {
            $this->editor_script = new Script([
                'name' => $name,
                'namespace' => $namespace,
            ]);
        }

        return $this;
    }

    /**
     * Register blocktype
     *
     * @param  object data
     * @return void
     */
    public function register()
    {
        add_action('init', function () {
            register_block_type($this->getDesignation(), [
                'attributes'      => $this->attributes,
                'editor_script'   => $this->editor_script->getDesignation(),
                'render_callback' => function ($attributes) {
                    return view(
                        "blocks.{$this->name}.{$this->name}",
                        $this->data($attributes)
                    );
                }
            ]);
        });
    }

    /**
     * Data
     *
     * @param  array block attributes
     * @return array view data
     */
    public function data($attributes)
    {
        return $attributes;
    }
}
