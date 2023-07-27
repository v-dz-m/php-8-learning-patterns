<?php

interface Mediator
{
    public function getWorker();
}

abstract class Worker
{
    private string $name;

    /**
     * @param string $position
     */
    public function __construct(string $position)
    {
        $this->name = $position;
    }

    public function sayHello()
    {
        var_dump("Hello");
    }

    public function work(): string
    {
        return "$this->name is working now";
    }
}

class InfoBase
{
    public function printInfo(Worker $worker)
    {
        var_dump($worker->work());
    }
}

class WorkerInfoBaseMediator implements Mediator
{
    private Worker $worker;
    private InfoBase $infoBase;

    /**
     * @param Worker $worker
     * @param InfoBase $infoBase
     */
    public function __construct(Worker $worker, InfoBase $infoBase)
    {
        $this->worker = $worker;
        $this->infoBase = $infoBase;
    }

    public function getWorker()
    {
        $this->infoBase->printInfo($this->worker);
    }
}

class Developer extends Worker
{

}

class Designer extends Worker
{

}

$developer = new Developer('PHP/Laravel developer');
$designer = new Designer('Figma designer');
$infoBase = new InfoBase();

$workerInfoBaseMediator = new WorkerInfoBaseMediator($developer, $infoBase);
$workerInfoBaseMediator->getWorker();

$designerInfoBaseMediator = new WorkerInfoBaseMediator($designer, $infoBase);
$designerInfoBaseMediator->getWorker();
