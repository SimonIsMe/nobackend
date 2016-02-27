<?php  namespace nobackend\Request;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

abstract class AbstractRequest extends Request
{
    private $_errors = [];

    /**
     * @return array
     */
    abstract protected function _toValidate();

    /**
     * @return boolean
     */
    public function validate()
    {
        foreach ($this->_toValidate() as $key => $validators) {
            $value = $this->get($key);
            foreach ($validators as $validator) {
                $validator->setValue($value);
                if (false == $validator->validate($value)) {
                    $this->_errors[$key][] = $validator->getMessage();
                }
            }
        }

        return empty($this->_errors);
    }

    /**
     * @return Response
     */
    public function getErrorResponse()
    {
        return new JsonResponse($this->_errors);
    }
}