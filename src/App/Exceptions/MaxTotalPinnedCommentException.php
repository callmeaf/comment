<?php

namespace Callmeaf\Comment\App\Exceptions;

use Exception;
use Illuminate\Http\Request;

class MaxTotalPinnedCommentException extends Exception
{
    public function __construct(int $total, ?Throwable $previous = null)
    {
        $message = __('callmeaf-comment::errors.max_total_pinned_comment',[
            'total' => $total,
        ]);
        parent::__construct($message, 0, $previous);
    }

    public function render(Request $request): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'message' => $this->getMessage()
        ], \Symfony\Component\HttpFoundation\Response::HTTP_FORBIDDEN);
    }

}
