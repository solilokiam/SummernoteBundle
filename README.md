SummernoteBundle
================

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
```

Minimal Configuration
---------------------
You must determine which object manager are you using. Currently it only supports Doctrine ODM, and doctrine ORM.

`app/config/config.yml`

```yml
solilokiam_summernote:
    db_driver: mongodb #supported orm,mongodb for odm
```

You must also tell which class is going to inherit the bundle asset class.

```yml
solilokiam_summernote:
    asset_class: 'AcmeAssetClass'
```

An example for the asset class can be like this (doctrine odm):

```php
<?php


```

Additional Configuration
------------------------
Summernote supports some configuration parameters. This parameters can configured application wide in config.yml.

* **width**: This is the width of summernote widget
```yml
solilokiam_summernote:
   ...
   width: 500
```
* **focus**: Autofocus the widget.
```yml
 solilokiam_summernote:
    ...
    focus: true
```
* **toolbar**: Configure toolbars of the widget.
```yml
  solilokiam_summernote:
    ...
    toolbar:
        - { name: style, buttons: ['bold', 'italic', 'underline', 'clear'] }
        - { name: paragraph, buttons: ['ul', 'ol', 'paragraph']}
```
Every line in toolbar config is a different button group. You can check available buttons at [summernote documentation](http://hackerwins.github.io/summernote/features.html#customtoolbar)

Status
------
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/5ac190d8-368d-463e-bdcf-eb414242de47/mini.png)](https://insight.sensiolabs.com/projects/5ac190d8-368d-463e-bdcf-eb414242de47)
[![Latest Stable Version](https://poser.pugx.org/solilokiam/summernotebundle/v/stable.png)](https://packagist.org/packages/solilokiam/summernotebundle) [![Total Downloads](https://poser.pugx.org/solilokiam/summernotebundle/downloads.png)](https://packagist.org/packages/solilokiam/summernotebundle) [![Latest Unstable Version](https://poser.pugx.org/solilokiam/summernotebundle/v/unstable.png)](https://packagist.org/packages/solilokiam/summernotebundle) [![License](https://poser.pugx.org/solilokiam/summernotebundle/license.png)](https://packagist.org/packages/solilokiam/summernotebundle)


