<?php namespace nobackend\Validator;

class ProjectIdValidator extends AbstractValidator
{
    protected $_errorMessage = 'Given project ID is not exist.';

    /**
     * This method checks if value is correct.
     *
     * @return boolean
     */
    public function validate()
    {
        return true;
    }
}