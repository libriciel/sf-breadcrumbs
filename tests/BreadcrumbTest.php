<?php

namespace Libriciel\Breadcrumbs;

use Libriciel\Breadcrumbs\Entity\BreadcrumbElement;
use PHPUnit\Framework\TestCase;

class BreadcrumbTest extends TestCase
{
    public function testAddToBreadcrumbs()
    {
        $breadcrumb = new Breadcrumb();
        $breadcrumb->addToBreadcrumbs(new BreadcrumbElement('test'), []);
        $this->assertCount(1, $breadcrumb->getBreadcumbElements());
    }

    public function testGetBreadcumbElements()
    {
        $breadcrumb = new Breadcrumb();
        $this->assertIsArray($breadcrumb->getBreadcumbElements());
    }

    public function testRenit()
    {
        $breadcrumb = new Breadcrumb();
        $breadcrumb->addToBreadcrumbs(new BreadcrumbElement('test'), []);
        $breadcrumb->renit();
        $this->assertCount(0, $breadcrumb->getBreadcumbElements());
    }


}
