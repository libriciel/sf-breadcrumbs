<?php

namespace Libriciel\Breadcrumbs;

use Libriciel\Breadcrumbs\Entity\BreadcrumbElement;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BreadcrumElementEntityTest extends WebTestCase
{
    public function testValid()
    {
        $breadcrumbElement = (new BreadcrumbElement())
            ->setLibelle("name")
            ->setRoute('path');

        $this->assertSame("name", $breadcrumbElement->getLibelle());
        $this->assertSame('path', $breadcrumbElement->getRoute());
    }
}
