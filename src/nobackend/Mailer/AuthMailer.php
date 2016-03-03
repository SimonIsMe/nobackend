<?php namespace nobackend\Mailer;

use nobackend\Config;
use nobackend\Repository\Contracts\UserRepositoryInterface;
use nobackend\Repository\RepoFactory;

class AuthMailer extends AbstractMailer
{

    /**
     * @param string $userId
     * @param string $activationToken
     *
     * @return void
     */
    public function register(string $userId, string $activationToken)
    {
        $userData = RepoFactory::get(UserRepositoryInterface::NAME)->find($userId);

        $this->_send(
            Config::get('mail.register.email'),
            Config::get('mail.register.name'),
            'Confirm your e-mail address',
            'register',
            array_merge($userData, ['activationToken' => $activationToken])
        );
    }
}