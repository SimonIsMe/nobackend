<?php namespace nobackend\Repository\MongoDb;

use MongoDB\Driver\Cursor;
use nobackend\Config;
use nobackend\Repository\Contracts\AbstractRepositoryInterface;
use \MongoDB\Driver\Manager;
use \MongoDB\Driver\Query;
use \MongoDB\Driver\BulkWrite;
use \MongoDB\Driver\WriteConcern;

abstract class AbstractRepository implements AbstractRepositoryInterface
{
    /**
     * @var Manager
     */
    protected $_manager;

    public function __construct()
    {
        $stringConnection = 'mongodb://' . Config::get('database.host') . '.' . Config::get('database.port');
        $this->_manager = new Manager($stringConnection);
    }

    /**
     * @param string $projectId
     * @param string $id
     *
     * @return array
     */
    public function find($projectId, $id)
    {
        $results = $this->query($this->_getCollectionName($projectId), new Query(['_id' => $id]));
        return $results->toArray();
    }

    /**
     * @param string $projectId
     * @param string $key
     * @param string $value
     *
     * @return array
     */
    public function findBy($projectId, $key, $value)
    {
        $results = $this->query($this->_getCollectionName($projectId), new Query([$key => $value]));
        return $results->toArray();
    }

    /**
     * @param string $projectId
     * @param array $data
     *
     * @return void
     */
    public function create($projectId, array $data)
    {
        $bulk = new BulkWrite();
        $bulk->insert($data);
        $this->_manager->executeBulkWrite($this->_getCollectionName($projectId), $bulk, new WriteConcern(WriteConcern::MAJORITY, 1000));
    }

    /**
     * @param string $collectionName
     * @param Query $query
     *
     * @return Cursor
     */
    public function query($collectionName, Query $query)
    {
        return $this->_manager->executeQuery($collectionName, $query);
    }

    /**
     * @param string $projectId
     *
     * @return string
     */
    protected function _getCollectionName($projectId)
    {
        return $projectId . $this->_collectionName;
    }

}