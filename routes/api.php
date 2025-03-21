<?php

use App\Http\Controllers\BackendController;
use App\Http\Controllers\QueriesController;
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

//Queries
Route::get("/query", [QueriesController::class, "get"]);
Route::get("/query/{id}", [QueriesController::class, "getById"]);
Route::get("/query/method/names", [QueriesController::class, "getNames"]);
Route::get("/query/method/search/{name}/{price}", [QueriesController::class, "searchNames"]);
Route::get("/query/method/searchString/{value}", [QueriesController::class, "searchString"]);
Route::post("/query/method/advancedSearch", [QueriesController::class, "advancedSearch"]);
Route::get("/query/method/join", [QueriesController::class, "join"]);
Route::get("/query/method/groupBy", [QueriesController::class, "groupBy"]);