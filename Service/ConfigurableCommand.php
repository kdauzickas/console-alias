<?php

namespace KD\Console\AliasBundle\Service;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class name says it all
 */
class ConfigurableCommand extends Command
{
    /**
     * @var array
     */
    protected $configuration;

    public function __construct(array $configuration, $name = null)
    {
        $this->configuration = $configuration;

        parent::__construct($name);
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName($this->configuration['name'])
            ->setDescription($this->configuration['description']);
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $args = $this->configuration['arguments'];

        if ($this->configuration['console']) {
            $command = $this->getApplication()->find($this->configuration['command']);
            array_unshift($args, $this->configuration['command']);

            return $command->run(new ArrayInput($args), $output);
        }

        $code = 0;
        passthru($this->configuration['command'].' '.implode(' ', $args), $code);

        return $code;
    }
}
