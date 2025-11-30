<?php

namespace App\Traits;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use App\Exceptions\ModelNotFoundException ;

trait ApiResponses {

    protected function findlWithMessage(Model $model , int $id , string $message = "Not Found" ,) : Model
    {

       $result = $model->find($id);
       if(!$result){
         throw new ModelNotFoundException($message);
       }
       return $result;

    }

    protected function handleServicejsonResponse(mixed $result) : JsonResponse
    {

        return response()->json([
            "success" => true,
            "data" => $result
        ]);

    }



}
