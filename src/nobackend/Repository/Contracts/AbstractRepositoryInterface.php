<?php namespace nobackend\Repository\Contracts;

use \MongoDB\Driver\{
    Cursor,
    Query
};

interface AbstractRepositoryInterface
{

    /**
     * @param string $projectId
     * @param string $key
     * @param string $value
     *
     * @return array
     */
    public function findBy(string $projectId, string $key, string $value);

    /**
     * @param string $projectId
     * @param array $data
     *
     * @return string
     */
    public function create(string $projectId, array $data);

    /**
     * @param string $collectionName
     * @param Query $query
     *
     * @return Cursor
     */
    public function query(string $collectionName, Query $query);

}