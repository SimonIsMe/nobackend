<?php namespace nobackend\Validator;

class StringLengthMaxValidator extends AbstractValidator
{
    protected $_errorMessage = 'Given value is too short.';

    private $_max;

    /**
     * @param int $max
     */
    public function __construct($max)
    {
        $this->_max = $max;
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

        $validate = strlen($this->getValue()) <= $this->_max;

        $this->_setMessage($validate);
        return $validate;
    }
}