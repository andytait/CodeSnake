<?php

namespace CodeSnake\Console;

use CodeSnake\Snake\SnakeRowFormatter;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class RunCodeSnake
 * @package CodeSnake\Console
 */
class RunCodeSnake extends Command
{
    /**
     * @var SnakeRowFormatter
     */
    private $snakeRowFormatter;

    /**
     * RunCodeSnake constructor.
     * @param SnakeRowFormatter $snakeRowFormatter
     */
    public function __construct(SnakeRowFormatter $snakeRowFormatter)
    {
        parent::__construct();

        $this->snakeRowFormatter = $snakeRowFormatter;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $phrase = $input->getOption('phrase') ?? 'JAMES SINKS SAUSAGE ENEMA';

        $output->writeln("<comment>Snaking the phrase “{$phrase}”</comment>");

        (new Table($output))
        ->setRows($this->snakeRowFormatter->getSplitRows($phrase))
        ->setStyle('borderless')
        ->render();

        return 0;
    }

    /**
     * Configure console job
     */
    protected function configure()
    {
        $this->setName('snake')
            ->setDescription('Code Snake')
            ->addOption(
                'phrase',
                null,
                InputOption::VALUE_OPTIONAL,
                'Phrase you wish to code snake'
            );
    }
}
