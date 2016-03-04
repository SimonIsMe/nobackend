<?php namespace nobackend\Mailer;

use nobackend\Config;
use nobackend\Model\User;

class AuthMailer extends AbstractMailer
{
    /**
     * @param string $projectId
     * @param string $userId
     * @param string $activationToken
     *
     * @return void
     *
     * @throws \nobackend\Repository\RepositoryNotFoundException
     */
    public function register(string $projectId, string $userId, string $activationToken)
    {
        $user = new User($projectId, $userId);
        $user->activationToken = $activationToken;
        $user->save();

        $this->_send(
            Config::get('mail.register.email'),
            Config::get('mail.register.name'),
            $user->email,
            'Confirm your e-mail address',
            'register.twig',
            ['user' => $user]
        );
    }
}