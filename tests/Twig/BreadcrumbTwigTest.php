<?php

namespace Libriciel\Breadcrumbs\Twig;

use Libriciel\Breadcrumbs\Breadcrumb;
use PHPUnit\Framework\TestCase;
use Twig\Environment;

class BreadcrumbTwigTest extends TestCase
{
    public function testGetFunctions()
    {
        $twig = $this->createMock(Environment::class);
        $breadcrumb = $this->createMock(Breadcrumb::class);
        $breadcrumbTwig = new BreadcrumbTwig($twig, $breadcrumb);

        $breadcrumTwig = $breadcrumbTwig->getFunctions();

        $this->assertIsArray($breadcrumTwig);
        $this->assertArrayHasKey(0, $breadcrumTwig);
        $this->assertInstanceOf('Twig\TwigFunction', $breadcrumTwig[0]);
        $this->assertSame('idelibre_breadcrumbs', $breadcrumTwig[0]->getName());
    }

}
