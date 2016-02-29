<?php namespace nobackend\Repository;

use nobackend\Repository\Contracts\AbstractRepositoryInterface;
use nobackend\Repository\Contracts\ProjectRepositoryInterface;
use nobackend\Repository\Contracts\UserRepositoryInterface;
use nobackend\Repository\MongoDb\ProjectRepository;
use nobackend\Repository\MongoDb\UserRepository;

class RepoFactory
{
    private static $_repositories;

    /**
     * @return void
     */
    public static function init()
    {
        if (null != self::$_repositories) {
            return;
        }

        self::$_repositories[UserRepositoryInterface::NAME] = new UserRepository();
        self::$_repositories[ProjectRepositoryInterface::NAME] = new ProjectRepository();
    }

    /**
     * @param string $name
     *
     * @return AbstractRepositoryInterface
     *
     * @throws RepositoryNotFoundException
     */
    public static function get($name)
    {
        if (null == self::$_repositories[$name]) {
            throw new RepositoryNotFoundException('I can\'t find repository under "' . $name . '" name."');
        }

        return self::$_repositories[$name];
    }
}