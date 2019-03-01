<?php declare(strict_types=1);

namespace Surda\BackButton\DI;

use Nette\DI\CompilerExtension;
use Nette\Utils\Validators;
use Surda\BackButton\BackButtonFactory;

class BackButtonExtension extends CompilerExtension
{
    /** @var array */
    public $defaults = [
        'defaultPresenterLink' => 'default',
        'useAjax' => FALSE,
        'template' => NULL,
        'templates' => [],

    ];

    /** @var array */
    private $templates = [
        'default' => __DIR__ . '/../Templates/bootstrap4.default.latte',
        'secondary' => __DIR__ . '/../Templates/bootstrap4.secondary.latte',
    ];

    public function loadConfiguration(): void
    {
        $builder = $this->getContainerBuilder();
        $config = $this->validateConfig($this->defaults);

        $this->validate($config);

        $backButton =$builder->addDefinition($this->prefix('backButton'))
            ->setImplement(BackButtonFactory::class)
            ->addSetup('setDefaultPresenterLink', [$config['defaultPresenterLink']])
            ->addSetup($config['useAjax'] === TRUE ? 'enableAjax' : 'disableAjax');

        $templates = $config['templates'] === [] ? $this->templates : $config['templates'];
        foreach ($templates as $type => $templateFile) {
            $backButton->addSetup('setTemplateByType', [$type, $templateFile]);
        }

        if ($config['template'] !== NULL) {
            $backButton->addSetup('setTemplate', [$config['template']]);
        }

    }

    /**
     * @param array $config
     */
    private function validate(array $config): void
    {
        Validators::assertField($config, 'defaultPresenterLink', 'string');
        Validators::assertField($config, 'useAjax', 'bool');
        Validators::assertField($config, 'template', 'string|null');
        Validators::assertField($config, 'templates', 'array');
    }
}