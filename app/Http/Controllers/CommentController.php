<?php

namespace App\Http\Controllers;

use App\Comment;
use App\QueryFilter\Comment\Body;
use App\QueryFilter\Comment\Email;
use App\QueryFilter\Comment\Id;
use App\QueryFilter\Comment\Name;
use App\Repositories\CommentRepository;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;

class CommentController extends Controller
{
    private $commentRepository;

    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function index(Request $request)
    {
        return app(Pipeline::class)
            ->send($this->commentRepository->all())
            ->through([
                Name::class,
                Email::class,
                Body::class
            ])->thenReturn();
    }

    public function show($comment)
    {
        return $this->commentRepository->find($comment);
    }
}
