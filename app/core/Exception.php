<?php


class MvcException extends Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    /**
     * generate Error Exception due to error occur
     */
    public function generateException()
    {
        return $this->getMessage();
    }
}