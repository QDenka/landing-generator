<?php

namespace QDenka\LandingGenerator\Exceptions;

class WordException extends \Exception
{
    /**
     * @param string $message
     */
    public function __construct(string $message = "Word error")
    {
        parent::__construct($message);
    }
}