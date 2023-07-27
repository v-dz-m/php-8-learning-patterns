<?php

interface NativeWorker
{
    public function countSalary(): int;
}

interface OutsourceWorker
{
    public function countSalaryByHours($hours);
}

class NativeDeveloper implements NativeWorker
{
    public function countSalary(): int
    {
        return 100 * 21;
    }
}

class OutsourceDeveloper implements OutsourceWorker
{
    public function countSalaryByHours($hours): int
    {
        return $hours * 18;
    }
}

class OutsourceWorkerAdapter implements NativeWorker
{
    private OutsourceWorker $outsourceWorker;

    /**
     * @param OutsourceWorker $outsourceWorker
     */
    public function __construct(OutsourceWorker $outsourceWorker)
    {
        $this->outsourceWorker = $outsourceWorker;
    }

    public function countSalary(): int
    {
        return $this->outsourceWorker->countSalaryByHours(80);
    }
}

$nativeDeveloper = new NativeDeveloper();
$outsourceWorker = new OutsourceDeveloper();
$outsourceWorkerAdapter = new OutsourceWorkerAdapter($outsourceWorker);
var_dump($nativeDeveloper->countSalary());
var_dump($outsourceWorkerAdapter->countSalary());
