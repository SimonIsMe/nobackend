<?php namespace nobackend\Request;

use nobackend\Validator\EmailValidator;
use nobackend\Validator\ProjectIdValidator;
use nobackend\Validator\RequiredValidator;
use nobackend\Validator\StringLengthMinValidator;

class ApiLoginRequest extends AbstractRequest
{
    /**
     * @return array
     */
    protected  function _toValidate()
    {
        return [
            'email' => [new RequiredValidator(), new EmailValidator()],
            'password' => [new RequiredValidator(),  new StringLengthMinValidator(6)],
            'project_id' => [new RequiredValidator(),  new ProjectIdValidator()],
        ];
    }

}