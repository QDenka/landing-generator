<?php

namespace QDenka\LandingGenerator\Exceptions;

class FileException extends \Exception
{
    /**
     * @param string $message
     */
    public function __construct(string $message = "File error")
    {
        parent::__construct($message);
    }
}