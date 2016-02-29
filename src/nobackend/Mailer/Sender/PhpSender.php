<?php namespace nobackend\Mailer\Sender;

class PhpSender implements SenderInterface
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
    public function send($fromEmail, $fromName, $toEmail, $title, $body)
    {
        $headers[] = 'From: ' . $fromName . ' <' . $fromEmail . '>';

        mail($toEmail, $title, $body, implode("\r\n", $headers));
    }
}