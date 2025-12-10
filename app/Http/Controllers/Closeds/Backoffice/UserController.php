<?php

namespace App\Http\Controllers\Closeds\Backoffice;

use App\Http\Controllers\BaseController;
use App\Models\User;
use App\Services\Closeds\UserService;

class UserController extends BaseController
{

    public function __construct()
    {
         $this->setSevice(new UserService());
         $this->service->setModel( User::class );

    }

}
