<?php

class WorkerList
{
    public array $list = [];
    private int $index = 0;

    /**
     * @return array
     */
    public function getList(): array
    {
        return $this->list;
    }

    /**
     * @param array $list
     */
    public function setList(array $list): void
    {
        $this->list = $list;
    }

    /**
     * @return int
     */
    public function getIndex(): int
    {
        return $this->index;
    }

    /**
     * @param int $index
     */
    public function setIndex(int $index): void
    {
        $this->index = $index;
    }

    public function getItem($key): ?Worker
    {
        if ($this->list[$key]) {
            return $this->list[$key];
        }
        return null;
    }

    public function next()
    {
        if ($this->index < count($this->list) - 1) {
            $this->index++;
        };
    }

    public function prev()
    {
        if ($this->index > 0) {
            $this->index--;
        }
    }

    public function refresh()
    {
        $this->index = 0;
    }

    public function getByIndex(): Worker
    {
        return $this->list[$this->index];
    }
}

class Worker
{
    private string $name = '';

    /**
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}

$worker1 = new Worker('Vadzim');
$worker2 = new Worker('Aliaksandr');
$worker3 = new Worker('Volha');

$workerList = new WorkerList();
$workerList->setList([$worker1, $worker2, $worker3]);
$workerList->next();
$workerList->next();
var_dump($workerList->getByIndex()->getName());
$workerList->refresh();
var_dump($workerList->getByIndex()->getName());
