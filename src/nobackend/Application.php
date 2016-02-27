<?php namespace nobackend;

class Application extends \Silex\Application
{
    const STATUS_SUCCESS = 'success';
    const STATUS_ERROR = 'error';

    public function __construct(array $values = [])
    {
        $this->_initConfigs();
        parent::__construct($values);
    }

    private function _initConfigs()
    {
        $app['debug'] = Config::get('app.debug');
    }
}