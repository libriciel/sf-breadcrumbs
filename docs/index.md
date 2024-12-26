Usage
============

Afin de configurer correctement le bundle veuillez ajouter le code suivant dans votre fichier config/services.yml :

```yaml
services:
  
  Libriciel\Breadcrumbs\Breadcrumb:

  Libriciel\Breadcrumbs\Listener\BreadcrumbListener:
    tags:
      - { name: kernel.event_listener, event: kernel.controller_arguments, priority: -1 }

  Libriciel\Breadcrumbs\Twig\BreadcrumbTwig:
    tags:
      - { name: twig.extension }

```

Puis ajouter au fichier config/packages/twig.yaml :

```yaml
twig:
  paths:
    - '%kernel.project_dir%/vendor/libriciel/sf-breadcrumbs/templates'
```


Puis ajouter au base.html.twig ou à toute autre endroit, commun à toutes vos page :

```twig
{{ breadcrumbs() }}
```

Enfin ajouter l'annotation suivante à votre controlleur :

```php
use Libriciel\Breadcrumbs\BreadcrumbElement;

#[BreadcrumbElement('libellé', 'route')]

```

Exemple : 
```php
use Libriciel\Breadcrumbs\BreadcrumbElement;

#[BreadcrumbElement('Plateforme', 'structure_index')]
public function index(): Response
{
    return $this->render('structure/index.html.twig', [
        'controller_name' => 'StructureController',
    ]);
}
```





