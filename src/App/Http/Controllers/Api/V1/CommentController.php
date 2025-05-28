<?php

namespace Callmeaf\Comment\App\Http\Controllers\Api\V1;

use Callmeaf\Base\App\Http\Controllers\Api\V1\ApiController;
use Callmeaf\Comment\App\Repo\Contracts\CommentRepoInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class CommentController extends ApiController implements HasMiddleware
{
    public function __construct(protected CommentRepoInterface $commentRepo)
    {
        parent::__construct($this->commentRepo->config);
    }

    public static function middleware(): array
    {
        return [
           //
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->commentRepo->latest()->builder(fn(Builder $query) => $query->ofAuthor(
            $this->request->user(),
        ))->search()->paginate();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        return $this->commentRepo->create(data: $this->request->validated());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->commentRepo->builder(fn(Builder $query) => $query->with([
            'children'
        ]))->findById(value: $id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(string $id)
    {
        return $this->commentRepo->update(id: $id, data: $this->request->validated());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->commentRepo->delete(id: $id);
    }

    public function statusUpdate(string $id)
    {
        return $this->commentRepo->update(id: $id, data: $this->request->validated());
    }

    public function typeUpdate(string $id)
    {
        return $this->commentRepo->update(id: $id, data: $this->request->validated());
    }

    public function trashed()
    {
        return $this->commentRepo->trashed()->latest()->search()->paginate();
    }

    public function restore(string $id)
    {
        return $this->commentRepo->restore(id: $id);
    }

    public function forceDestroy(string $id)
    {
        return $this->commentRepo->forceDelete(id: $id);
    }

    public function pin(string $id)
    {
        return $this->commentRepo->update(id: $id,data: $this->request->validated());
    }

    public function replies(string $id)
    {
        return $this->commentRepo->builder(fn(Builder $query) => $query->childrenOf($id)->with([
            'author.image'
        ]))->search()->paginate();
    }
}
