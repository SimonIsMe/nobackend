<?php namespace nobackend\Repository\MongoDb;

use nobackend\{
    Config,
    Repository\Contracts\AbstractRepositoryInterface
};
use \MongoDB\Driver\{
    BulkWrite,
    Cursor,
    Manager,
    Query,
    WriteConcern
};

abstract class AbstractRepository implements AbstractRepositoryInterface
{
    /**
     * @var Manager
     */
    protected $_manager;

    public function __construct()
    {
        $stringConnection = 'mongodb://' . Config::get('database.host') . ':' . Config::get('database.port');
        $this->_manager = new Manager($stringConnection);
    }

    /**
     * @param string $projectId
     * @param string $id
     *
     * @return stdClass
     */
    public function find(string $projectId, string $id) : \stdClass
    {
        $results = $this->query($this->_getCollectionName($projectId), new Query(['_id' => new \MongoDB\BSON\ObjectID($id)]));
        $array = $results->toArray();

        if (empty($array)) {
            return null;
        }
        return $array[0];
    }

    /**
     * @param string $projectId
     * @param string $key
     * @param string $value
     *
     * @return array
     */
    public function findBy(string $projectId, string $key, string $value) : array
    {
        $results = $this->query($this->_getCollectionName($projectId), new Query([$key => $value]));
        return $results->toArray();
    }

    /**
     * @param string $projectId
     * @param string $key
     * @param string $value
     *
     * @return int
     */
    public function countBy(string $projectId, string $key, string $value) : int
    {
        $results = $this->query($this->_getCollectionName($projectId), new Query([$key => $value]));

        //  todo
        return 1;
    }

    /**
     * @param string $projectId
     * @param array $data
     *
     * @return string
     */
    public function create(string $projectId, array $data)
    {
        $bulk = new BulkWrite();
        $insert = $bulk->insert($data);
        $this->_manager->executeBulkWrite($this->_getCollectionName($projectId), $bulk, new WriteConcern(WriteConcern::MAJORITY, 1000));
        return $insert->__toString();
    }

    /**
     * @param string $collectionName
     * @param Query $query
     *
     * @return Cursor
     */
    public function query(string $collectionName, Query $query) : Cursor
    {
        return $this->_manager->executeQuery($collectionName, $query);
    }

    /**
     * @param string $projectId
     *
     * @return string
     */
    protected function _getCollectionName(string $projectId) : string
    {
        return $projectId . '.' . $this->_collectionName;
    }

}