<?php


namespace App\Repositories;


use App\Comment;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class CommentRepository
{
    /**
     * @return array|collection
     */
    public function all()
    {
        $response = Http::get('https://jsonplaceholder.typicode.com/comments');

        if (!$response->successful()) return [];

        return collect($response->json())->mapInto(Comment::class);
    }

    public function find($id)
    {
        $comments = $this->all();

        if ($comments->isNotEmpty()) {
            return $comments->firstWhere('id', $id);
        }

        return null;
    }

}
