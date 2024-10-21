<?php

use Tempest\Console\Console;
use Tempest\Console\ConsoleCommand;

final readonly class InteractiveCommand
{
    public function __construct(private Console $console) {}

    #[ConsoleCommand('hello:world')]
    public function __invoke(): void
    {
        $this->console->writeln('Hello World!');
    }
}
