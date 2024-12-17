<?php

namespace Libriciel\Breadcrumbs\Listener;

use Libriciel\Breadcrumbs\Breadcrumb;
use Libriciel\Breadcrumbs\Entity\BreadcrumbElement;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\ControllerArgumentsEvent;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\HttpKernel\Event\KernelEvent;
use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\HttpKernel\KernelEvents;

class BreadcrumbsListenerTest extends KernelTestCase
{
    public function testBreadcrumbListener(): void
    {

        $dispatcher = new EventDispatcher();

        $breadcrumb = new Breadcrumb();
        $breadcrumbListener = new BreadcrumbListener($breadcrumb);

        $dispatcher->addListener('kernel.controller_arguments', $breadcrumbListener);

        $kernel = $this->createMock(Kernel::class);

        $controllerArgumentEvent = new ControllerArgumentsEvent($kernel, new Controller(), [], new Request(), null);

        $dispatcher->dispatch($controllerArgumentEvent, 'kernel.controller_arguments');

        self::assertCount(2, $breadcrumb->getBreadcumbElements());
        self::assertEquals("Administration", $breadcrumb->getBreadcumbElements()[0]->getLibelle());
        self::assertEquals("actor_index", $breadcrumb->getBreadcumbElements()[1]->getRoute());
    }

    public function testBreadcrumbListenerWhenNoAttributeAreSet(): void
    {

        $dispatcher = new EventDispatcher();

        $breadcrumb = new Breadcrumb();
        $breadcrumbListener = new BreadcrumbListener($breadcrumb);

        $dispatcher->addListener('kernel.controller_arguments', $breadcrumbListener);

        $kernel = $this->createMock(Kernel::class);

        $controllerArgumentEvent = new ControllerArgumentsEvent($kernel, new NoAttributeController(), [], new Request(), null);

        $dispatcher->dispatch($controllerArgumentEvent, 'kernel.controller_arguments');
        self::assertEmpty($breadcrumb->getBreadcumbElements());
    }

}
