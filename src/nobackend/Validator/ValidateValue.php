<?php namespace nobackend\Validator;

class ValidateValue
{
    private $_validators = [];
    private $_errors = [];

    /**
     * @param array $validators
     */
    public function __construct(array $validators)
    {
        $this->_validators = $validators;
    }

    /**
     * @param AbstractValidator $validator
     */
    public function addValidator(AbstractValidator $validator)
    {
        $this->_validators[] = $validator;
    }

    /**
     * @param array $validators
     */
    public function setValidators(array $validators)
    {
        $this->_validators = $validators;
    }

    /**
     * @return void
     */
    public function cleanValidators()
    {
        $this->_validators = [];
    }

    /**
     * @param array $value
     *
     * @return boolean
     */
    public function validate($value)
    {
        $isValidate = true;

        foreach ($this->_validators as $validator) {
            if ($validator->validate($value)) {
                $this->_errors[] = __($validator->getMessage());
                $isValidate = false;
            }
        }

        return $isValidate;
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->_errors;
    }
}