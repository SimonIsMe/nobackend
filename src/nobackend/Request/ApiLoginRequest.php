<?php namespace nobackend\Request;

use nobackend\Validator\{
    EmailValidator,
    ProjectIdValidator,
    RequiredValidator,
    StringLengthMinValidator
};

class ApiLoginRequest extends AbstractRequest
{
    /**
     * @return array
     */
    protected  function _toValidate() : array
    {
        return [
            'email' => [new RequiredValidator(), new EmailValidator()],
            'password' => [new RequiredValidator(),  new StringLengthMinValidator(6)],
            'project_id' => [new RequiredValidator(),  new ProjectIdValidator()],
        ];
    }

}