<?php

namespace App\Http\Controllers\Closeds\Backoffice;

use App\Http\Controllers\BaseController;
use App\Models\User;
use App\Services\Closeds\Backoffice\UserService;
use Illuminate\Http\Request;

class UserController extends BaseController
{

    public function __construct(Request $request)
    {
         $this->setSevice(new UserService());
         $this->service->setModel( User::class );
         $this->service->desablePagination();


    }

}
