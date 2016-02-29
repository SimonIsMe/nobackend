<?php namespace nobackend\Mailer;

use nobackend\Mailer\Sender\PhpSender;
use nobackend\Mailer\Sender\SenderInterface;

class AbstractMailer
{
    /**
     * @var RenderInterface
     */
    private $_render;

    /**
     * @var SenderInterface
     */
    private $_sender;

    public function __construct()
    {
        $this->_render = new TwigRender();
        $this->_sender = new PhpSender();
    }

    /**
     * @param string $fromEmail
     * @param string $fromName
     * @param string $title
     * @param string $viewName
     * @param array $data = []
     *
     * @return void
     */
    protected function _send($fromEmail, $fromName, $title, $viewName, array $data = [])
    {
        $body = $this->_render->render($viewName, $data);
        $this->_sender->send($fromEmail, $fromName, $title, $body);
    }
}