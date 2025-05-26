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
     Route::prefix('{comment}')->group(function () {
         Route::patch('/pin', 'pin');
     });
 });
