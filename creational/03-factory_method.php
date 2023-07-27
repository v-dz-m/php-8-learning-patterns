<?php

interface Worker
{
    public function work();
}

class Developer implements Worker
{
    public function work()
    {
        var_dump('I am developing');
    }

}

class Designer implements Worker
{
    public function work()
    {
        var_dump('I am designing');
    }

}

interface WorkerFactory
{
    public static function make();
}

class DeveloperFactory implements WorkerFactory
{
    public static function make()
    {
        return new Developer();
    }

}

class DesignerFactory implements WorkerFactory
{
    public static function make()
    {
        return new Designer();
    }

}

$developerFactory = new DeveloperFactory();
$designerFactory = new DesignerFactory();
$developer = DeveloperFactory::make();
$designer = DesignerFactory::make();

$developer->work();
$designer->work();
