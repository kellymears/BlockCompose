<?php

namespace Blocks;

use function Roots\asset;

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
        $this->dependencies = (object) [
            'blocks' => [
                'wp-editor',
                'wp-element',
                'wp-i18n',
                'wp-components',
                'wp-blocks',
            ],
            'plugins' => [
                'wp-editor',
                'wp-element',
                'wp-i18n',
                'wp-components',
                'wp-plugins',
            ],
        ];

        if (isset($definition)) {
            $this->defineScript($definition);
        }

        /**
         * Temp hack
         */
        $this->base_path = '/storage/theme/assets';

        return $this;
    }

    /**
     * Asset path helper
     */
    private function getAsset()
    {
        return get_theme_file_uri("{$this->base_path}/{$this->file}");
    }

    /**
     * Set namespace
     *
     * @param  string script namespace
     * @return self
     */
    public function setNamespace(string $namespace)
    {
        $this->namespace = $namespace;

        return $this;
    }

    /**
     * setNamespace() sugar
     *
     * @param  string script namespace
     * @return self
     */
    public function namespace(string $namespace)
    {
        $this->setNamespace($namespace);

        return $this;
    }

    /**
     * Get namespace
     *
     * @param  void
     * @return self
     */
    public function getNamespace()
    {
        return $this->namespace;
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
     * getName() sugar
     *
     * @return string name
     * @return self
     */
    public function name(string $name)
    {
        $this->setName($name);

        return $this;
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
     * setFile() sugar
     *
     * @param string filename
     * @return self
     */
    public function usesFile($file)
    {
        $this->setFile($file);

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
     * setType() sugar
     */
    public function usedByBlocks()
    {
        $this->setType('block');

        return $this;
    }

    /**
     * setType() sugar
     */
    public function usedByPlugins()
    {
        $this->setType('plugin');

        return $this;
    }

    /**
     * get Dependencies based on type param
     *
     * @param  void
     * @return mixed array
     */
    public function getDependencies()
    {
        if ($this->type == 'block') {
            return $this->dependencies->blocks;
        } elseif ($this->type == 'plugin') {
            return $this->dependencies->plugins;
        }

        return null;
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
     * Add script from array in one shot
     *
     * @param  array script spec
     * @return self
     */
    public function defineScript(array $script)
    {
        if (isset($script['name'])) {
            $this->setName($script['name']);
        }

        if (isset($script['type'])) {
            $this->setType($script['type']);
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
}