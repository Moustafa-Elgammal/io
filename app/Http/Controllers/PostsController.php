<?php

namespace App\Http\Controllers;

use App\System\Posts\PostsLanguageHandler;
use App\System\Posts\Validators\PostsValidators;
use Illuminate\Http\Request;
use System\Posts\Repositories\PostsRepository;
use System\Posts\Services\PostsService;

class PostsController extends Controller
{
    protected $service;
    public function __construct()
    {
        $postsRepo = new PostsRepository();
        $postsVali = new PostsValidators();
        $this->service = new  PostsService($postsRepo, $postsVali);
    }

    public function index(Request $request)
    {
        return $this->service->getPosts($request);
    }

    public function delete($id)
    {
        return $this->service->delete($id) ? PostsLanguageHandler::get('deleted') : $this->service->getErrors();
    }

    public function update($id, Request $request)
    {
        return $this->service->updatePost($id, $request) ? PostsLanguageHandler::get('updated') : $this->service->getErrors();
    }

    public function recover($id)
    {
        return $this->service->restore($id) ? PostsLanguageHandler::get('restored') : $this->service->getErrors();
    }

    public function show($id)
    {
        return $this->service->getById($id);
    }
}
