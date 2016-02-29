<?php namespace nobackend;

use nobackend\Repository\RepoFactory;
use Silex\Provider\TwigServiceProvider;

class Application extends \Silex\Application
{
    const STATUS_SUCCESS = 'success';
    const STATUS_ERROR = 'error';

    public function __construct(array $values = [])
    {
        parent::__construct($values);

        $this->_initRepository();
        $this->_initTranslate();
        $this->_initConfigs();
        $this->_initRegister();
    }

    private function _initRepository()
    {
        RepoFactory::init();
    }

    private function _initTranslate()
    {
        Translate::getInstance()->setLanguage(Config::get('app.language'));
    }

    private function _initConfigs()
    {
        $this['debug'] = Config::get('app.debug');
    }

    private function _initRegister()
    {
        $this->register(new TwigServiceProvider(), array(
            'twig.path' => APP_WEB . '/../views',
        ));
    }
}