<?php

interface Specification
{
    public function isNormal(Pupil $pupil): bool;
}

class Pupil
{
    private int $rate = 0;

    /**
     * @param int $rate
     */
    public function __construct(int $rate)
    {
        $this->rate = $rate;
    }

    /**
     * @return int
     */
    public function getRate(): int
    {
        return $this->rate;
    }
}

class PupilSpecification implements Specification
{
    private int $needRate = 0;

    /**
     * @param int $needRate
     */
    public function __construct(int $needRate)
    {
        $this->needRate = $needRate;
    }

    public function isNormal(Pupil $pupil): bool
    {
        return $this->needRate < $pupil->getRate();
    }
}

class AndSpecification implements Specification
{
    private array $specification;

    /**
     * @param array $specification
     */
    public function __construct(Specification ...$specification)
    {
        $this->specification = $specification;
    }

    public function isNormal(Pupil $pupil): bool
    {
        foreach ($this->specification as $specification) {
            if (!$specification->isNormal($pupil)) {
                return false;
            }
        }
        return true;
    }
}

class OrSpecification implements Specification
{
    private array $specification;

    /**
     * @param array $specification
     */
    public function __construct(Specification ...$specification)
    {
        $this->specification = $specification;
    }

    public function isNormal(Pupil $pupil): bool
    {
        foreach ($this->specification as $specification) {
            if ($specification->isNormal($pupil)) {
                return true;
            }
        }
        return false;
    }
}

class NotSpecification implements Specification
{
    private Specification $specification;

    /**
     * @param Specification $specification
     */
    public function __construct(Specification $specification)
    {
        $this->specification = $specification;
    }

    public function isNormal(Pupil $pupil): bool
    {
        return !($this->specification->isNormal($pupil));
    }
}

$pupil = new Pupil(9);

$psp1 = new PupilSpecification(5);
$psp2 = new PupilSpecification(10);
var_dump($psp1->isNormal($pupil));
var_dump($psp2->isNormal($pupil));

$andSp = new AndSpecification($psp1, $psp2);
var_dump($andSp->isNormal($pupil));

$orSp = new OrSpecification($psp1, $psp2);
var_dump($orSp->isNormal($pupil));

$notSp = new NotSpecification($psp2);
var_dump($notSp->isNormal($pupil));
