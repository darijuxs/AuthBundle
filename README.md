AuthBundle
============

The AuthBundle offers possibility to manage user access to resource using routes  
It's compatible with Doctrine ORM for MySQL database.  

License
-------

This bundle is under the MIT license. See the complete license in the bundle:

    LICENSE
    
Installation
============

Step 1: Download the Bundle
---------------------------

Open `composer.json` file and add  

```
  "repositories": [
    {
      "type": "vcs",
      "url": "https://github.com/darijuxs/AuthBundle.git"
    }
  ],
```

Run command to install required bundle.

```
composer require bs/auth "1.0.*"
```
  
  
This command requires you to have Composer installed globally, as explained  
in the [installation chapter](https://getcomposer.org/doc/00-intro.md#globally)
of the Composer documentation.  

Step 2: Enable the Bundle
-------------------------

Then, enable the bundle by adding it to the list of registered bundles
in the `app/AppKernel.php` file of your project:

```php
<?php
// app/AppKernel.php

// ...
class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            // ...

            new AuthBundle\AuthBundle(),
        );

        // ...
    }

    // ...
}
```
    
Documentation
============

Extending User entity
---------------------------

RAPIBundle use custom format to return JSON response
  
```php
<?php
// Entity/User/User.php

// ...
class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            // ...

            new AuthBundle\AuthBundle(),
        );

        // ...
    }

    // ...
}
```


Change Log
---------------------------

* Version 1.0.0  
  Init project  
  