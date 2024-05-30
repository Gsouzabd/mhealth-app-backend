<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;


/**
 * @OA\Info(
 *     title="MLOVI - Multidisciplinar: BACKEND API V1",
 *     version="1.0.0",
 *     description="Description of your API",
 * )
 * 
 * @OA\OpenApi(
 *   @OA\Server(
 *       url="/api",
 *       description="Main (production) server"
 *   )
 * )
 */
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
