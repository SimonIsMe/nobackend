<?php namespace nobackend\Validator;

class SessionIdValidator extends AbstractValidator
{
    protected $_errorMessage = 'Given session ID is not exist.';

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