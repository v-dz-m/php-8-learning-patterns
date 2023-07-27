<?php

interface AbstractFactory
{
    public static function makeDeveloperWorker(): DeveloperWorker;
    public static function makeDesignerWorker(): DesignerWorker;
}

class OutsourceWorkerFactory implements AbstractFactory
{

    public static function makeDeveloperWorker(): DeveloperWorker
    {
        return new OutsourceDeveloperWorker();
    }

    public static function makeDesignerWorker(): DesignerWorker
    {
        return new OutsourceDesignerWorker();
    }
}

class NativeWorkerFactory implements AbstractFactory
{

    public static function makeDeveloperWorker(): DeveloperWorker
    {
        return new NativeDeveloperWorker();
    }

    public static function makeDesignerWorker(): DesignerWorker
    {
        return new NativeDesignerWorker();
    }
}

interface Worker
{
    public function work();
}

interface DeveloperWorker extends Worker
{

}

interface DesignerWorker extends Worker
{

}

class NativeDeveloperWorker implements DeveloperWorker
{
    public function work()
    {
        var_dump('I am developing as native');
    }

}

class OutsourceDeveloperWorker implements DeveloperWorker
{
    public function work()
    {
        var_dump('I am developing as outsource');
    }

}

class NativeDesignerWorker implements DesignerWorker
{
    public function work()
    {
        var_dump('I am designing as native');
    }

}

class OutsourceDesignerWorker implements DesignerWorker
{
    public function work()
    {

        var_dump('I am designing as outsource');
    }

}

$nativeDeveloper = NativeWorkerFactory::makeDeveloperWorker();
$outsourceDeveloper = OutsourceWorkerFactory::makeDeveloperWorker();
$nativeDesigner = NativeWorkerFactory::makeDesignerWorker();
$outsourceDesigner = OutsourceWorkerFactory::makeDesignerWorker();

$nativeDesigner->work();
