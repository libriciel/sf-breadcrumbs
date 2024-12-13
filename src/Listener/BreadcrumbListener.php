<?php

namespace Libriciel\LsBreadcrums\Listener;

use Libriciel\LsBreadcrums\Entity\BreadcrumbElement;
use Libriciel\LsBreadcrums\Breadcrumb;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpKernel\Event\ControllerArgumentsEvent;

#[AsEventListener(event: 'kernel.controller_arguments')]
readonly class BreadcrumbListener
{
    public function __construct(
        private Breadcrumb $breadcrumb,
    ) {
    }

    public function __invoke(ControllerArgumentsEvent $event): void
    {
        $this->breadcrumb->renit();
        /** @var array<BreadcrumbElement> $breadcrumbElements */
        $breadcrumbElements = $event->getAttributes(BreadcrumbElement::class);
        if (1 >= count($breadcrumbElements)) {
            return;
        }
        foreach ($breadcrumbElements as $breadcrumbElement) {
            $this->breadcrumb->addToBreadcrumbs($breadcrumbElement, $event->getNamedArguments());
        }
    }
}
