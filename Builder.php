<?php

namespace Blocks;

use \Blocks\Script;
use \Blocks\Attribute;

use \Blocks\Traits\Register;
use \Blocks\Traits\Compose;

use function Roots\view;
use function Roots\asset;

/**
 * Block Builder
 */
class Builder
{
    public $namespace;

    public $name;

    public $designation;

    public $attributes;

    public $type;

    public $editor_script;

    public $style;

    public $handling;

    /**
     * Construct
     */
    public function __construct()
    {
        $this->compose();
        return $this;
    }

    use Compose;

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
}
