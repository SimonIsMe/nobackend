<?php namespace nobackend\Request;

use nobackend\Validator\{
    EmailValidator,
    EqualsValidator,
    ProjectIdValidator,
    RequiredValidator,
    StringLengthMinValidator
};

class ApiRegisterRequest extends AbstractRequest
{
    /**
     * @return array
     */
    protected  function _toValidate() : array
    {
        return [
            'email' => [new RequiredValidator(), new EmailValidator()],
            'password' => [new RequiredValidator(),  new StringLengthMinValidator(6)],
            'password_repeat' => [new RequiredValidator(),  new StringLengthMinValidator(6), new EqualsValidator($this->get('password'))],
            'project_id' => [new RequiredValidator(),  new ProjectIdValidator()],
        ];
    }

}