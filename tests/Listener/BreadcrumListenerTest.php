<?php

namespace Libriciel\Breadcrumbs\Listener;

use Libriciel\Breadcrumbs\Breadcrumb;
use Libriciel\Breadcrumbs\Entity\BreadcrumbElement;
use PHPUnit\Framework\TestCase;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpKernel\Event\KernelEvent;

class BreadcrumListenerTest extends TestCase
{
    public function testBreadcrumbListener()
    {
        $dispatcher = new EventDispatcher();

        $breadcrumbElement = $this->createMock(BreadcrumbElement::class);
        $breadcrumbElement->method('getLibelle')->willReturn('name');
        $breadcrumbElement->method('getRoute')->willReturn('path');

        $breadcrumb = $this->createMock(Breadcrumb::class);
        $breadcrumbListener = new BreadcrumbListener($breadcrumb);
        $dispatcher->addListener('Libriciel', $breadcrumbListener);

        $event = $this->getMockBuilder(KernelEvent::class)
            ->disableOriginalConstructor()
            ->getMock();

        $dispatcher->dispatch($event);
        $this->assertInstanceOf(Breadcrumb::class, $breadcrumb);
        $this->assertSame([], $breadcrumb->getBreadcumbElements());
    }
}
