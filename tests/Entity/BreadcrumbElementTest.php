<?php

namespace Libriciel\Breadcrumbs\Entity;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BreadcrumbElementTest extends WebTestCase
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
