<?php namespace nobackend\Repository\MongoDb;

use nobackend\Repository\Contracts\UserRepositoryInterface;

class ProjectRepository extends AbstractRepository implements UserRepositoryInterface
{
    protected $_collectionName = 'projects';
}