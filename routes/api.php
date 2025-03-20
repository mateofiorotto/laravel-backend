<?php

use App\Http\Controllers\BackendController;
use Illuminate\Support\Facades\Route;

//add route /test
//get obtains a string and a first class function
Route::get("/test", function() {
    return "The backend workls correctly";
});

//if send the route without id, then all the names will be returned
Route::get("/backend", [BackendController::class, "getAll"]);

//call backend route, calls to the method "get" from backendcontroller
//send id parameter. ? indicates that the parameter is optional
Route::get("/backend/{id?}", [BackendController::class, "get"]);

//post
Route::post("/backend", [BackendController::class, "create"]);

//put
Route::put("/backend/{id}", [BackendController::class, "update"]);

//delete
Route::delete("/backend/{id}", [BackendController::class, "delete"]);