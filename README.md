# phpnomad/console

[![Latest Version](https://img.shields.io/packagist/v/phpnomad/console.svg)](https://packagist.org/packages/phpnomad/console)
[![Total Downloads](https://img.shields.io/packagist/dt/phpnomad/console.svg)](https://packagist.org/packages/phpnomad/console)
[![PHP Version](https://img.shields.io/packagist/php-v/phpnomad/console.svg)](https://packagist.org/packages/phpnomad/console)
[![License](https://img.shields.io/packagist/l/phpnomad/console.svg)](https://packagist.org/packages/phpnomad/console)

`phpnomad/console` defines the contracts PHPNomad applications use to describe CLI commands without binding to a specific console runtime. It ships the `Command`, `Input`, `OutputStrategy`, and `ConsoleStrategy` interfaces along with a declarative signature format for parameters and options. The package has no runtime dependencies of its own. Concrete execution comes from an integration such as [`phpnomad/symfony-console-integration`](https://packagist.org/packages/phpnomad/symfony-console-integration), which adapts the contracts to Symfony Console. You describe your commands once, and the host runtime parses input, maps arguments, and calls your handler.

## Installation

```bash
composer require phpnomad/console
```

You will also need a `ConsoleStrategy` implementation. For most projects that means pairing this package with `phpnomad/symfony-console-integration`.

## Overview

- `Command` declares a CLI command with a signature, description, and `handle(Input): int` method.
- The signature format is declarative. Required positionals look like `{name}`, optional positionals like `{name?:Description}`, flags like `{--force}`, and named options like `{--count=1:Number of items}`.
- `Input` exposes parsed parameters through `getParam`, `hasParam`, `setParam`, and `getParams`.
- `OutputStrategy` provides chainable writers for `writeln`, `info`, `success`, `warning`, `error`, `newline`, and `table` rendering.
- `HasCommands` lets an initializer expose a list of command class strings so the loader can register them with the active `ConsoleStrategy`.
- `Middleware` and `Interceptor` interfaces hook pre-execution transforms and post-execution side effects like logging or event dispatch.

## Quick example

A command implements three methods. An initializer lists the classes it owns.

```php
<?php

namespace MyApp\Deploy;

use PHPNomad\Console\Interfaces\Command;
use PHPNomad\Console\Interfaces\Input;
use PHPNomad\Console\Interfaces\OutputStrategy;

class DeployCommand implements Command
{
    public function __construct(protected OutputStrategy $output)
    {
    }

    public function getSignature(): string
    {
        return 'deploy {env:Target environment} {--force:Skip confirmation prompts}';
    }

    public function getDescription(): string
    {
        return 'Deploys the application to the given environment.';
    }

    public function handle(Input $input): int
    {
        $env = (string) $input->getParam('env');
        $force = (bool) $input->getParam('force', false);

        $this->output->info("Deploying to {$env} (force: " . ($force ? 'yes' : 'no') . ')')->newline();

        return 0;
    }
}
```

```php
<?php

namespace MyApp;

use MyApp\Deploy\DeployCommand;
use PHPNomad\Console\Interfaces\HasCommands;

class MyAppInitializer implements HasCommands
{
    public function getCommands(): array
    {
        return [
            DeployCommand::class,
        ];
    }
}
```

The active `ConsoleStrategy` picks up the commands at boot and registers them with the host runtime.

## Documentation

Broader PHPNomad documentation lives at [phpnomad.com](https://phpnomad.com).

## License

MIT. See [LICENSE.txt](LICENSE.txt).
