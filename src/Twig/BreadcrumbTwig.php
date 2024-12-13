<?php

namespace Libriciel\LsBreadcrums\Twig;

use Libriciel\LsBreadcrums\Breadcrumb;
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
        readonly private Breadcrumb $breadcrumb,
    ) {
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('wa_breadcrumbs', [$this, 'getBreadcrumbs'], ['is_safe' => ['html']]),
        ];
    }

    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function getBreadcrumbs(): string
    {
        return $this->twig->render('menu/breadcrumb.html.twig', [
            'breadcrumb' => $this->breadcrumb->getBreadcumbElements(),
        ]);
    }
}
