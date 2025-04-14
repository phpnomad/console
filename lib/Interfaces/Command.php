<?php

namespace PHPNomad\Console\Interfaces;

/**
 * Represents a single executable CLI command within the PHPNomad Console system.
 *
 * This interface allows commands to define their signature, description,
 * and execution behavior using normalized Input and Output contracts.
 */
interface Command
{
    /**
     * Returns the CLI signature for this command.
     *
     * This string defines the structure, syntax, and expected input
     * for the command, including positional arguments and named options.
     * The format is declarative and self-documenting, and is intended to
     * be parsed by the ConsoleStrategy to support cross-platform execution.
     *
     * ### Format:
     * - Command name comes first (e.g. `set slack-token`), followed by any parameters.
     * - Parameters are enclosed in `{}` and may include optionality, default values, or descriptions.
     *
     * ### Parameter Syntax:
     * - `{param}`                     → required positional argument
     * - `{param?:Description}`        → optional positional argument with description
     * - `{--flag}`                    → boolean flag (true if present)
     * - `{--option=}`                 → required named option (e.g. `--option=value`)
     * - `{--option=default}`          → optional named option with default value
     * - `{--option=default:Description}` → named option with default and help text
     * - `{param:Description}`         → required positional with description
     * - `{param?:Description}`        → optional positional with description
     *
     * ### Examples:
     * - `set slack-token {token:The Slack token to store}`
     * - `deploy {env:Target environment} {--force:Force deployment}`
     * - `report:generate {--email=user@example.com:Email to send report to}`
     *
     * ### Purpose:
     * - Parsed by platform-specific ConsoleStrategies (e.g., WP-CLI, Symfony)
     * - Used to generate help output, map `$argv` to named parameters,
     *   assign default values, and validate presence/structure of inputs.
     *
     * Note: Input values are always received as strings and are transformed or
     * validated later via middleware. This method is declarative only.
     *
     * @return string
     */
    public function getSignature(): string;

    /**
     * Returns a short, human-readable description of the command.
     *
     * This is used for help documentation and listing available commands.
     *
     * @return string
     */
    public function getDescription(): string;

    /**
     * Executes the command using the fully-parsed and validated input.
     *
     * Middleware will typically inject defaults, validate required fields,
     * and apply any necessary transformation before this is called.
     *
     * @param Input $input Parsed input data for this command.
     * @return int Exit code: 0 = success, non-zero = failure.
     */
    public function handle(Input $input): int;
}