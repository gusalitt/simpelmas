<?php

namespace App\Foundation\Http;

use App\Foundation\Http\Request;
use App\Foundation\Traits\HasRequest;

abstract class Controller
{
    use HasRequest;

    protected array $requests = [];

    public function __construct()
    {
        $this->currentRequest = new Request();
    }
}
