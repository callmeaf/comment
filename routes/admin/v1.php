<?php

use Illuminate\Support\Facades\Route;

[
    $controllers,
    $prefix,
    $as,
    $middleware,
] = Base::getRouteConfigFromRepo(repo: \Callmeaf\Comment\App\Repo\Contracts\CommentRepoInterface::class);

Route::apiResource($prefix, $controllers['comment'])->middleware($middleware);
 Route::prefix($prefix)->as($as)->middleware($middleware)->controller($controllers['comment'])->group(function () {
     Route::get('trashed/list', 'trashed');
     Route::prefix('{comment}')->group(function () {
         Route::patch('/status', 'statusUpdate');
         Route::patch('/type', 'typeUpdate');
         Route::patch('/restore', 'restore');
         Route::delete('/force', 'forceDestroy');
         Route::patch('/pin', 'pin');
     });
 });
