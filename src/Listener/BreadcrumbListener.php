<?php

namespace Libriciel\Breadcrumbs\Listener;

use Libriciel\Breadcrumbs\Breadcrumb;
use Libriciel\Breadcrumbs\Entity\BreadcrumbElement;
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
