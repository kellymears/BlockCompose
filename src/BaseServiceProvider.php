<?php

namespace TinyPixel\BlockCompose;

use function \Roots\config;
use \Roots\Acorn\ServiceProvider;

class BaseServiceProvider extends ServiceProvider
{
    public function register()
    {
    }

    public function boot()
    {
    }

    /**
     * Bind all classes within an App dir
     * to the IOC
     **/
    public function bindFromDir($dir)
    {
        $this->bound = collect();

        collect(glob($this->app->basePath('app/'. $dir . '/*.php')))->map(
            function ($file) use ($dir) {
                $src = $this->formatBindings($dir, $file);
                $this->app->bind($src->handle, function () use ($src) {
                    return new $src->class;
                });

                $this->bound->push($src->handle);
            }
        );

        $this->withBound();
    }

    /**
     * Given a file and a containing directory,
     * format the class to be bound and the handle
     * it is to be bound to.
     *
     **/
    public function formatBindings($class, $file)
    {
        return (object) [
            'handle' => strtolower($class).'.'.strtolower(basename($file, '.php')),
            'class' => '\\App\\'.$class.'\\'. basename($file, '.php'),
        ];
    }

    /**
     * Perform a boot operation on each
     * of the bound classes.
     *
     */
    public function withBound()
    {
    }
}
