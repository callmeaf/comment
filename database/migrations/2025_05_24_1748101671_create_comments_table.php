<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            /**
             * @var \Callmeaf\Comment\App\Repo\Contracts\CommentRepoInterface $commentRepo
             */
            $commentRepo = app(\Callmeaf\Comment\App\Repo\Contracts\CommentRepoInterface::class);
            $table->foreignId('parent_id')->nullable()->constrained($commentRepo->getTable())->cascadeOnDelete();
            $table->string('status');
            $table->string('type')->nullable();
            $table->boolean('is_pinned');

            $table->string('commentable_id')->nullable();
            $table->string('commentable_type')->nullable();
            $table->index(['commentable_type','commentable_id']);
            /**
             * @var \Callmeaf\User\App\Repo\Contracts\UserRepoInterface $userRepo
             */
            $userRepo = app(\Callmeaf\User\App\Repo\Contracts\UserRepoInterface::class);
            $table->string('author_identifier')->nullable()->index();
            $table->foreign('author_identifier')->references($userRepo->getModel()->getRouteKeyName())->on($userRepo->getTable())->cascadeOnUpdate()->nullOnDelete();
            $table->text('content');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
