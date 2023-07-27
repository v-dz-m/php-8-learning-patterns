<?php

abstract class Task
{
    public function printSections()
    {
        $this->printHeader();
        $this->printBody();
        $this->printFooter();
        $this->printCustom();
    }

    private function printHeader()
    {
        var_dump("Header");
    }

    private function printBody()
    {
        var_dump("Body");
    }

    private function printFooter()
    {
        var_dump("Footer");
    }

    abstract protected function printCustom();
}

class DeveloperTask extends Task
{
    protected function printCustom()
    {
        var_dump("For Developer");
    }
}

class DesignerTask extends Task
{
    protected function printCustom()
    {
        var_dump("For Designer");
    }
}

$developerTask = new DesignerTask();
$developerTask->printSections();
