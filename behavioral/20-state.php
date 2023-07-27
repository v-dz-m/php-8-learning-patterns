<?php

interface State
{
    public function toNext(Task $task);

    public function getStatus(): string;
}

class Task
{
    private State $state;

    /**
     * @return State
     */
    public function getState(): State
    {
        return $this->state;
    }

    /**
     * @param State $state
     */
    public function setState(State $state): void
    {
        $this->state = $state;
    }

    public static function make()
    {
        $self = new self();
        $self->setState(new Created());
        return $self;
    }

    public function proceedToNext()
    {
        $this->state->toNext($this);
    }
}

class Created implements State
{

    public function toNext(Task $task)
    {
        $task->setState(new Processed());
    }

    public function getStatus(): string
    {
        return "Created";
    }
}

class Processed implements State
{

    public function toNext(Task $task)
    {
        $task->setState(new Tested());
    }

    public function getStatus(): string
    {
        return "Processed";
    }
}

class Tested implements State
{

    public function toNext(Task $task)
    {
        $task->setState(new Done());
    }

    public function getStatus(): string
    {
        return "Tested";
    }
}

class Done implements State
{

    public function toNext(Task $task)
    {
        // TODO: Implement toNext() method.
    }

    public function getStatus(): string
    {
        return "Done";
    }
}

$task = Task::make();
$task->proceedToNext();
$task->proceedToNext();
$task->proceedToNext();
var_dump($task->getState()->getStatus());
