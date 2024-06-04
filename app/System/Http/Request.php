<?php

namespace App\System\Http;

use Symfony\Component\HttpFoundation\Request as SymphonyHttpRequestFoundation;

class Request extends SymphonyHttpRequestFoundation
{

    public function all()
    {
        return new (self::class);
    }
}