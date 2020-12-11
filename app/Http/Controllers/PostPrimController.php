<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Services\PostService;

class PostPrimController extends Controller
{
    protected $service;

    public function __construct(PostService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $posts = $this->service->all($request->page,$request->limit);
        return response(json_encode($posts));
    }

    public function show($id)
    {
        $post = $this->service->show($id);
        return response(json_encode($post));
    }
}
