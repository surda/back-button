<?php declare(strict_types=1);

namespace Tests\Surda\BackButton\DI;

use Surda\BackButton\BackButtonFactory;
use Tester\Assert;
use Tests\Surda\BackButton\TestCase;

require __DIR__ . '/../../bootstrap.php';

/**
 * @testCase
 */
class BackButtonExtensionTest extends TestCase
{
    public function testRegistration()
    {
        $container = $this->createContainer([]);
        $factory = $container->getService('backButton.backButton');

        Assert::true($factory instanceof BackButtonFactory);
        Assert::true(TRUE);
    }
}

(new BackButtonExtensionTest())->run();