<?php

namespace Libriciel\Breadcrumbs\Listener;

use Libriciel\Breadcrumbs\Entity\BreadcrumbElement;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[BreadcrumbElement('Administration', 'admin_structure')]
class Controller extends AbstractController
{
    #[BreadcrumbElement('Acteurs', 'actor_index')]
    public function __invoke()
    {

    }
}