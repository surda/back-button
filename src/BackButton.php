<?php declare(strict_types=1);

namespace Surda\BackButton;

trait BackButton
{
    /** @var BackButtonFactory @inject */
    public $backButtonFactory;

    /** @var string $destination @persistent */
    public $destination;

    public function injectBackButton(): void
    {
        $this->onStartup[] = function () {
            $this->template->currentLink = $this->link('this');

            $resetPersistentParameters = [
                'destination' => NULL,
            ];

            $this->template->resetPersistentParameters = isset($this->template->resetPersistentParameters)
                ? $resetPersistentParameters + $this->template->resetPersistentParameters
                : $resetPersistentParameters;

            if ($this->destination) {
                /** @var BackButtonControl $backButton */
                $backButton = $this->getComponent('backButton');
                $backButton->setDestination($this->destination);
            }
        };
    }

    /**
     * @return BackButtonControl
     */
    protected function createComponentBackButton(): BackButtonControl
    {
        return $this->backButtonFactory->create();
    }
}