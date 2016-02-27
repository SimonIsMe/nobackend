<?php namespace nobackend\Validator;

class RequiredValidator extends AbstractValidator
{
    protected $_errorMessage = 'This value is required.';

    /**
     * This method checks if value is correct.
     *
     * @return boolean
     */
    public function validate()
    {
        $validate = null != $this->getValue();

        $this->_setMessage($validate);
        return $validate;
    }
}