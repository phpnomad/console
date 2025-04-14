<?php

namespace PHPNomad\Console\Interfaces;

interface HasMiddleware
{
    /**
     * @return Middleware[]
     */
    public function getMiddleware(Input $input): array;
}