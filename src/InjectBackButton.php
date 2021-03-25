<?php declare(strict_types=1);

namespace Surda\BackButton;

trait InjectBackButton
{
    private BackButtonFactory $backButtonFactory;

    /** @persistent */
    public ?string $destination = null;

    public function injectBackButton(BackButtonFactory $backButtonFactory): void
    {
        $this->backButtonFactory = $backButtonFactory;

        $this->onStartup[] = function () {
            $this->template->currentLink = $this->link('this');
            $this->template->destination = null;

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

    protected function createComponentBackButton(): BackButtonControl
    {
        return $this->backButtonFactory->create();
    }
}