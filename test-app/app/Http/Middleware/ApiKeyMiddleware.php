<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;

class ApiKeyMiddleware
{
  public function handle(Request $request, Closure $next)
  {

    $key = $request->header('api-key');

    if (!$key|| $key !== config('app.api_key')) {
      return ResponseFormatter::error(
          null,
          'unauthorized',
          401
      );
    }

    return $next($request);

  }
}