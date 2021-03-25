<?php declare(strict_types=1);

namespace Surda\BackButton;

use Nette\Application\UI\Control;
use Nette\Application\UI\Template;
use Surda\UI\Control\ThemeableControls;

class BackButtonControl extends Control
{
    use ThemeableControls;

    protected ?string $destination = null;
    protected string $defaultPresenterLink = 'default';
    protected ?string $presenterLink = null;
    protected bool $useAjax = FALSE;

    public function render(string $templateType = 'default', ?string $destination = null): void
    {
        /** @var Template $template */
        $template = $this->template;
        $template->setFile($this->getTemplateByType($templateType));

        $template->destination = $destination !== null ? $destination : $this->destination;
        $template->presenterLink = $this->getPresenterLink();
        $template->userAjax = $this->useAjax;

        $template->render();
    }

    public function getPresenterLink(): string
    {
        if ($this->presenterLink === NULL) {
            return $this->defaultPresenterLink;
        }

        return $this->presenterLink;
    }

    public function getDestination(): ?string
    {
        return $this->destination;
    }

    public function setDestination(?string $destination): void
    {
        $this->destination = $destination;
    }

    public function setDefaultPresenterLink(string $presenterLink): void
    {
        $this->defaultPresenterLink = $presenterLink;
    }

    public function setPresenterLink(string $presenterLink): void
    {
        $this->presenterLink = $presenterLink;
    }

    public function enableAjax(): void
    {
        $this->useAjax = TRUE;
    }

    public function disableAjax(): void
    {
        $this->useAjax = FALSE;
    }
}