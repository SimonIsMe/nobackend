<?php namespace nobackend;

use nobackend\Mailer\AuthMailer;
use nobackend\Repository\Contracts\UserRepositoryInterface;
use nobackend\Repository\RepoFactory;
use nobackend\Repository\RepositoryNotFoundException;

class Auth
{
    const ACCOUNT_NO_ACTIVE = 0;
    const ACCOUNT_ACTIVE = 1;

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
        $activationToken = md5(microtime());
        $userRepo = RepoFactory::get(UserRepositoryInterface::NAME);
        $userId = $userRepo->create($projectId, [
            'email' => $email,
            'password' => self::_hashPassword($password),
            'activationToken' => $activationToken,
            'is_active' => self::ACCOUNT_NO_ACTIVE
        ]);

        $mailer = new AuthMailer();
        $mailer->register($userId, $activationToken);
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