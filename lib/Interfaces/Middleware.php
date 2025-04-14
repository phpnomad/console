<?php

namespace PHPNomad\Console\Interfaces;

interface Middleware
{
    public function process(Input $input);
}