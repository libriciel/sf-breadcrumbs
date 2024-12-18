<?php

namespace Libriciel\Breadcrumbs;

class TestingOject
{
    public string $name;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
