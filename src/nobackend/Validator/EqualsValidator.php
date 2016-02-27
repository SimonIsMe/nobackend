<?php namespace nobackend\Validator;

class EqualsValidator extends AbstractValidator
{
    protected $_errorMessage = 'Given values should be the same.';

    private $_definedValue;

    /**
     * @param int $definedValue
     */
    public function __construct($definedValue)
    {
        $this->_definedValue = $definedValue;
    }

    /**
     * This method checks if value is correct.
     *
     * @return boolean
     */
    public function validate()
    {
        if (null == $this->getValue()) {
            return true;
        }


        $validate = $this->getValue() == $this->_definedValue;

        $this->_setMessage($validate);
        return $validate;
    }
}