<?php

namespace Libriciel\Breadcrumbs\Entity;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BreadcrumbElementTest extends WebTestCase
{
    public function testValid(): void
    {
        $breadcrumbElement = (new BreadcrumbElement())
            ->setLibelle('name')
            ->setRoute('path');

        self::assertSame('name', $breadcrumbElement->getLibelle());
        self::assertSame('path', $breadcrumbElement->getRoute());
    }
}
