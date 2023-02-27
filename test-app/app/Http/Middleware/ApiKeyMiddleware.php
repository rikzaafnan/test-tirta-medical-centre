<?php

namespace App\Http\Middleware;

class ApiKeyMiddleware
{
  public function handle($request, Closure $next)
  {

    dd($request);

    // if (!$key = $request->get('api_key') || $key !== config('app.api_key')) {
    // //   throw new AuthenticationException('Wrong api key');
    // }
  }
}