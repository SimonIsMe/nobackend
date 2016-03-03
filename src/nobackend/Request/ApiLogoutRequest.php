<?php namespace nobackend\Request;

use nobackend\Validator\{
    EmailValidator,
    ProjectIdValidator,
    RequiredValidator,
    SessionIdValidator
};

class ApiLogoutRequest extends AbstractRequest
{
    /**
     * @return array
     */
    protected  function _toValidate() : array
    {
        return [
            'email' => [new RequiredValidator(), new EmailValidator()],
            'session_id' => [new RequiredValidator(),  new SessionIdValidator()],
            'project_id' => [new RequiredValidator(),  new ProjectIdValidator()],
        ];
    }

}