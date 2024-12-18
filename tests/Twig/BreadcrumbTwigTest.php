<?php

namespace Libriciel\Breadcrumbs\Twig;

use Libriciel\Breadcrumbs\Breadcrumb;
use PHPUnit\Framework\TestCase;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

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

    /**
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws LoaderError
     */
    public function testGetBreadcrumbs()
    {
        $twig = $this->createMock(Environment::class);
        $breadcrumb = $this->createMock(Breadcrumb::class);
        $breadcrumbTwig = new BreadcrumbTwig($twig, $breadcrumb);

        $twig->expects($this->once())
            ->method('render')
            ->with('menu/breadcrumb.html.twig', ['breadcrumb' => $breadcrumb->getBreadcumbElements()])
            ->willReturn('breadcrumb');

        $this->assertSame('breadcrumb', $breadcrumbTwig->getBreadcrumbs());
    }
}
