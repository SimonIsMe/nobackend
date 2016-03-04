<?php namespace nobackend\Model;

use Carbon\Carbon;
use nobackend\Repository\RepoFactory;

abstract class AbstractModel
{
    protected $_repositoryName;

    private $_projectId;

    private $_id;
    private $_data = [];

    public function __construct(string $projectId, string $id = null)
    {
        $this->_projectId = $projectId;
        if (null != $id) {
            $this->_id = $id;
            $document =  RepoFactory::get($this->_repositoryName)->find($projectId, $id);

            foreach ($document as $name => $value) {
                if ($name == '_id') {
                    continue;
                }

                if (is_object($value) && '_at' == substr($name, -3)) {
                    $date = Carbon::parse($value->date, $value->timezone);
                    $this->_data[$name] = $date;
                    continue;
                }

                $this->_data[$name] = $value;
            }
        }
    }

    public function getProjectId() : string
    {
        return $this->_projectId;
    }

    public function __get(string $name)
    {
        return $this->_data[$name];
    }

    public function __set(string $name, $value)
    {
        $this->_data[$name] = $value;
    }

    public function save()
    {
        $repository = RepoFactory::get($this->_repositoryName);

        if (null == $this->_id) {
            $this->_id = $repository->create($this->_projectId, $this->_data);
            return;
        }

        //  todo - update
    }
}