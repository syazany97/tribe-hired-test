<?php

namespace App\Http\Controllers;

use App\Post;
use App\Repositories\CommentRepository;
use App\Repositories\PostRepository;
use Illuminate\Http\Request;

class PostController extends Controller
{
    private $postRepository;

    private $commentRepository;

    public function __construct(PostRepository $postRepository, CommentRepository $commentRepository)
    {
        $this->postRepository = $postRepository;
        $this->commentRepository = $commentRepository;
    }

    public function index()
    {
        $posts = $this->postRepository->all();

        $comments = $this->commentRepository->all();

        if ($posts->isEmpty()) {
            return [];
        }

        return $posts->transform(function ($key) use ($comments) {
            $key['post_id'] = $key['id'];
            $key['post_title'] = $key['title'];
            $key['post_body'] = $key['body'];
            $key['total_number_of_comments'] = $comments->where('postId', $key['id'])->count();
            return $key;
        })->sortByDesc('total_number_of_comments')->values();

    }

    public function show($post)
    {
        try {
            $this->postRepository->find($post);
        } catch (\Exception $e) {
            abort(404);
        }
    }
}
