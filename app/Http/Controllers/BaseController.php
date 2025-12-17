<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Illuminate\Http\Request;
use App\Traits\ApiResponses;

class BaseController extends Controller
{
    use ApiResponses;

    protected $service;


    public function index() : JsonResponse{

      $result = $this->service->get();

      return $this->handleServicejsonResponse($result);
    }

   public function show(int $id) : JsonResponse
   {

     $result = $this->service->show($id);

     return $this->handleServicejsonResponse($result);

   }
   public function store() : JsonResponse {

       $result = $this->service->store();

       return $this->handleServicejsonResponse($result);

   }

   public function update( int $id) : JsonResponse
   {

       $result = $this->service->update($id);

       return $this->handleServicejsonResponse($result);

   }

   public function delete ( int $id) : JsonResponse
   {

      $result = $this->service->delete($id);

       return $this->handleServicejsonResponse($result);
   }

   public function setSevice(Object $service){

       $this->service = $service;

   }




}
