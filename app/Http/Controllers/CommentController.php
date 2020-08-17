<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Repositories\CommentRepository;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    private $commentRepository;

    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function index()
    {
        return $this->commentRepository->all();
    }

    public function show($comment)
    {
        return $this->commentRepository->find($comment);
    }
}
