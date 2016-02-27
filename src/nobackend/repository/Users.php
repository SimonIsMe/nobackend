<?php namespace nobackend\repository;

use Carbon\Carbon;

class Users
{
    public static function register($projectId, $email, $password)
    {
        $manager = Connection::getInstance()->getManager();
        $writeConcern = new \MongoDB\Driver\WriteConcern(\MongoDB\Driver\WriteConcern::MAJORITY, 1000);

        $activationToken = sha1(microtime() . rand(0, 9999999999));

        $bulk = new \MongoDB\Driver\BulkWrite();
        $bulk->insert(
            [
                'email' => $email,
                'password' => self::_hashPassword($password),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'is_activated' => false,
                'activation_token' => $activationToken
            ]);

        $manager->executeBulkWrite($projectId . '.users', $bulk, $writeConcern);
        return $activationToken;
    }

    /**
     * @param int $projectId
     *
     * @return Object
     */
    public static function login($projectId, $email, $password)
    {
        $results = Connection::getInstance()->query($projectId . '.users', new \MongoDB\Driver\Query([
            'email' => $email,
            'password' => self::_hashPassword($password)
        ]));

        $user = $results->toArray();
        return count($user) != 0;
    }

    private static function _hashPassword($password)
    {
        return $password;
    }

    public static function getNewSessionId($projectId, $email)
    {
        $manager = Connection::getInstance()->getManager();
        $writeConcern = new \MongoDB\Driver\WriteConcern(\MongoDB\Driver\WriteConcern::MAJORITY, 1000);

        $sessionId = self::getSessionId($projectId, $email);
        $bulk = new \MongoDB\Driver\BulkWrite();
        $bulk->update(
        [
            'email' => $email
        ],
        [
            '$push' =>
                [
                    'sessions' =>
                    [
                        'id' => $sessionId,
                        'device' => 'browser',
                        'os' => 'Ubuntu 14.04',
                        'browser' => 'Opera',
                        'ip' => '192.168.0.15',
                        'login_at' => Carbon::now()->format('Y-m-d H:i:s')
                    ],
                ]
        ]);

        $manager->executeBulkWrite($projectId . '.users', $bulk, $writeConcern);
        return $sessionId;
    }

    public static function getSessionId($projectId, $email)
    {
        $results = Connection::getInstance()->query($projectId . '.users', new \MongoDB\Driver\Query([
            'email' => $email
        ]));

        $sessions = $results->toArray()[0]->sessions ?? [];
        $sessionsIds = [];
        foreach ($sessions as $session) {
            $sessionsIds[] = $session->id;
        }

        do {
            $sessionId = sha1(microtime() . random_int(0, 9999999999999));
        } while (in_array($sessionId, $sessionsIds));
        return $sessionId;
    }

    public static function logout($projectId, $email, $sessionId)
    {
        $manager = Connection::getInstance()->getManager();
        $writeConcern = new \MongoDB\Driver\WriteConcern(\MongoDB\Driver\WriteConcern::MAJORITY, 1000);

        $bulk = new \MongoDB\Driver\BulkWrite();
        $bulk->update(
            [
                'email' => $email
            ],
            [
                '$pull' =>
                    [
                        'sessions' =>
                            [
                                'id' => $sessionId
                            ],
                    ]
            ]);

        $manager->executeBulkWrite($projectId . '.users', $bulk, $writeConcern);
    }
}