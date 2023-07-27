<?php

class Memento
{
    private State $state;

    /**
     * @param State $state
     */
    public function __construct(State $state)
    {
        $this->state = $state;
    }

    /**
     * @return State
     */
    public function getState(): State
    {
        return $this->state;
    }
}

class State
{
    public const CREATED = 'created';
    public const PROCESSING = 'processing';
    public const TESTING = 'testing';
    public const DONE = 'done';

    private string $state;

    /**
     * @param string $state
     */
    public function __construct(string $state)
    {
        $this->state = $state;
    }

    public function __toString(): string
    {
        return $this->state;
    }
}

class Task
{
    private State $state;

    public function create()
    {
        $this->state = new State(State::CREATED);
    }

    public function process()
    {
        $this->state = new State(State::PROCESSING);
    }

    public function test()
    {
        $this->state = new State(State::TESTING);
    }

    public function finish()
    {
        $this->state = new State(State::DONE);
    }

    public function saveToMemento(): Memento
    {
        return new Memento($this->state);
    }

    public function restoreFromMemento(Memento $memento)
    {
        $this->state = $memento->getState();
    }

    public function getState(): State
    {
        return $this->state;
    }
}

$task = new Task();
$task->create();

$memento = $task->saveToMemento();
var_dump($memento->getState() === $task->getState());
