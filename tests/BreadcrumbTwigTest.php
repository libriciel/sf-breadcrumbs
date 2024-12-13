<?php

namespace Libriciel\LsBreadcrums\Tests;

use Libriciel\LsBreadcrums\BreadcrumbTwig;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use function PHPUnit\Framework\assertCount;

class BreadcrumbTwigTest extends KernelTestCase
{
    public function testGetFunctions(): void
    {
        self::bootKernel();
        $container = static::getContainer();
        /** @var BreadcrumbTwig $menuTwig */
        $menuTwig = $container->get(BreadcrumbTwig::class);
        assertCount(1, $menuTwig->getFunctions());
    }
}
