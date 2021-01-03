<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitb4eebbbf6bc2ab02aed2d5340da3a0fb
{
    public static $prefixLengthsPsr4 = array (
        'c' => 
        array (
            'chriskacerguis\\RestServer\\' => 26,
        ),
        'C' => 
        array (
            'Composer\\Installers\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'chriskacerguis\\RestServer\\' => 
        array (
            0 => __DIR__ . '/..' . '/chriskacerguis/codeigniter-restserver/src',
        ),
        'Composer\\Installers\\' => 
        array (
            0 => __DIR__ . '/..' . '/composer/installers/src/Composer/Installers',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitb4eebbbf6bc2ab02aed2d5340da3a0fb::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitb4eebbbf6bc2ab02aed2d5340da3a0fb::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitb4eebbbf6bc2ab02aed2d5340da3a0fb::$classMap;

        }, null, ClassLoader::class);
    }
}
