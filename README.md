SummernoteBundle
================
Warning
-------
This bundle is in a very alpha state. It's still a work in progress.

What is SummernoteBundle?
-------------------------
Summernotebundle integrates [SummerNote](http://hackerwins.github.io/summernote/) WYSIWYG Editor into Symfony form type.

Requirements
------------
Minimum requirements for this bundle are:
- Symfony 2.3
- Twitter's Bootstrap 3.0
- jQuery 1.9

Installation
------------
Add SummernoteBundle to your application's `composer.json` file

```json
{
    "require": {
        "solilokiam/summernotebundle": "dev-master"
    }
}
```

Add SummernoteBundle to your application's `AppKernel.php` file

```php
new Solilokiam\SummernoteBundle\SolilokiamSummernoteBundle()
```

Add Routing information to your application's `routing.yml`:

```yml
solilokiam_summernote_bundle:
    resource: "@SolilokiamSummernoteBundle/Resources/config/routing.xml"
    prefix: /summernote
``

Configuration
-------------
You must determine which object manager are you using. Currently it only supports Doctrine ODM, and doctrine ORM.

`app/config/config.yml`

```yml
solilokiam_summernote:
    db_driver: mongodb #supported orm,mongodb for odm
```


