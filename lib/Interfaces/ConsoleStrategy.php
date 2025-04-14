<?php

namespace PHPNomad\Console\Interfaces;

interface ConsoleStrategy
{
    /**
     * @param callable(): Command $commandGetter
     * @return mixed
     */
    public function registerCommand(callable $commandGetter);
}