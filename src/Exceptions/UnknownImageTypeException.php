<?php

namespace Waredesk\Exceptions;

use Throwable;
use Waredesk\Exception;

class UnknownImageTypeException extends Exception
{
    public function __construct($message = "Unknown image type", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
