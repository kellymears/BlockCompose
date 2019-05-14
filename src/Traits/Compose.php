<?php

namespace TinyPixel\BlockCompose\Traits;

trait Compose
{
    /**
     * Manipulate values passed to view
     *
     * @return $this->data->view
     */
    public function with($data)
    {
        return $data;
    }

    /**
     * Manipulate markup to be rendered
     *
     * @return $this->data->content
     */
    public function withContent($data)
    {
        return $data;
    }

    /**
     * Manipulate data to be rendered
     *
     * @return $this->data->block
     */
    public function withData($data, $source)
    {
        return $data;
    }
}
