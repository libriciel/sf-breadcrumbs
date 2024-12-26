<?php

namespace Libriciel\Breadcrumbs\Twig;

use Libriciel\Breadcrumbs\BreadcrumbsBundle;
use PHPUnit\Framework\TestCase;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\TwigFunction;

class BreadcrumbTwigTest extends TestCase
{
    public function testGetFunctions(): void
    {
        $twig = $this->createMock(Environment::class);
        $breadcrumb = $this->createMock(BreadcrumbsBundle::class);
        $breadcrumbTwig = new BreadcrumbTwig($twig, $breadcrumb);

        $breadcrumbTwigFunctions = $breadcrumbTwig->getFunctions();

        self::assertArrayHasKey(0, $breadcrumbTwigFunctions);
        self::assertInstanceOf(TwigFunction::class, $breadcrumbTwigFunctions[0]);
        self::assertSame('breadcrumbs', $breadcrumbTwigFunctions[0]->getName());
    }

    /**
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws LoaderError
     */
    public function testGetBreadcrumbs(): void
    {
        $twig = $this->createMock(Environment::class);
        $breadcrumb = $this->createMock(BreadcrumbsBundle::class);
        $breadcrumbTwig = new BreadcrumbTwig($twig, $breadcrumb);

        $twig->expects(self::once())
            ->method('render')
            ->with('breadcrumb.html.twig', ['breadcrumb' => $breadcrumb->getBreadcumbElements()])
            ->willReturn('breadcrumb');

        self::assertSame('breadcrumb', $breadcrumbTwig->getBreadcrumbs());
    }
}
