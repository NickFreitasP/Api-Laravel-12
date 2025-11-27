<?php

namespace App\Exceptions;

use Exception;

class ModelNotFoundException extends Exception
{
 protected $message;

    public function __construct(string $message = 'Recurso não encontrado')
    {
        $this->message = $message;
        parent::__construct($message, 404);
    }

    public function render($request)
    {
        return response()->json([
            'success' => false,
            'message' => $this->message
        ], 404);
    }

}
