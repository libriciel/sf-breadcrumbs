<?php

namespace Libriciel\Breadcrumbs\Twig;

use Libriciel\Breadcrumbs\BreadcrumbsBundle;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class BreadcrumbTwig extends AbstractExtension
{
    public function __construct(
        readonly private Environment $twig,
        readonly private BreadcrumbsBundle $breadcrumb,
    ) {
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('breadcrumbs', [$this, 'getBreadcrumbs'], ['is_safe' => ['html']]),
        ];
    }

    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function getBreadcrumbs(): string
    {
        return $this->twig->render('breadcrumb.html.twig', [
            'breadcrumb' => $this->breadcrumb->getBreadcumbElements(),
        ]);
    }
}
