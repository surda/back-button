<?php declare(strict_types=1);

namespace Tests\Surda\BackButton;

use Nette\DI\Compiler;
use Nette\DI\Container;
use Nette\DI\ContainerLoader;
use Surda\BackButton\DI\BackButtonExtension;
use Tester;

abstract class TestCase extends Tester\TestCase
{
    /**
     * @param array $config
     * @return Container
     */
    protected function createContainer(array $config): Container
    {
        $loader = new ContainerLoader(TEMP_DIR, TRUE);
        $class = $loader->load(function (Compiler $compiler) use ($config): void {
            $compiler->addConfig($config);
            $compiler->addExtension('backButton', new BackButtonExtension());
        });

        return new $class();
    }
}