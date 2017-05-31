<?php

namespace Waredesk\Exceptions;

use Waredesk\Exception;

class InvalidRequestException extends Exception
{
    private $errors;

    public function __construct($message = "", array $errors = null)
    {
        $this->errors = $errors;
        parent::__construct($message);
    }

    public function getErrors(): ? array
    {
        return $this->errors;
    }
}
