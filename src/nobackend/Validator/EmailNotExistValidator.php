<?php namespace nobackend\Validator;

use nobackend\Repository\Contracts\UserRepositoryInterface;
use nobackend\Repository\RepoFactory;

class EmailExistValidator extends AbstractValidator
{
    protected $_errorMessage = 'Given e-mail address is not exist.';

    private $_projectId;

    public function __construct(string $projectId)
    {
        $this->_projectId = $projectId;
    }

    /**
     * This method checks if value is correct.
     *
     * @return bool
     */
    public function validate() : bool
    {
        if (null == $this->getValue()) {
            return false;
        }

        $count = RepoFactory::get(UserRepositoryInterface::NAME)->countBy('email', $this->getValue());

        $this->_setMessage($count >= 1);
        return $count >= 1;
    }
}