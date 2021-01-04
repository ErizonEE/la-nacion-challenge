<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Services\ExternalResourceService;

class CheckIfExisteExternalResource
{
    /**
     * Verifica si existe el recurso, si hay respuesta continua, sino la clase ExternalResourceService aborta el request
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $explodedUri = explode('/', $request->getRequestUri());
        $clearedUri = '/' . $explodedUri[1] . '/' . $explodedUri[2] . '/' . $explodedUri[3]; 
        ExternalResourceService::sendRequest($clearedUri);
        return $next($request);
    }
}
