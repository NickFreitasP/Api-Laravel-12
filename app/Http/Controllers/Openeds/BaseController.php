<?php

namespace App\Http\Controllers\Openeds;

use App\Services\HelloWorldService ;

use Symfony\Component\HttpFoundation\JsonResponse;

class BaseController
{

    public function index() : JsonResponse {

         $hello_world = new HelloWorldService();

         return response()->json($hello_world->get());
    }

}
