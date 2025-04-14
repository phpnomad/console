<?php

namespace PHPNomad\Console\Interfaces;

interface HasInterceptors
{
    /**
     * @param Input $input
     * @return Interceptor[]
     */
    public function getInterceptors(Input $input): array;
}