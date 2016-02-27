<?php namespace nobackend\repository;

class Sites
{

    /**
     * @param int $projectId
     *
     * @return Object
     */
    public static function findByProjectId($projectId)
    {
        $manager = Connection::getInstance()->getManager();

        $query = new \MongoDB\Driver\Query([
            'project_id' => $projectId
        ]);
        $results = $manager->executeQuery('nobackend.sites', $query);

        return $results->toArray()[0];
    }

}