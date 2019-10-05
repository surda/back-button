<?php declare(strict_types=1);

namespace Surda\BackButton\DI;

use Nette\DI\CompilerExtension;
use Nette\Schema\Expect;
use Nette\Schema\Schema;
use stdClass;
use Surda\BackButton\BackButtonFactory;

/**
 * @property-read stdClass $config
 */
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

    public function getConfigSchema(): Schema
    {
        return Expect::structure([
            'defaultPresenterLink' => Expect::string('default'),
            'useAjax' => Expect::bool(TRUE),
            'template' => Expect::string()->nullable()->default(NULL),
            'templates' => Expect::array(),
        ]);
    }

    public function loadConfiguration(): void
    {
        $builder = $this->getContainerBuilder();
        $config = $this->config;

        $backButtonFactory = $builder->addFactoryDefinition($this->prefix('backButton'))
            ->setImplement(BackButtonFactory::class);

        $backButtonDefinition = $backButtonFactory->getResultDefinition();

        $backButtonDefinition->addSetup('setDefaultPresenterLink', [$config->defaultPresenterLink]);
        $backButtonDefinition->addSetup($config->useAjax === TRUE ? 'enableAjax' : 'disableAjax');

        $templates = $config->templates === [] ? $this->templates : $config->templates;

        foreach ($templates as $type => $templateFile) {
            $backButtonDefinition->addSetup('setTemplateByType', [$type, $templateFile]);
        }

        if ($config->template !== NULL) {
            $backButtonDefinition->addSetup('setTemplate', [$config->template]);
        }
    }
}