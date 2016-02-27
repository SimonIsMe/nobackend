<?php namespace nobackend\Validator;

class EmailValidator extends AbstractValidator
{
    protected $_errorMessage = 'Given e-mail address is not correct.';

    /**
     * This method checks if value is correct.
     *
     * @return boolean
     */
    public function validate()
    {
        if (null == $this->getValue()) {
            return false;
        }

        $validate = $this->getValue() === filter_var($this->getValue(), FILTER_VALIDATE_EMAIL);

        $this->_setMessage($validate);
        return $validate;
    }
}