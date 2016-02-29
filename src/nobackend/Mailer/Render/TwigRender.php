<?php namespace nobackend\Mailer;

use Twig_Environment;
use Twig_Loader_Filesystem;

class TwigRender implements RenderInterface
{
    /**
     * @var Twig_Environment
     */
    private $_twig;

    public function __construct()
    {
        $loader = new Twig_Loader_Filesystem(APP_WEB . '/../views/emails');
        $this->_twig = new Twig_Environment($loader);
    }

    /**
     * @param string $file
     * @param array $data = []
     *
     * @return string
     */
    public function render($file, array $data = [])
    {
        return $this->_twig->render('hello.twig', array('name' => 'Fabien'));
    }
}