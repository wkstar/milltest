<?php 
namespace YoutubeBundle\Util;

class Email
{
    public $mailer;
    public $message;

    public function __construct($mailer, $message)
    {
        $this->mailer = $mailer;
        $this->message = $message;
    }

    public function send($subject, $fromEmail, $recipientEmail, $body)
    {
        $this->message  ->setSubject($subject)
                        ->setFrom($fromEmail)
                        ->setTo($recipientEmail)
                        ->setBody($body);
        $this->mailer->send($this->message);
    }
}