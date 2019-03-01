<?php declare(strict_types=1);

namespace Surda\BackButton;

interface BackButtonFactory
{
    /**
     * @return BackButtonControl
     */
    public function create(): BackButtonControl;
}
