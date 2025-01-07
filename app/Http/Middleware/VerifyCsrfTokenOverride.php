<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfTokenOverride extends Middleware
{
    protected $except = [
		'/stanice/1'
	];
}
