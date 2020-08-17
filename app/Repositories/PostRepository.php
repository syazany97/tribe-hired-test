<?php


namespace App\Repositories;


use App\Comment;
use App\Post;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class PostRepository
{
    /**
     * @return array|collection
     */
    public function all()
    {
        $response = Http::get('https://jsonplaceholder.typicode.com/posts');

        if (!$response->successful()) return [];

        return collect($response->json())->mapInto(Post::class);
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
