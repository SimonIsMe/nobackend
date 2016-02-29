<?php namespace nobackend\Repository\MongoDb;

use nobackend\Repository\Contracts\UserRepositoryInterface;

class UserRepository extends AbstractRepository implements UserRepositoryInterface
{
    protected $_collectionName = 'users';
}