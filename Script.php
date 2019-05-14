<?php

namespace BlockCompose;

use function Roots\config;
use function Roots\asset;
use function Roots\app;

/**
 * Script
 */
class Script
{
    /**
     * @var string plugin name
     */
    private $namespace;

    /**
     * @var string script version
     */
    private $version;

    /**
     * @var binary defer to footer
     */
    private $defer = false;

    /**
     * @var string plugin or block script
     */
    private $type;

    /**
     * @var string base path relative to theme root.
     * @todo #todo this is a temporary hack. fix.
     */
    public $base_path;

    /**
     * Construct
     * @param  void
     * @return self
     */
    public function __construct($definition = null)
    {
        $this->dependencies = [
            'wp-editor',
            'wp-element',
            'wp-i18n',
            'wp-components',
            'wp-blocks',
            'wp-plugins',
        ];

        if (isset($definition)) {
            $this->define($definition);
        }

        return $this;
    }

    /**
     * Register editor block scripts
     *
     * @param  void
     * @return self
     */
    public function register()
    {
        add_action('init', function () {
            wp_register_script(
                $this->getDesignation(),
                $this->getAsset(),
                $this->getDependencies(),
                $this->version,
                $this->defer,
            );
        });

        return $this;
    }

    /**
     * Enqueue block editor asset
     *
     */
    public function enqueueBlockScript()
    {
        add_action('enqueue_block_editor_assets', function () {
            wp_enqueue_script($this->getDesignation());
        });
    }

    /**
     * Add script from array in one shot
     *
     * @param  array script spec
     * @return self
     */
    public function define(array $script)
    {
        if (isset($script['name'])) {
            $this->setName($script['name']);
        }

        if (!isset($script['namespace'])) {
            $this->setNamespace(config('editor.namespace'));
        } else {
            $this->setNamespace($script['namespace']);
        }

        if (isset($script['file'])) {
            $this->setFile($script['file']);
        }

        if (isset($script['version'])) {
            $this->setVersion($script['version']);
        }

        if (isset($script['defer'])) {
            $this->defer();
        }

        return $this;
    }

    /**
     * Asset path helper
     */
    private function getAsset()
    {
        return asset($this->file);
    }

    /**
     * Get namespace
     *
     * @param  void
     * @return self
     */
    public function getNamespace()
    {
        return config('editor.namespace');
    }

    /**
     * Set namespace
     *
     * @param  void
     * @return self
     */
    public function setNamespace($namespace)
    {
        $this->namespace = $namespace;
    }

    /**
     * Set name
     *
     * @param string name
     * @return self
     */
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get Name
     *
     * @return string name
     * @return self
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get qualified name
     *
     * @param void
     * @return string namespaced script
     */
    public function getDesignation()
    {
        return "{$this->namespace}/{$this->name}";
    }

    /**
     * Get file
     * @param void
     * @return string file
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Set file
     *
     * @param string filename
     * @return self
     */
    public function setFile($file)
    {
        $this->file = $file;

        return $this;
    }

    /**
     * Set script version
     *
     * @param string version
     * @return self
     */
    public function setVersion($ver)
    {
        $this->version = $ver;

        return $this;
    }

    /**
     * Flag as deferred
     *
     * @param  void
     * @return self
     */
    public function defer()
    {
        $this->defer = true;

        return $this;
    }

    /**
     * Set type
     *
     * @param  string type (plugin or block)
     * @return self
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @param  void
     * @return string type of script
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Get Dependencies
     *
     * @param  void
     * @return mixed array
     */
    public function getDependencies()
    {
        return $this->dependencies;
    }
}
