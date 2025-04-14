<?php

namespace PHPNomad\Console\Interfaces;

interface HasCommands
{
    /**
     * @return class-string<Command>[]
     */
    public function getCommands(): array;
}