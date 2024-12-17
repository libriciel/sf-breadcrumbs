<?php

namespace Libriciel\Breadcrumbs;

use Libriciel\Breadcrumbs\Entity\BreadcrumbElement;
use PHPUnit\Framework\TestCase;

class BreadcrumbTest extends TestCase
{
    public function testAddToBreadcrumbs()
    {
        $breadcrumb = new Breadcrumb();
        $breadcrumb->addToBreadcrumbs(new BreadcrumbElement('test', 'route'), []);
        $this->assertCount(1, $breadcrumb->getBreadcumbElements());
        $this->assertInstanceOf(BreadcrumbElement::class, $breadcrumb->getBreadcumbElements()[0]);
        $this->assertEquals('test', $breadcrumb->getBreadcumbElements()[0]->getLibelle());
        $this->assertEquals('route', $breadcrumb->getBreadcumbElements()[0]->getRoute());
    }

    public function testGetBreadcumbElements()
    {
        $breadcrumb = new Breadcrumb();
        $this->assertIsArray($breadcrumb->getBreadcumbElements());
    }

    public function testRenit()
    {
        $breadcrumb = new Breadcrumb();
        $breadcrumb->addToBreadcrumbs(new BreadcrumbElement('test', 'route'), []);
        $breadcrumb->renit();
        $this->assertIsArray($breadcrumb->getBreadcumbElements());
        $this->assertEmpty($breadcrumb->getBreadcumbElements());
    }


}
