<?php

namespace Callmeaf\Comment\App\Imports\Api\V1;

use Callmeaf\Base\App\Services\Importer;
use Callmeaf\Comment\App\Enums\CommentStatus;
use Callmeaf\Comment\App\Repo\Contracts\CommentRepoInterface;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class CommentsImport extends Importer implements ToCollection,WithChunkReading,WithStartRow,SkipsEmptyRows,WithValidation,WithHeadingRow
{
    private CommentRepoInterface $commentRepo;

    public function __construct()
    {
        $this->commentRepo = app(CommentRepoInterface::class);
    }

    public function collection(Collection $collection)
    {
        $this->total = $collection->count();

        foreach ($collection as $row) {
            $this->commentRepo->freshQuery()->create([
                // 'status' => $row['status'],
            ]);
            ++$this->success;
        }
    }

    public function chunkSize(): int
    {
        return \Base::config('import_chunk_size');
    }

    public function startRow(): int
    {
        return 2;
    }

    public function rules(): array
    {
        $table = $this->commentRepo->getTable();
        return [
            // 'status' => ['required',Rule::enum(CommentStatus::class)],
        ];
    }

}
