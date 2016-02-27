<?php namespace nobackend\Request;

use nobackend\Validator\EmailValidator;
use nobackend\Validator\ProjectIdValidator;
use nobackend\Validator\RequiredValidator;
use nobackend\Validator\SessionIdValidator;

class ApiLogoutRequest extends AbstractRequest
{
    /**
     * @return array
     */
    protected  function _toValidate()
    {
        return [
            'email' => [new RequiredValidator(), new EmailValidator()],
            'session_id' => [new RequiredValidator(),  new SessionIdValidator()],
            'project_id' => [new RequiredValidator(),  new ProjectIdValidator()],
        ];
    }

}