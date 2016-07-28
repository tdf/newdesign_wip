<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit03df7cf372b0ba944d85239abce15a29
{
    public static $prefixLengthsPsr4 = array (
        'C' => 
        array (
            'Composer\\Installers\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Composer\\Installers\\' => 
        array (
            0 => __DIR__ . '/..' . '/composer/installers/src/Composer/Installers',
        ),
    );

    public static $classMap = array (
        'SilverStripe\\Cms\\Test\\Behaviour\\FeatureContext' => __DIR__ . '/../..' . '/cms/tests/behat/features/bootstrap/FeatureContext.php',
        'SilverStripe\\Cms\\Test\\Behaviour\\FixtureContext' => __DIR__ . '/../..' . '/cms/tests/behat/features/bootstrap/SilverStripe/Cms/Test/Behaviour/FixtureContext.php',
        'SilverStripe\\Cms\\Test\\Behaviour\\ThemeContext' => __DIR__ . '/../..' . '/cms/tests/behat/features/bootstrap/SilverStripe/Cms/Test/Behaviour/ThemeContext.php',
        'SilverStripe\\Framework\\Test\\Behaviour\\CmsFormsContext' => __DIR__ . '/../..' . '/framework/tests/behat/features/bootstrap/SilverStripe/Framework/Test/Behaviour/CmsFormsContext.php',
        'SilverStripe\\Framework\\Test\\Behaviour\\CmsUiContext' => __DIR__ . '/../..' . '/framework/tests/behat/features/bootstrap/SilverStripe/Framework/Test/Behaviour/CmsUiContext.php',
        'SilverStripe\\Framework\\Test\\Behaviour\\FeatureContext' => __DIR__ . '/../..' . '/framework/tests/behat/features/bootstrap/FeatureContext.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit03df7cf372b0ba944d85239abce15a29::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit03df7cf372b0ba944d85239abce15a29::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit03df7cf372b0ba944d85239abce15a29::$classMap;

        }, null, ClassLoader::class);
    }
}
