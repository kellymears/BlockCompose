<?php

namespace TinyPixel\BlockCompose;

/**
 * Attribute
 */
class Attribute
{
    /**
     * Construct
     *
     * @param string attr name
     * @param string attr type
     * @return array self
     */
    public function __construct($name, $type)
    {
        $this->name = $name ?? null;
        $this->type = $type ?? null;

        return $this->toArray();
    }

    /**
     * Enforces attribute as an array
     *
     * @param void
     * @return array attribute
     */
    public function toArray()
    {
        return [$this->name => ['type' => $this->type]];
    }
}
