<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *    title="Extended Swapi API",
 *    version="1.0.0",
 *    contact="Erizon Encina",
 *    description="URL de la API Original: <a target='_blank' href='https://swapi.dev/documentation'>https://swapi.dev/documentation</a>"
 * )
 */

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
