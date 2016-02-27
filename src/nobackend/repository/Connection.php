<?php namespace nobackend\repository;

class Connection
{
    /**
     * @var \MongoDB\Driver\Manager
     */
    private $_manager;

    /**
     * @var Connection
     */
    private static $_instance;

    private function __construct()
    {
        $this->_manager = new \MongoDB\Driver\Manager("mongodb://localhost:27017");
    }

    /**
     * @return Connection
     */
    public static function getInstance()
    {
        if (null == self::$_instance) {
            self::$_instance = new Connection();
        }

        return self::$_instance;
    }

    /**
     * @return \MongoDB\Driver\Manager
     */
    public function getManager()
    {
        return $this->_manager;
    }

    public function query($collection, \MongoDB\Driver\Query $query)
    {
        $manager =$this->getManager();
        return $manager->executeQuery($collection, $query);
    }
}