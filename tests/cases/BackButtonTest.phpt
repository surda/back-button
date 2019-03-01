<?php declare(strict_types=1);

namespace Tests\Surda\BackButton;

use Surda\BackButton\BackButtonControl;
use Surda\BackButton\BackButtonFactory;
use Tester\Assert;

require __DIR__ . '/../bootstrap.php';

/**
 * @testCase
 */
class BackButtonTest extends TestCase
{
    public function testControl()
    {
        $config = [
            'backButton' => [
                'defaultPresenterLink' => 'default'
            ]
        ];

        $container = $this->createContainer($config);

        /** @var BackButtonFactory $factory */
        $factory = $container->getService('backButton.backButton');

        /** @var BackButtonControl $control */
        $control = $factory->create();

        Assert::same('default', $control->getPresenterLink());

        Assert::same(NULL, $control->getDestination());

        $control->setDestination('/foo');
        Assert::same('/foo', $control->getDestination());
    }
}

(new BackButtonTest())->run();