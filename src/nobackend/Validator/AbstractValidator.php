<?php namespace nobackend\Validator;

abstract class AbstractValidator
{
    private $_value;

    protected $_okMessage = 'Validation is ok';
    protected $_errorMessage = 'There is an error.';
    protected $_message;

    /**
     * @return bool
     */
    abstract public function validate() : bool;

    /**
     * @param string $value
     *
     * @return void
     */
    public function setValue(string $value)
    {
        $this->_value = $value;
    }

    /**
     * @return string
     */
    public function getValue() : string
    {
        return $this->_value;
    }

    /**
     * @return string
     */
    public function getErrorMessage() : string
    {
        return $this->_errorMessage;
    }

    /**
     * @return string
     */
    public function getOkMessage() : string
    {
        return $this->_okMessage;
    }

    /**
     * @return string
     */
    public function getMessage() : string
    {
        return $this->_message;
    }

    /**
     * @param bool $validationResult
     *
     * @return void
     */
    protected function _setMessage(bool $validationResult)
    {
        if ($validationResult) {
            $this->_message = $this->_okMessage;
        } else {
            $this->_message = $this->_errorMessage;
        }
    }

}