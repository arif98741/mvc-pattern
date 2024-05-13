<?php

namespace App\System\Http;

use Symfony\Component\HttpFoundation\Request as SymphonyHttpRequestFoundation;

class Request extends SymphonyHttpRequestFoundation
{
    public function __construct(array $query = [], array $request = [], array $attributes = [], array $cookies = [], array $files = [], array $server = [], $content = null)
    {
        parent::__construct($query, $request, $attributes, $cookies, $files, $server, $content);
    }

    public function all()
    {
        return new SymphonyHttpRequestFoundation;
    }
}