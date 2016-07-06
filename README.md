# Composable Expressive

Proof-of-concept Zend Expressive app to

- Composing apps of multiple modular expressive apps (piping apps)
- Expressive modules
- Doctrine integration until `DoctrineORMModule` is updated for ZF3

This app is based on the [zend-expressive-skeleton](https://github.com/zendframework/zend-expressive-skeleton). All original skeleton functionality is still in place.

## Expressive modules

Featuring modular applications using [mtymek/expressive-config-manager](https://github.com/mtymek/expressive-config-manager), as described in the cookbook "[How can I make my application modular?](https://zendframework.github.io/zend-expressive/cookbook/modular-layout/)".

The `config/config.php` file contains a list of modules to load configuration from prior from the `config/autoload/**` files. This POC contains one demo-module, located in `modules/Album/`. 

As configuration is merged prior to starting expressive, it is even possible to influence the expressive startup (in contrast to ZF2 modules). 

## Piping expressive apps

As expressive is a middleware by itself, we can pipe multiple expressive apps into each other. This allows us to create applications, composed of smaller, independent applications where to global application only defines the applications' roots.

This example provides one such sub-application, located in `modules/Album`. It is not completely stand-alone or isolated but relies on the global application to provide certain configuration (like a database). 

The `Album` application provides its own routes, services etc. It does not make assumptions on where these are actually located and the entire application can be moved around pretty easily.
By default, the `Album`'s application root is in `/api`. To move the application to a different location, simply move the `AlbumMiddleware` to a different path in the `config/autoload/middleware-pipline.global.php`.

# Installation

```
composer install
cp config/autoload/doctrine.local.dist.php config/autoload/doctrine.local.php // (adjust DB credentials in here!)
vendor/bin/doctrine orm:schema-tool:create
```
