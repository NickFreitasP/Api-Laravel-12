<?php

use Illuminate\Support\Facades\Route;
Use App\Http\Controllers\Closeds\Backoffice\UserController;

Route::controller(UserController::class)->group(function(){
    Route::prefix("user")->group(function(){
        Route::get("/","index");
        Route::get("/{id}","show");
        Route::post("/","store");
        Route::put("/{id}","update");
        Route::delete("/{id}","delete");
    });



});
