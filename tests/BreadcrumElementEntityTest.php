<?php

namespace Libriciel\LsBreadcrums\Tests;

use Libriciel\LsBreadcrums\Entity\BreadcrumbElement;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Validator\Validator\ValidatorInterface;

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
