<?php

namespace App\Tests;

use App\Breadcrumb\BreadcrumbTwig;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use function PHPUnit\Framework\assertCount;

class BreadcrumbTwigTest extends KernelTestCase
{
    public function testGetFunctions(): void
    {
        $container = static::getContainer();
        /** @var BreadcrumbTwig $menuTwig */
        $menuTwig = $container->get(BreadcrumbTwig::class);
        assertCount(1, $menuTwig->getFunctions());
    }
}
