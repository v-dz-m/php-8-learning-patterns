<?php

abstract class Handler
{
    private ?Handler $successor;

    /**
     * @param ?Handler $successor
     */
    public function __construct(?Handler $successor)
    {
        $this->successor = $successor;
    }

    final public function handle(TaskInterface $task)
    {
        $proceed = $this->processing($task);
        if ($proceed === null && $this->successor) {
            $proceed = $this->successor->handle($task);
        }

        return $proceed;
    }

    abstract public function processing(TaskInterface $task): ?array;
}

interface TaskInterface
{
    public function getArray(): array;
}

class DevTask implements TaskInterface
{
    private array $arr = [10, 20, 30];

    public function getArray(): array
    {
        return $this->arr;
    }
}

class Junior extends Handler
{
    public function processing(TaskInterface $task): ?array
    {
        return null;
    }
}

class Middle extends Handler
{
    public function processing(TaskInterface $task): ?array
    {
        return null;
    }
}

class Senior extends Handler
{
    public function processing(TaskInterface $task): ?array
    {
        return $task->getArray();
    }
}

$task = new DevTask();

$senior = new Senior(null);
$middle = new Middle($senior);
$junior = new Junior($middle);

var_dump($junior->handle($task));
