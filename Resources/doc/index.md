Getting Started With BlogBundle
==================================

Simple small bundle for simple blogs

## Prerequisites

This version of the bundle requires:

1. Symfony >= 2.1
2. LiipFunctionalTestBundle for testing
3. DoctrineFixturesBundle for fixtures
4. SonataAdminBundle for administering
5. StofDoctrineExtensionsBundle for timestamps
6. KnpPaginatorBundle for automate pagination

## Installation

Installation is a quick 5 step process:

1. Add BlogBundle in your composer.json
2. Enable the Bundle
3. Import BlogBundle routing and update your config file
4. Configure a pagination
5. Update your database schema

### Step 1: Add BlogBundle in your composer.json

```js
{
    "require": {
        "stfalcon/blog-bundle": "*"
    }
}
```

### Step 2: Enable the StfalconBlogBundle and requiremented bundles

Finally, enable the bundle in the kernel:

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Stfalcon\Bundle\BlogBundle\StfalconBlogBundle(),

        // for use KnpMenuBundle
        new Knp\Bundle\MenuBundle\KnpMenuBundle(),
        
        // for use KnpPaginatorBundle
        new Knp\Bundle\PaginatorBundle\KnpPaginatorBundle(),
        
        // for use StofDoctrineExtensionsBundle
        new Stof\DoctrineExtensionsBundle\StofDoctrineExtensionsBundle(),
        
        // for use SonataAdminBundle
        new Sonata\CacheBundle\SonataCacheBundle(),
        new Sonata\BlockBundle\SonataBlockBundle(),
        new Sonata\AdminBundle\SonataAdminBundle(),
        new Sonata\DoctrineORMAdminBundle\SonataDoctrineORMAdminBundle(),
        new Sonata\jQueryBundle\SonatajQueryBundle(),
    );
}
```

### Step 3: Import BlogBundle routing and update your config file

Now that you have installed and activated the bundle, all that is left to do is import the StfalconBlogBundle
and SonataAdminBundle routings:

In YAML:

``` yaml
# app/config/routing.yml
_stfalcon_blog:
    resource: "@StfalconBlogBundle/Resources/config/routing.yml"
```
[Routing in SonataAdminBundle](https://github.com/sonata-project/SonataAdminBundle/blob/master/Resources/doc/reference/getting_started.rst#step-1-define-sonataadminbundle-routes)

Add following lines to your config file:

In YAML:

``` yaml
# app/config/config.yml
# StfalconBlogBundle Configuration
stfalcon_blog:
    disqus_shortname: "your-disqus-shortname-goes-here"
    rss:
        title: "your-blog-title-goes-here"
        description: "your-blog-description-goes-here"

# Sonata Configuration
sonata_block:
    default_contexts: [cms]
    blocks:
        sonata.admin.block.admin_list:
            contexts:   [admin]

# DoctrineExtensionsBundle
stof_doctrine_extensions:
    default_locale: en_US
    orm:
        default:
            loggable: false
            sluggable: true
            timestampable: true
            translatable: false
            tree: false
```

### Step 4: Configure a pagination

Set a number of items you intend to show per page.

Add a new line to parameters:

In YAML:

``` yaml
# app/config/parameters.yml
parameters:
    page_range: 10
```

### Step 5: Update your database schema

Now that the bundle is configured, the last thing you need to do is update your
database schema because you have added a two new entities, the `Post` and the `Tag`.

Run the following command.

``` bash
$ php app/console doctrine:schema:update --force
$ php app/console assets:install
```
Now that you have completed the installation and configuration of the BlogBundle!
