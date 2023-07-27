<?php

interface WorkerVisitor
{
    public function visitDeveloper(Worker $worker);
    public function visitDesigner(Worker $worker);
}

class RecordVisitor implements WorkerVisitor
{
    private array $visited = [];

    public function visitDeveloper(Worker $worker)
    {
        $this->visited[] = $worker;
    }

    public function visitDesigner(Worker $worker)
    {
        $this->visited[] = $worker;
    }

    /**
     * @return array
     */
    public function getVisited(): array
    {
        return $this->visited;
    }
}

interface Worker
{
    public function work();
    public function accept(WorkerVisitor $visitor);
}

class Developer implements Worker
{
    public function work()
    {
        print_r("Developer is working now");
    }

    public function accept(WorkerVisitor $visitor)
    {
        $visitor->visitDeveloper($this);
    }
}

class Designer implements Worker
{
    public function work()
    {
        print_r("Designer is working now");
    }

    public function accept(WorkerVisitor $visitor)
    {
        $visitor->visitDesigner($this);
    }
}

$visitor = new RecordVisitor();

$developer = new Developer();
$developer->accept($visitor);
$designer = new Designer();
$designer->accept($visitor);

var_dump($visitor->getVisited());
foreach ($visitor->getVisited() as $item) {
    $item->work();
}
