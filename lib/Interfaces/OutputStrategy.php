<?php

namespace PHPNomad\Console\Interfaces;


/**
 * Represents output handling for a CLI command.
 *
 * Allows writing to the console in a stylized and chainable way.
 */
interface OutputStrategy
{
    /**
     * Write a plain line of text.
     *
     * @param string $message
     * @return $this
     */
    public function writeln(string $message): static;

    /**
     * Write an informational message (e.g., blue or dim text).
     *
     * @param string $message
     * @return $this
     */
    public function info(string $message): static;

    /**
     * Write a success message (e.g., green text).
     *
     * @param string $message
     * @return $this
     */
    public function success(string $message): static;

    /**
     * Write a warning message (e.g., yellow text).
     *
     * @param string $message
     * @return $this
     */
    public function warning(string $message): static;

    /**
     * Write an error message (e.g., red text).
     *
     * @param string $message
     * @return $this
     */
    public function error(string $message): static;

    /**
     * Output a blank line.
     *
     * @return $this
     */
    public function newline(): static;

    /**
     * Output a list of items as a formatted table.
     *
     * @param array<int, array<string, mixed>> $rows List of rows, each an associative array
     * @param array<string> $headers Optional: list of headers to enforce column order
     * @return $this
     */
    public function table(array $rows, array $headers = []): static;
}