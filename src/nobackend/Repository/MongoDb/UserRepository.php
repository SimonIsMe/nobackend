<?php namespace nobackend\Repository\MongoDB;

use nobackend\Repository\Contracts\UserRepositoryInterface;

class UserRepository extends AbstractRepository implements UserRepositoryInterface
{
    protected $_collectionName = 'users';
}