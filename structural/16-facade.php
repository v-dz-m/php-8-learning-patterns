<?php

class WorkerFacade
{
    private Developer $developer;
    private Designer $designer;

    /**
     * @param Developer $developer
     * @param Designer $designer
     */
    public function __construct(Developer $developer, Designer $designer)
    {
        $this->developer = $developer;
        $this->designer = $designer;
    }

    public function startWork()
    {
        $this->developer->startDevelop();
        $this->designer->startDesign();
    }

    public function stopWork()
    {
        $this->developer->stopDevelop();
        $this->designer->stopDesign();
    }
}

class Developer
{
    public function startDevelop()
    {
        var_dump('start develop');
    }

    public function stopDevelop()
    {
        var_dump('stop develop');
    }
}

class Designer
{
    public function startDesign()
    {
        var_dump('start design');
    }

    public function stopDesign()
    {
        var_dump('stop design');
    }
}

$developer = new Developer();
$designer = new Designer();

$workerFacade = new WorkerFacade($developer, $designer);
$workerFacade->startWork();
$workerFacade->stopWork();