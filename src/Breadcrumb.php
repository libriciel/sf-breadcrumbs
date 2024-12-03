<?php

namespace App\Breadcrumb;

class Breadcrumb
{
    /** @var array<BreadcrumbElement> */
    private array $breadcrumbElements = [];

    /**
     * @param array<object> $namedArguments
     */
    public function addToBreadcrumbs(BreadcrumbElement $breadcrumbElement, array $namedArguments): void
    {
        if (false !== preg_match('#\{([^.]+)\.([^}]+)?}#', $breadcrumbElement->getLibelle(), $matches)
            && isset($matches[1],$namedArguments[$matches[1]]) /* @phpstan-ignore-line bug dans phpstan... */
        ) {
            $object = $namedArguments[$matches[1]];
            $method = 'get'.($matches[2] ?? '');
            $callback = [$object, $method];
            if (is_callable($callback)) {
                $value = $callback();
                $breadcrumbElement->setLibelle(
                    preg_replace('#\{([^.]+)\.([^}]+)?}#', $value, $breadcrumbElement->getLibelle()) ?? ''
                );
            }
        }
        $this->breadcrumbElements[] = $breadcrumbElement;
    }

    /**
     * @return BreadcrumbElement[]
     */
    public function getBreadcumbElements(): array
    {
        return $this->breadcrumbElements;
    }

    public function renit(): void
    {
        $this->breadcrumbElements = [];
    }
}
