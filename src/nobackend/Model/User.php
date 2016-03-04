<?php namespace nobackend\Model;

use nobackend\Repository\Contracts\UserRepositoryInterface;

class User extends AbstractModel
{
    protected $_repositoryName = UserRepositoryInterface::NAME;
}