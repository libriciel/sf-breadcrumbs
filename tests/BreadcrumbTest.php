<?php

namespace Libriciel\Breadcrumbs;

use Libriciel\Breadcrumbs\Entity\BreadcrumbElement;
use PHPUnit\Framework\TestCase;

class BreadcrumbTest extends TestCase
{
    public function testAddToBreadcrumbs(): void
    {
        $breadcrumb = new BreadcrumbsBundle();
        $breadcrumb->addToBreadcrumbs(new BreadcrumbElement('test', 'route'), []);
        self::assertCount(1, $breadcrumb->getBreadcumbElements());
        self::assertInstanceOf(BreadcrumbElement::class, $breadcrumb->getBreadcumbElements()[0]);
        self::assertEquals('test', $breadcrumb->getBreadcumbElements()[0]->getLibelle());
        self::assertEquals('route', $breadcrumb->getBreadcumbElements()[0]->getRoute());
    }

    public function testGetBreadcrumbElements(): void
    {
        $breadcrumb = new BreadcrumbsBundle();
        self::assertEmpty($breadcrumb->getBreadcumbElements());
    }

    public function testRenit(): void
    {
        $breadcrumb = new BreadcrumbsBundle();
        $breadcrumb->addToBreadcrumbs(new BreadcrumbElement('test', 'route'), []);
        $breadcrumb->renit();
        self::assertEmpty($breadcrumb->getBreadcumbElements());
    }

    public function testWithArgumentReplacement(): void
    {
        $breadcrumb = new BreadcrumbsBundle();
        $testingObject = (new TestingOject())->setName('test');
        $breadcrumb->addToBreadcrumbs(
            new BreadcrumbElement('Modification de {testingObject.name}', 'route'),
            ['testingObject' => $testingObject]
        );
        self::assertEquals('Modification de test', $breadcrumb->getBreadcumbElements()[0]->getLibelle());
    }
}
