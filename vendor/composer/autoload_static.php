<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitddfafb607dfb9eea406093d5a01ebea7
{
    public static $prefixesPsr0 = array (
        'P' => 
        array (
            'PhpFtp' => 
            array (
                0 => __DIR__ . '/../..' . '/src',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixesPsr0 = ComposerStaticInitddfafb607dfb9eea406093d5a01ebea7::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}