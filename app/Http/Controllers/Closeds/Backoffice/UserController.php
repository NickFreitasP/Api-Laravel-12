<?php

namespace App\Http\Controllers\Closeds\Backoffice;

use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Services\Closeds\UserService;
use Illuminate\Http\Request;
use App\Traits\ApiResponses;

class UserController extends Controller
{
    use ApiResponses;

    private $user_service;


    public function __construct(UserService $user_service)
    {
       $this->user_service = $user_service;

    }
    public function index() : JsonResponse{

        return response()->json($this->user_service->get());
    }

   public function show(int $id) : JsonResponse
   {
      return response()->json($this->user_service->show($id));

   }
   public function store(Request $request) : JsonResponse {

     return response()->json($this->user_service->store($request->all()));

   }

   public function update(Request $request , int $id) : JsonResponse
   {

     return response()->json($this->user_service->update($id,$request->all()));

   }

   public function delete ( int $id) : JsonResponse
   {

     return response()->json($this->user_service->delete($id));
   }

}
