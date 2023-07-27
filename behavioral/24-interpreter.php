<?php

abstract class Expression
{
    abstract public function interpret(Context $context): bool;
}

class Context
{
    private array $worker = [];

    /**
     * @param string $worker
     */
    public function setWorker(string $worker): void
    {
        $this->worker[] = $worker;
    }

    public function lookUp($key): string|bool
    {
        if (isset($this->worker[$key])) {
            return $this->worker[$key];
        }

        return false;
    }
}

class VariableExp extends Expression
{
    private int $key;

    /**
     * @param int $key
     */
    public function __construct(int $key)
    {
        $this->key = $key;
    }

    public function interpret(Context $context): bool
    {
        return $context->lookUp($this->key);
    }
}

class AndExp extends Expression
{
    private int $keyFirst;
    private int $keySecond;

    /**
     * @param int $keyFirst
     * @param int $keySecond
     */
    public function __construct(int $keyFirst, int $keySecond)
    {
        $this->keyFirst = $keyFirst;
        $this->keySecond = $keySecond;
    }

    public function interpret(Context $context): bool
    {
        return $context->lookUp($this->keyFirst) && $context->lookUp($this->keySecond);
    }
}

class OrExp extends Expression
{
    private int $keyFirst;
    private int $keySecond;

    /**
     * @param int $keyFirst
     * @param int $keySecond
     */
    public function __construct(int $keyFirst, int $keySecond)
    {
        $this->keyFirst = $keyFirst;
        $this->keySecond = $keySecond;
    }

    public function interpret(Context $context): bool
    {
        return $context->lookUp($this->keyFirst) || $context->lookUp($this->keySecond);
    }
}

$context = new Context();
$context->setWorker('Bob');
$context->setWorker('Dad');

$varExp = new VariableExp(1);
$andExp = new AndExp(1, 3);
$orExp = new OrExp(1, 3);

var_dump($varExp->interpret($context));
var_dump($andExp->interpret($context));
var_dump($orExp->interpret($context));