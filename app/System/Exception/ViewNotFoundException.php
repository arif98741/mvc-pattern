<?php

namespace App\System\Exception;

use Exception;
use Throwable;

class ViewNotFoundException extends Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }


}
