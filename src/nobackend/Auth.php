<?php namespace nobackend;

use nobackend\Repository\Contracts\UserRepositoryInterface;
use nobackend\Repository\RepoFactory;
use nobackend\Repository\RepositoryNotFoundException;

class Auth
{
    /**
     * Return session ID.
     *
     * @param string $projectId
     * @param string $email
     * @param string $password
     *
     * @return string
     *
     * @throws RepositoryNotFoundException
     */
    public static function login($projectId, $email, $password)
    {
        $userRepo = RepoFactory::get(UserRepositoryInterface::NAME);
        $user = $userRepo->findBy($projectId, 'email', $email);

        return self::_hashPassword($password) == $user->password;
    }

    /**
     * @param string $projectId
     * @param string $email
     * @param string $password
     *
     * @return void
     *
     * @throws RepositoryNotFoundException
     */
    public static function register($projectId, $email, $password)
    {
        $userRepo = RepoFactory::get(UserRepositoryInterface::NAME);
        $userRepo->create($projectId, [
            'email' => $email,
            'password' => self::_hashPassword($password)
        ]);
    }

    /**
     * @param string $password
     *
     * @return string
     */
    private static function _hashPassword($password)
    {
        return sha1($password . Config::get('app.passwordSalt'));
    }

    /**
     * @param string $projectId
     * @param string $email
     * @param string $sessionId
     *
     * @return void
     */
    public static function logout($projectId, $email, $sessionId)
    {
        // TODO
    }

    /**
     * @param string $projectId
     * @param string $email
     *
     * @return string
     */
    public static function getNewSessionId($projectId, $email)
    {
        //  todo
    }
}