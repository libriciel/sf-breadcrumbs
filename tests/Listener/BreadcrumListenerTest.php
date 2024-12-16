<?php

namespace Libriciel\Breadcrumbs\Listener;

use Libriciel\Breadcrumbs\Breadcrumb;
use Libriciel\Breadcrumbs\Entity\BreadcrumbElement;
use PHPUnit\Framework\TestCase;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpKernel\Event\ControllerArgumentsEvent;
use Symfony\Component\HttpKernel\Event\KernelEvent;

class BreadcrumListenerTest extends TestCase
{

    public function setUp(): void
    {
        $this->dispatcher = new EventDispatcher();
        $this->breadcrumbsElement = [];
    }


    public function testBreadcrumbListener()
    {
        $breadcrumbElement = $this->createMock(BreadcrumbElement::class);
        $breadcrumbElement->method('getLibelle')->willReturn('name');
        $breadcrumbElement->method('getRoute')->willReturn('path');

        $breadcrumb = $this->createMock(Breadcrumb::class);
        $breadcrumbListener = new BreadcrumbListener($breadcrumb);
        $this->dispatcher->addListener('Libriciel', $breadcrumbListener);

        $event = $this->getMockBuilder(KernelEvent::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->dispatcher->dispatch($event);
        $this->assertInstanceOf(Breadcrumb::class, $breadcrumb);
        $this->assertSame([], $breadcrumb->getBreadcumbElements());
    }


}
