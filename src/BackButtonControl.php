<?php declare(strict_types=1);

namespace Surda\BackButton;

use Nette\Application\UI;
use Surda\UI\Control\ThemeableControls;

class BackButtonControl extends UI\Control
{
    use ThemeableControls;

    /** @var string|null */
    protected $destination;

    /** @var string */
    protected $defaultPresenterLink;

    /** @var string */
    protected $presenterLink;

    /** @var bool */
    protected $useAjax = FALSE;

    /**
     * @param string $templateType
     */
    public function render(string $templateType = 'default'): void
    {
        /** @var \Nette\Application\UI\ITemplate $template */
        $template = $this->template;
        $template->setFile($this->getTemplateByType($templateType));

        $template->destination = $this->destination;
        $template->presenterLink = $this->getPresenterLink();
        $template->userAjax = $this->useAjax;

        $template->render();
    }

    /**
     * @return string
     */
    public function getPresenterLink(): string
    {
        if ($this->presenterLink === NULL) {
            return $this->defaultPresenterLink;
        }

        return $this->presenterLink;
    }

    /**
     * @return string|null
     */
    public function getDestination(): ?string
    {
        return $this->destination;
    }

    /**
     * @param string|null $destination
     */
    public function setDestination(?string $destination): void
    {
        $this->destination = $destination;
    }

    /**
     * @param string $presenterLink
     */
    public function setDefaultPresenterLink(string $presenterLink): void
    {
        $this->defaultPresenterLink = $presenterLink;
    }

    /**
     * @param string $presenterLink
     */
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