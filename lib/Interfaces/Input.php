<?php

namespace PHPNomad\Console\Interfaces;

/**
 * Represents the input passed to a CLI command.
 */
interface Input
{
    /**
     * Get a specific parameter value.
     *
     * @param string $name
     * @param mixed|null $default
     * @return mixed
     */
    public function getParam(string $name, mixed $default = null): mixed;

    /**
     * Check if a parameter exists.
     *
     * @param string $name
     * @return bool
     */
    public function hasParam(string $name): bool;

    /**
     * Set a parameter value.
     *
     * @param string $name
     * @param mixed $value
     * @return static
     */
    public function setParam(string $name, mixed $value): static;

    /**
     * Remove a parameter.
     *
     * @param string $name
     * @return static
     */
    public function removeParam(string $name): static;

    /**
     * Get all parameters as an associative array.
     *
     * @return array<string, mixed>
     */
    public function getParams(): array;

    /**
     * Replace all parameters with a new set.
     *
     * @param array<string, mixed> $params
     * @return static
     */
    public function replaceParams(array $params): static;
}