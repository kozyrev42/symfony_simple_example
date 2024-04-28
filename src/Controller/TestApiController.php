<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

class TestApiController
{
    public function test(): Response
    {
        $data = [
            'message' => 'Hello, this is a test API',
            'time' => date('Y-m-d H:i:s')
        ];

        return new Response(json_encode($data), 200, ['Content-Type' => 'application/json']);
    }
}
