<?php

namespace App\Command\ExampleCommand;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class ExampleCommand extends Command
{
    // вызов команды: php bin/console app:example
    protected static $defaultName = 'app:example';

    protected function configure()
    {
        // описание команды
        $this->setDescription('Команда выводит сообщение в консоль');
    }

    // метод, который будет вызван при вызове команды
    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $output->writeln('Вывод сообщения в консоль!');

        // вывод сообщения в консоль
        return Command::SUCCESS;
    }
}
