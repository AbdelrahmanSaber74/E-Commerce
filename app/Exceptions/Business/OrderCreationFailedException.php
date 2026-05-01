<?php

namespace App\Exceptions\Business;

use Exception;

class OrderCreationFailedException extends Exception
{
    public function __construct($message = "Failed to create order. Please try again.")
    {
        parent::__construct($message, 500);
    }
}
