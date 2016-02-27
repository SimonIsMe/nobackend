<?php namespace nobackend\Validator;

class StringLengthMinValidator extends AbstractValidator
{
    protected $_errorMessage = 'Given value is too short.';

    private $_min;

    /**
     * @param int $min
     */
    public function __construct($min)
    {
        $this->_min = $min;
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

        $validate = $this->_min <= strlen($this->getValue());

        $this->_setMessage($validate);
        return $validate;
    }
}