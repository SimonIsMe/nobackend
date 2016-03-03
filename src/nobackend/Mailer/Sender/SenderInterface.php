<?php namespace nobackend\Mailer\Sender;

interface SenderInterface
{
    /**
     * @param string $fromEmail
     * @param string $fromName
     * @param string $toEmail
     * @param string $title
     * @param string $body
     *
     * @return void
     */
    public function send(string $fromEmail, string $fromName, string $toEmail, string $title, string $body);
}