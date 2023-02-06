<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit0a58a3984fc6363c165b62a4e2d4dd87
{
    public static $prefixLengthsPsr4 = array (
        'f' => 
        array (
            'fivefilters\\Readability\\' => 24,
        ),
        'S' => 
        array (
            'SimplePie\\' => 10,
        ),
        'P' => 
        array (
            'Psr\\Log\\' => 8,
            'Psr\\Http\\Message\\' => 17,
        ),
        'M' => 
        array (
            'Masterminds\\' => 12,
        ),
        'L' => 
        array (
            'League\\Uri\\' => 11,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'fivefilters\\Readability\\' => 
        array (
            0 => __DIR__ . '/..' . '/fivefilters/readability.php/src',
        ),
        'SimplePie\\' => 
        array (
            0 => __DIR__ . '/..' . '/simplepie/simplepie/src',
        ),
        'Psr\\Log\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/log/Psr/Log',
        ),
        'Psr\\Http\\Message\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/http-message/src',
        ),
        'Masterminds\\' => 
        array (
            0 => __DIR__ . '/..' . '/masterminds/html5/src',
        ),
        'League\\Uri\\' => 
        array (
            0 => __DIR__ . '/..' . '/league/uri/src',
            1 => __DIR__ . '/..' . '/league/uri-interfaces/src',
        ),
    );

    public static $prefixesPsr0 = array (
        'S' => 
        array (
            'SimplePie' => 
            array (
                0 => __DIR__ . '/..' . '/simplepie/simplepie/library',
            ),
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit0a58a3984fc6363c165b62a4e2d4dd87::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit0a58a3984fc6363c165b62a4e2d4dd87::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit0a58a3984fc6363c165b62a4e2d4dd87::$prefixesPsr0;
            $loader->classMap = ComposerStaticInit0a58a3984fc6363c165b62a4e2d4dd87::$classMap;

        }, null, ClassLoader::class);
    }
}
