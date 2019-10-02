<?php

namespace InviqaSprykerDebug\Zed\Behat\State;

use ArrayIterator;
use Countable;
use IteratorAggregate;
use Symfony\Component\Process\Process;

class ProcessState implements IteratorAggregate, Countable
{
    private $processes = [];

    public function create($command, string $cwd = null, array $env = null, $input = null, ?float $timeout = 60): Process
    {
        $process = new Process($command, $cwd, $env, $input, $timeout);
        $this->processes[] = $process;

        return $process;
    }

    /**
     * {@inheritDoc}
     */
    public function getIterator()
    {
        return new ArrayIterator($this->processes);
    }

    /**
     * {@inheritDoc}
     */
    public function count()
    {
        return count($this->processes);
    }

    public function getLastProcess(): Process
    {
        if (empty($this->processes)) {
            throw new RuntimeException(
                'No processes have been registered, cannot get the last one'
            );
        }

        return $this->processes[count($this->processes) - 1];
    }
}
