<?php

interface Worker
{
    public function countSalary(): int;
}

abstract class WorkerDecorator implements Worker
{
    public Worker $worker;

    public function __construct($worker)
    {
        $this->worker = $worker;
    }
}

class Developer implements Worker
{
    public function countSalary(): int
    {
        return 120 * 21;
    }
}

class DeveloperOverTime extends WorkerDecorator
{
    public function countSalary(): int
    {
        return $this->worker->countSalary() * 1.2;
    }
}

$developer = new Developer();
$developerOverTime = new DeveloperOverTime($developer);
var_dump($developer->countSalary());
var_dump($developerOverTime->countSalary());
