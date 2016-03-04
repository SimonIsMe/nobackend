<?php namespace nobackend\Validator;

class ProjectIdValidator extends AbstractValidator
{
    protected $_errorMessage = 'Given project ID is not exist.';

    /**
     * This method checks if value is correct.
     *
     * @return bool
     */
    public function validate() : bool
    {
        if ($this->getValue() == 'nobackend') {
            return true;
        }

        //  todo
        //  sprawdzenie Project ID

        return true;
    }
}