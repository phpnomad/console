<?php

namespace PHPNomad\Console\Interfaces;

interface Interceptor
{
    public function process(Input $input, int $exitCode);
}