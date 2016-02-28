<?php namespace nobackend\Repository\Contracts;

use \MongoDB\Driver\Cursor;
use \MongoDB\Driver\Query;

interface AbstractRepositoryInterface
{

    /**
     * @param string $projectId
     * @param string $key
     * @param string $value
     *
     * @return array
     */
    public function findBy($projectId, $key, $value);

    /**
     * @param string $projectId
     * @param array $data
     *
     * @return void
     */
    public function create($projectId, array $data);

    /**
     * @param string $collectionName
     * @param Query $query
     *
     * @return Cursor
     */
    public function query($collectionName, Query $query);

}