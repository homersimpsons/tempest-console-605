# Tempest console - already declared class issue

This is a reproduction repository for issue https://github.com/tempestphp/tempest-framework/issues/605.

### How to setup from scratch

```sh
$ mkdir app
$ cd app
$ composer init
# ...
# edit composer.json to add "minimum-stability": "dev"
$ composer require tempest/console:dev-main
$ echo '...' > main.php
$ echo '...' > src/InteractiveCommand.php
```

### How to setup from git

```sh
$ git clone ...
$ cd app
$ composer install
```

## Reproduce issue

Run the following command, you should see the issue directly:
```sh
$ php ./main.php
PHP Fatal error:  Cannot declare class InteractiveCommand, because the name is already in use in /tmp/app/src/InteractiveCommand.php on line 6
PHP Stack trace:
PHP   1. {main}() /tmp/app/main.php:0
PHP   2. Tempest\Console\ConsoleApplication::boot($name = *uninitialized*, $root = *uninitialized*, $discoveryLocations = *uninitialized*) /tmp/app/main.php:8
PHP   3. Tempest\Core\Tempest::boot($root = NULL, $discoveryLocations = []) /tmp/app/vendor/tempest/console/src/ConsoleApplication.php:35
PHP   4. Tempest\Core\Kernel->__construct($root = '/tmp/app', $discoveryLocations = [], $container = *uninitialized*) /tmp/app/vendor/tempest/core/src/Tempest.php:19
PHP   5. Tempest\Core\Kernel->loadDiscovery() /tmp/app/vendor/tempest/core/src/Kernel.php:40
PHP   6. Tempest\Core\Kernel\LoadDiscoveryClasses->__invoke() /tmp/app/vendor/tempest/core/src/Kernel.php:112
PHP   7. Tempest\Reflection\ClassReflector->__construct($reflectionClass = 'T\\App\\InteractiveCommand') /tmp/app/vendor/tempest/core/src/Kernel/LoadDiscoveryClasses.php:96
PHP   8. ReflectionClass->__construct($objectOrClass = 'T\\App\\InteractiveCommand') /tmp/app/vendor/tempest/reflection/src/ClassReflector.php:28
PHP   9. Composer\Autoload\ClassLoader->loadClass($class = 'T\\App\\InteractiveCommand') /tmp/app/vendor/tempest/reflection/src/ClassReflector.php:28
PHP  10. Composer\Autoload\{closure:/tmp/app/vendor/composer/ClassLoader.php:581-583}($file = '/tmp/app/vendor/composer/../../src/InteractiveCommand.php') /tmp/app/vendor/composer/ClassLoader.php:433
PHP  11. include() /tmp/app/vendor/composer/ClassLoader.php:582
Does this class have the right namespace?

   Whoops\Exception\ErrorException

  Cannot declare class InteractiveCommand, because the name is already in use

  at src/InteractiveCommand.php:6
      2▕
      3▕ use Tempest\Console\Console;
      4▕ use Tempest\Console\ConsoleCommand;
      5▕
  ➜   6▕ final readonly class InteractiveCommand
      7▕ {
      8▕     public function __construct(private Console $console) {}
      9▕
     10▕     #[ConsoleCommand('hello:world')]

      +1 vendor frames

  2   [internal]:0
      Whoops\Run::handleShutdown()
```