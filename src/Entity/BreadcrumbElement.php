<?php

namespace Libriciel\Breadcrumbs\Entity;

#[\Attribute(\Attribute::IS_REPEATABLE | \Attribute::TARGET_CLASS | \Attribute::TARGET_METHOD)]
class BreadcrumbElement
{
    public function __construct(
        private string $libelle = '',
        private string $route = '',
    ) {
        $this
            ->setLibelle($libelle)
            ->setRoute($route)
        ;
    }

    public function getLibelle(): string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): BreadcrumbElement
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getRoute(): string
    {
        return $this->route;
    }

    public function setRoute(string $route): BreadcrumbElement
    {
        $this->route = $route;

        return $this;
    }
}
