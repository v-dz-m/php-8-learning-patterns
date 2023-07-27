<?php

interface Mail
{
    public function render(): string;
}

abstract class TypeMail
{
    private string $text;

    /**
     * @param string $text
     */
    public function __construct(string $text)
    {
        $this->text = $text;
    }

    public function getText()
    {
        return $this->text;
    }
}

class BusinessMail extends TypeMail implements Mail
{

    public function render(): string
    {
        return $this->getText() . " from business mail";
    }
}

class JobMail extends TypeMail implements Mail
{

    public function render(): string
    {
        return $this->getText() . " from job mail";
    }
}

class MailFactory
{
    private array $pool = [];

    public function getMail($id, $typeMail): Mail
    {
        if (!isset($this->pool[$id])) {
            return $this->pool[$id] = $this->make($typeMail);
        }

        return $this->pool[$id];
    }

    private function make($typeMail): Mail
    {
        if ($typeMail == 'job') {
            return new JobMail('Job text');
        }

        return new BusinessMail('Business text');
    }
}

$mailFactory = new MailFactory();
$mail = $mailFactory->getMail(10, 'job');
var_dump($mail->render());
$mail2 = $mailFactory->getMail(5, 'business');
var_dump($mail2->render());
$mail3 = $mailFactory->getMail(5, 'job');
var_dump($mail3->render());

