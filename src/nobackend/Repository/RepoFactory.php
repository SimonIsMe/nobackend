<?php namespace nobackend\Repository;

use nobackend\Repository\Contracts\{
    AbstractRepositoryInterface,
    ProjectRepositoryInterface,
    UserRepositoryInterface
};
use nobackend\Repository\MongoDb\{
    ProjectRepository,
    UserRepository
};

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
    public static function get(string $name) : AbstractRepositoryInterface
    {
        if (null == self::$_repositories[$name]) {
            throw new RepositoryNotFoundException('I can\'t find repository under "' . $name . '" name."');
        }

        return self::$_repositories[$name];
    }
}