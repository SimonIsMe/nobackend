<?php namespace nobackend\Model;

use nobackend\Repository\Contracts\ProjectRepositoryInterface;

class Project extends AbstractModel
{
    protected $_repositoryName = ProjectRepositoryInterface::NAME;
}