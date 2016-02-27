<?php namespace nobackend\Validator;

abstract class AbstractValidator
{
    private $_value;

    protected $_okMessage = 'Validation is ok';
    protected $_errorMessage = 'There is an error.';
    protected $_message;

    /**
     * @return boolean
     */
    abstract public function validate();

    /**
     * @param string $value
     *
     * @return void
     */
    public function setValue($value)
    {
        $this->_value = $value;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->_value;
    }

    /**
     * @return string
     */
    public function getErrorMessage()
    {
        return $this->_errorMessage;
    }

    /**
     * @return string
     */
    public function getOkMessage()
    {
        return $this->_okMessage;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->_message;
    }

    /**
     * @param boolean $validationResult
     *
     * @return void
     */
    protected function _setMessage($validationResult)
    {
        if ($validationResult) {
            $this->_message = $this->_okMessage;
        } else {
            $this->_message = $this->_errorMessage;
        }
    }

}